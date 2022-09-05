<?php

namespace App\Repositories;

use App\Interfaces\AgencyInterface;
use App\Interfaces\TagAreaInterface;
use App\Interfaces\TagUserInterface;
use App\Models\Agency;
use App\Models\Team;
use App\Traits\UserNameGenerator;

class AgencyRepository extends BaseRepository implements AgencyInterface
{

    use UserNameGenerator;
    protected $agency;
    protected $user;
    protected $tagArea;
    protected $tagUser;

    public function __construct(Agency $agency, UserRepository $user, TagAreaInterface $tagArea, TagUserInterface $tagUser)
    {
        $this->agency   = $agency;
        $this->user     = $user;
        $this->tagArea  = $tagArea;
        $this->tagUser  = $tagUser;
    }

    public function query()
    {
        return $this->agency
            ->join('tag_areas as tag_camps', function ($join) {
                $join->on('tag_camps.agency_id', '=', 'agencies.id')
                    ->whereNull('tag_camps.team_id')
                    ->where('tag_camps.taggable_type', \App\Models\Encampment\Camp::class);
            })
            ->join('camps', 'camps.id', 'tag_camps.taggable_id')
            ->join('tag_areas as tag_blocks', function ($join) {
                $join->on('tag_blocks.agency_id', '=', 'agencies.id')
                    ->whereNull('tag_blocks.team_id')
                    ->where('tag_blocks.taggable_type', \App\Models\Encampment\Block::class);
            })
            ->join('blocks', 'blocks.id', 'tag_blocks.taggable_id')
            ->join('users', 'users.email', 'agencies.email')
            ->join('role_user', 'role_user.user_id', 'users.id')
            ->join('tag_users', function ($join) {
                $join->on('tag_users.taggable_id', 'agencies.id')
                    ->where('tag_users.taggable_type', \App\Models\Agency::class);
            })
            ->leftJoin('teams', 'teams.agency_id', 'agencies.id')

            ->join('users as agency_users', function($join){
                $join->on('agency_users.id', 'tag_users.user_id')
                    ->where('tag_users.taggable_type', \App\Models\Agency::class);
            })
            ->select('agencies.*', 'users.id as user_id', 'role_user.role_id')
            ->selectRaw('(GROUP_CONCAT(
                DISTINCT CONCAT(camps.id,"|",camps.name,"|",camps.short_name)
                ORDER BY camps.id ASC
                SEPARATOR ","
            )) AS camp')
            ->selectRaw('(GROUP_CONCAT(
                DISTINCT CONCAT(blocks.id,"|",blocks.short_name,"|",blocks.camp_id,"|",blocks.name)
                ORDER BY blocks.id ASC
                SEPARATOR ","
            )) AS block')
            ->selectRaw('(GROUP_CONCAT(
                DISTINCT CONCAT(teams.id,"|",teams.team_name,"|",teams.contact_person,"|",teams.mobile,"|",teams.email)
                ORDER BY teams.id ASC
                SEPARATOR ","
            )) AS team')
            ->selectRaw('(GROUP_CONCAT(
                DISTINCT CONCAT(agency_users.id,"|",agency_users.name,"|",agency_users.id_no,"|",agency_users.mobile,"|",agency_users.email)
                ORDER BY agency_users.id ASC
                SEPARATOR ","
            )) AS user')
            ->selectRaw('GROUP_CONCAT(tag_users.user_id) as all_users')
            ->groupBy('agencies.id');
    }

    private function store($data, $batch = false)
    {
        if ($batch) :
            return $this->agency->Insert($data);
        else :
            return $this->agency->create($data);
        endif;
    }

    private function update($data, $id)
    {
        $agency = $this->agency->findOrFail($id);
        $agency->update($data);
        return $agency;
    }

    private function delete($id)
    {
        $agency = $this->agency->findOrFail($id);
        $agency->delete();
        $agency->tag_agency()->delete();
        return $agency;
    }

    public function lists($paginate = false, $params = null, $sort = false)
    {
        $query = $this->query()
            ->when(!$this->isAdmin && !$this->isAgency, function ($query) {
                $query->when(!is_null($this->userinfo), function ($query) {
                    $query->whereIn('tag_users.user_id', [$this->userinfo->id]);
                });
            })
            ->when(!$this->isAdmin && $this->isAgency, function ($query) {
                $query->when(!is_null($this->userinfo), function ($query) {
                    $query->whereIn('tag_users.user_id', [$this->userinfo->id]);
                });
            });

        if (!is_null($params) && count($params)) :
            $query->when(!is_null(data_get($params, 'camp')), function ($query) use ($params) {
                $query->join('tag_areas', function ($join) use ($params) {
                    $join->on('tag_areas.agency_id', 'agencies.id')
                        ->where('tag_areas.taggable_type', \App\Models\Encampment\Camp::class);
                })
                    ->where('tag_areas.taggable_id', data_get($params, 'camp'));
            })
                ->when(!is_null(data_get($params, 'block')), function ($query) use ($params) {
                    $query->join('tag_areas as tag_team_areas', function ($join) use ($params) {
                        $join->on('tag_team_areas.agency_id', 'agencies.id')
                            ->where('tag_team_areas.taggable_type', \App\Models\Encampment\Block::class);
                    })
                        ->where('tag_team_areas.taggable_id', data_get($params, 'block'));
                })
                ->when(!is_null(data_get($params, 'search')), function ($query) use ($params) {
                    $query->where(function ($query) use ($params) {
                        $query->where('agency_name', 'LIKE', '%' . data_get($params, 'search') . '%')
                            ->orwhere('contact_person', 'LIKE', '%' . data_get($params, 'search') . '%')
                            ->orwhere('email', 'LIKE', '%' . data_get($params, 'search') . '%')
                            ->orwhere('mobile', 'LIKE', '%' . data_get($params, 'search') . '%');
                    });
                });
        endif;

        //For Sort
        if ($sort && data_get($params, 'name')) :
            $query = $this->sortResult($query, data_get($params, 'name'), data_get($params, 'sort'));
        endif;

        return $paginate ? $this->resultWithPagination($query, data_get($params, 'max_count') ?? 10) : $this->resultSet($query);
    }

    public function show($id)
    {
        $query   = $this->query();
        // return $query->toSql();
        $result  = $query->findOrFail($id);
        return $result;
    }

    public function storeData($data)
    {
        // Storing Agency Information
        $agencyData = $data->only('agency_name', 'address', 'contact_person', 'mobile', 'phone', 'email');
        $agency = $this->store($agencyData->toArray());

        // Storing User Information
        $user = $this->userDataHandler($data);

        // User Tag Agency Information
        $agency->tag_agency()->create([
            'user_id' => $user->id
        ]);

        // Storing Tagged Areas For Agency
        if (count($data['assigns']) != 0) :
            $this->tagAreaDataHandler($agency, $data['assigns']);
        endif;

        return $agency;
    }

    public function updateData($data, $id)
    {
        // Storing Agency Information
        $agencyData = $data->only('agency_name', 'address', 'contact_person', 'mobile', 'phone', 'email');
        $agency = $this->update($agencyData->toArray(), $id);

        // Storing User Information
        $user = $this->userDataHandler($data);

        // User Tag Agency Information
        if (is_null($data['user_id'])) :
            $agency->tag_agency()->create([
                'user_id' => $user->id
            ]);
        endif;

        // Storing Tagged Areas For Agency
        if (count($data['assigns']) != 0) :
            $this->tagAreaDataHandler($agency, $data['assigns']);
        endif;

        return $agency;
    }

    private function userDataHandler($data)
    {
        $userData               = $data->only('email', 'mobile', 'password', 'role_id');
        $userData['name']       = $data['contact_person'];
        $userData['username']   = $this->getUserName(null, $data['email']);
        $userData['roles']      = [2];

        if (is_null($data['user_id'])) :
            $user = $this->user->storeData(collect($userData));
        else :
            $user = $this->user->updateData(collect($userData), $data['user_id']);
        endif;

        return $user;
    }

    private function tagAreaDataHandler($reference, $data)
    {
        $areas = [];

        foreach ($data as $assign) :
            $areas[] = [
                'taggable_type' => \App\Models\Encampment\Camp::class,
                'taggable_id'   => $assign['camp_id'],
                'agency_id'     => $reference->id,
            ];
            foreach ($assign['block_id'] as $item) :
                $areas[] = [
                    'taggable_type' => \App\Models\Encampment\Block::class,
                    'taggable_id'   => $item,
                    'agency_id'     => $reference->id,
                ];
            endforeach;
        endforeach;

        $this->tagArea->store($areas, ['agency_id' => $reference->id]);
    }

    public function destroy($id)
    {
        $teams = Team::where('agency_id', $id)->pluck('id');

        $tagArea = [ 'team_id' => $teams->toArray(), 'agency_id' => $id ];
        $this->tagArea->delete($tagArea);

        $tagUser = [ 'taggable_id' => $teams->toArray(), 'taggable_type' => Team::class ];
        $this->tagUser->delete($tagUser);
        
        Team::whereIn('id', $teams)->delete();

        $agency = $this->delete($id);
        return $agency;
    }
}
