<?php

namespace App\Repositories;

use App\Interfaces\CampInterface;
use App\Models\Encampment\Camp;

class CampRepository extends BaseRepository implements CampInterface
{
    protected $camp;

    public function __construct(Camp $camp)
    {
        $this->camp = $camp;
    }

    private function query()
    {
        return $this->camp
            ->join('blocks', function($join){
                $join->on('blocks.camp_id', 'camps.id')
                    ->whereNull('blocks.parent_id');
            })
            ->leftJoin('tag_areas', function($join) {
                $join->on('tag_areas.taggable_id', 'camps.id')
                    ->where('tag_areas.taggable_type', \App\Models\Encampment\Camp::class)
                    ->when($this->isAgency, function($query){
                        $query->whereNull('team_id');
                    });
            })
            ->leftJoin('agencies', 'agencies.id', 'tag_areas.agency_id')
            ->when(!$this->isAdmin, function($query) {
                $query->join('tag_users', function($join){
                        $join->on('tag_users.taggable_id', 'tag_areas.agency_id')
                            ->where('tag_users.taggable_type', \App\Models\Agency::class);
                    })
                    ->when(!$this->isAgency, function($query){
                        $query->join('tag_users as tag_users_team', function($join){
                            $join->on('tag_users_team.taggable_id', 'tag_areas.team_id')
                                ->where('tag_users_team.taggable_type', \App\Models\Team::class);
                        });
                    })
                    ->when(!is_null($this->userinfo), function($query)  {
                        $query->whereIn('tag_users.user_id', [$this->userinfo->id])
                        ->when(!$this->isAgency, function($query)  {
                            $query->whereIn('tag_users_team.user_id', [$this->userinfo->id]);
                        });
                    });
            })
            ->select('camps.*', 'blocks.id as block_id')
            ->selectRaw('(GROUP_CONCAT(
                DISTINCT CONCAT(blocks.id,"|",blocks.short_name,"|",blocks.camp_id,"|",blocks.name)
                ORDER BY blocks.id ASC
                SEPARATOR ","
            )) AS block')
            ->selectRaw('(GROUP_CONCAT(
                DISTINCT CONCAT(agencies.id,"|",agencies.agency_name)
                ORDER BY agencies.id ASC
                SEPARATOR ","
            )) AS agency')
            ->groupBy('camps.id');
    }

    public function lists($paginate = false, $params = null, $sort = false)
    {
        $query = $this->query();

        if(!is_null($params) && count($params)):
            $query->when(!is_null(data_get($params, 'search')), function($query) use($params) {
                $query->where('camps.name', 'LIKE', '%' . data_get($params, 'search') . '%')
                    ->orwhere('camps.short_name', 'LIKE', '%' . data_get($params, 'search') . '%')
                    ->orwhere('camps.location', 'LIKE', '%' . data_get($params, 'search') . '%')
                    ->orwhere('camps.longitude', 'LIKE', '%' . data_get($params, 'search') . '%')
                    ->orwhere('camps.latitude', 'LIKE', '%' . data_get($params, 'search') . '%')
                    ->orwhere('camps.area', 'LIKE', '%' . data_get($params, 'search') . '%');
            });
        endif;

        //For Sort
        if($sort && data_get($params, 'name')):
            $query = $this->sortResult($query, data_get($params, 'name'), data_get($params, 'sort'));
        endif;

        return $paginate ? $this->resultWithPagination($query, data_get($params, 'max_count') ?? 10) : $this->resultSet($query);
    }

    public function show($id)
    {
        $query = $this->query(['isAdmin' => $this->isAdmin, 'isAgency' => $this->isAgency, 'user' => [$this->userinfo ? $this->userinfo->id : '']]);

        return $query->findOrFail($id);
    }
}
