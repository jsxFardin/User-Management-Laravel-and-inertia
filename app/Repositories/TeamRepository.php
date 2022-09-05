<?php

namespace App\Repositories;

use App\Interfaces\TagAreaInterface;
use App\Interfaces\TagUserInterface;
use App\Interfaces\TeamInterface;
use App\Interfaces\UserInterface;
use App\Models\Team;
use App\Traits\UserNameGenerator;
use Illuminate\Support\Facades\DB;

class TeamRepository extends BaseRepository implements TeamInterface
{
    use UserNameGenerator;
    protected $team;
    protected $user;
    protected $tagArea;
    protected $tagUser;

    public function __construct(Team $team, UserInterface $user, TagAreaInterface $tagArea, TagUserInterface $tagUser)
    {
        $this->team     = $team;
        $this->user     = $user;
        $this->tagArea  = $tagArea;
        $this->tagUser  = $tagUser;
    }

    public function query()
    {
        return $this->team
            ->join('agencies', 'agencies.id', 'teams.agency_id')
            ->leftJoin('tag_users', function ($join) {
                $join->on('tag_users.taggable_id', 'teams.id')
                    ->where('tag_users.taggable_type', \App\Models\Team::class);
            })
            ->leftJoin('users', 'users.id', 'tag_users.user_id')
            ->leftJoin('role_user', 'role_user.user_id', 'users.id')
            ->join('users as contact_user', 'contact_user.email', 'teams.email')
            ->join('tag_areas as tag_camps', function ($join) {
                $join->on('tag_camps.agency_id', 'teams.agency_id')
                    ->on('tag_camps.team_id', 'teams.id')
                    ->where('tag_camps.taggable_type', \App\Models\Encampment\Camp::class);
            })
            ->join('camps', 'camps.id', 'tag_camps.taggable_id')
            ->join('tag_areas as tag_blocks', function ($join) {
                $join->on('tag_blocks.agency_id', 'teams.agency_id')
                    ->on('tag_blocks.team_id', 'teams.id')
                    ->where('tag_blocks.taggable_type', \App\Models\Encampment\Block::class);
            })
            ->join('blocks', 'blocks.id', 'tag_blocks.taggable_id')
            ->select('teams.*', 'agencies.agency_name', 'contact_user.id as user_id', 'role_user.role_id')
            ->selectRaw('(GROUP_CONCAT(
                DISTINCT CONCAT(users.id,"|",users.name,"|",users.id_no,"|",users.mobile,"|",users.email)
                ORDER BY users.id ASC
                SEPARATOR ","
            )) AS user')
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
            ->selectRaw('GROUP_CONCAT(DISTINCT CONCAT(tag_users.user_id,"|",tag_users.taggable_type) SEPARATOR ",") as all_users')
            ->groupBy('teams.id')
            ->orderBy('teams.agency_id');
    }

    private function store($data, $batch = false)
    {
        if ($batch) :
            return $this->team->Insert($data);
        else :
            return $this->team->create($data);
        endif;
    }

    private function update($data, $id)
    {
        $agency = $this->team->findOrFail($id);
        $agency->update($data);
        return $agency;
    }

    public function delete($id)
    {
        $team = $this->team->findOrFail($id);
        $team->delete();
        $team->tag_team()->delete();
        $this->tagArea->delete(['team_id' => $id]);
        return $team;
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
                $query->whereRaw('FIND_IN_SET(
                    teams.id, (
                        SELECT GROUP_CONCAT(
                            DISTINCT CONCAT(tag_team.id)
                        )
                        FROM tag_users as agency_user
                        JOIN teams as tag_team ON tag_team.agency_id = agency_user.taggable_id AND agency_user.taggable_type = "App\\\Models\\\Agency"
                        WHERE agency_user.user_id IN (' . implode(',', [$this->userinfo->id]) . ')
                ))');
            });

        if (!is_null($params) && count($params)) :
            $query->when(!is_null(data_get($params, 'agency')), function ($query) use ($params) {
                $query->whereIn('agencies.id', gettype(data_get($params, 'agency')) == "array" ?
                    data_get($params, 'agency') : [data_get($params, 'agency')]);
            })
            ->when(!is_null(data_get($params, 'camp')), function ($query) use ($params) {
                $campBlockIds = gettype(data_get($params, 'camp')) == "array" ? data_get($params, 'camp') : [data_get($params, 'camp')];
                if (!is_null(data_get($params, 'block'))) :
                    $campBlockIds = array_merge($campBlockIds, (gettype(data_get($params, 'block')) == "array" ? data_get($params, 'block') : [data_get($params, 'block')]));
                endif;

                $query->join('tag_areas', function ($join) use ($params) {
                    $join->on('tag_areas.agency_id', 'teams.agency_id')
                        ->on('tag_areas.team_id', 'teams.id')
                        ->where(function ($query) {
                            $query->where('tag_areas.taggable_type', \App\Models\Encampment\Camp::class)
                                ->orWhere('tag_areas.taggable_type', \App\Models\Encampment\Block::class);
                        });
                })
                    ->whereIn('tag_areas.taggable_id', $campBlockIds);
            })
            ->when(!is_null(data_get($params, 'search')), function ($query) use ($params) {
                $query->where(function ($query) use ($params) {
                    $query->where('agencies.agency_name', 'LIKE', '%' . data_get($params, 'search') . '%')
                        ->orwhere('teams.team_name', 'LIKE', '%' . data_get($params, 'search') . '%')
                        ->orwhere('teams.contact_person', 'LIKE', '%' . data_get($params, 'search') . '%')
                        ->orwhere('teams.email', 'LIKE', '%' . data_get($params, 'search') . '%')
                        ->orwhere('teams.mobile', 'LIKE', '%' . data_get($params, 'search') . '%');
                });
            });
        endif;

        //For Sort
        if ($sort && data_get($params, 'name')) :
            $query = $this->sortResult($query, data_get($params, 'name'), data_get($params, 'sort'));
        endif;

        // return $query->toSql();

        return $paginate ? $this->resultWithPagination($query, data_get($params, 'max_count') ?? 10) : $this->resultSet($query);
    }

    public function show($id)
    {
        $query   = $this->query();
        $result  = $query->findOrFail($id);
        return $result;
    }

    public function storeData($data)
    {
        // Storing Team Information
        $teamData = $data->only('agency_id', 'team_name', 'contact_person', 'mobile', 'email');
        $team = $this->store($teamData->toArray());

        // Storing User Information
        $user = $this->userDataHandler($data);

        // User Tag Team Information
        if (is_null($data['user_id'])) :
            $this->tagUserDataHandler($team, $user, $data['agency']);
        endif;

        // Storing Tagged Areas For Agency
        if (count($data['assigns']) != 0) :
            $this->tagAreaDataHandler($team, $data['assigns']);
        endif;
    }

    public function updateData($data, $id)
    {
        // Storing Agency Information
        $teamData = $data->except(['password', 'assigns', 'user_id']);
        $team = $this->update($teamData->toArray(), $id);

        // Storing User Information
        $user = $this->userDataHandler($data);

        // User Tag Agency Information
        if (is_null($data['user_id'])) :
            $this->tagUserDataHandler($team, $user, $data['agency']);
        endif;

        // Storing Tagged Areas For Agency
        if (count($data['assigns']) != 0) :
            $this->tagAreaDataHandler($team, $data['assigns']);
        endif;

        return $team;
    }

    private function userDataHandler($data)
    {
        $userData               = $data->only('email', 'mobile', 'password', 'role_id');
        $userData['name']       = $data['contact_person'];
        $userData['username']   = $this->getUserName(null, $data['email']);
        $userData['roles']      = [3];

        if (is_null($data['user_id'])) :
            $user = $this->user->storeData(collect($userData));
        else :
            $user = $this->user->updateData(collect($userData), $data['user_id']);
        endif;

        return $user;
    }

    private function tagUserDataHandler($reference, $data, $agency)
    {
        $users = [];

        // User Tag Agency and Team Information For New User
        if (!in_array($reference->agency_id, $agency)) :
            array_push($users, [
                'taggable_type' => \App\Models\Agency::class,
                'taggable_id'  => $reference->agency_id,
                'user_id'      => $data->id
            ]);
        endif;

        array_push($users, [
            'taggable_type' => \App\Models\Team::class,
            'taggable_id'  => $reference->id,
            'user_id'      => $data->id
        ]);

        $this->tagUser->store($users);
    }

    private function tagAreaDataHandler($reference, $data)
    {
        $areas = [];

        foreach ($data as $assign) :
            $areas[] = [
                'taggable_type' => \App\Models\Encampment\Camp::class,
                'taggable_id'   => $assign['camp_id'],
                'agency_id'     => $reference->agency_id,
                'team_id'       => $reference->id,
            ];
            foreach ($assign['block_id'] as $item) :
                $areas[] = [
                    'taggable_type' => \App\Models\Encampment\Block::class,
                    'taggable_id'   => $item,
                    'agency_id'     => $reference->agency_id,
                    'team_id'       => $reference->id,
                ];
            endforeach;
        endforeach;

        $this->tagArea->store($areas, ['agency_id' => $reference->agency_id, 'team_id' => $reference->id]);
    }

    public function destroy($id)
    {
        $data = [
            'team_id' => $id
        ];
        $this->tagArea->delete($data);
        $team = $this->delete($id);
        return $team;
    }
}
