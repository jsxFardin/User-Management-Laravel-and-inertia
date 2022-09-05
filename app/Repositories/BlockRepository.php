<?php

namespace App\Repositories;

use App\Interfaces\BlockInterface;
use App\Models\Encampment\Block;

class BlockRepository extends BaseRepository implements BlockInterface
{
    protected $block;

    public function __construct(Block $block)
    {
        $this->block = $block;
    }

    public function query()
    {
        return $this->block
            ->join('camps', 'camps.id', 'blocks.camp_id')
            ->leftJoin('blocks as sub_blocks', 'sub_blocks.id', 'blocks.parent_id')
            ->when(!$this->isAdmin, function($query) {
                $query->join('tag_areas', function($join) {
                        $join->on('tag_areas.taggable_id', 'blocks.id')
                            ->where('tag_areas.taggable_type', \App\Models\Encampment\Block::class)
                            ->when($this->isAgency, function($query){
                                $query->whereNull('team_id');
                            });
                    })
                    ->join('tag_users', function($join){
                        $join->on('tag_users.taggable_id', 'tag_areas.agency_id')
                            ->where('tag_users.taggable_type', \App\Models\Agency::class);
                    })
                    ->when(!$this->isAgency, function($query){
                        $query->join('tag_users as tag_users_team', function($join){
                            $join->on('tag_users_team.taggable_id', 'tag_areas.team_id')
                                ->where('tag_users_team.taggable_type', \App\Models\Team::class);
                        });
                    })
                    ->when(!is_null($this->userinfo), function($query) {
                        $query->whereIn('tag_users.user_id', [$this->userinfo->id])
                            ->when(!$this->isAgency, function($query) {
                                $query->whereIn('tag_users_team.user_id', [$this->userinfo->id]);
                            });
                    });
            })
            ->select(
                'blocks.*', 'camps.name as camp_name', 'sub_blocks.short_name as parent_name'
            )
            ->groupBy('blocks.id');
    }

    public function lists($paginate = false, $params = null, $sort = false)
    {
        $query = $this->query();

        if(!is_null($params) && count($params)):
            $query->when(!is_null(data_get($params, 'camp')), function($query) use($params) {
                    $query->whereIn('blocks.camp_id', gettype(data_get($params, 'camp')) == "array" ? data_get($params, 'camp') : [data_get($params, 'camp')]);
                })
                ->when(!is_null(data_get($params, 'block')), function($query) use($params) {
                    $query->where(function($query) use($params) {
                        $blockIds = gettype(data_get($params, 'block')) == "array" ? data_get($params, 'block') : [data_get($params, 'block')];
                        $query->whereIn('blocks.id', $blockIds)
                            ->orWhereIn('blocks.parent_id', $blockIds);
                    });
                })
                ->when(!is_null(data_get($params, 'search')), function ($query) use ($params) {
                    $query->where(function($query) use ($params) {
                        $query->where('camps.name', 'LIKE', '%' . data_get($params, 'search') . '%')
                            ->orwhere('blocks.name', 'LIKE', '%' . data_get($params, 'search') . '%')
                            ->orwhere('blocks.short_name', 'LIKE', '%' . data_get($params, 'search') . '%')
                            ->orwhere('sub_blocks.name', 'LIKE', '%' . data_get($params, 'search') . '%')
                            ->orwhere('sub_blocks.short_name', 'LIKE', '%' . data_get($params, 'search') . '%');
                    });
                });;
        endif;

        if(data_get($params, 'parent_id')):
            $query->whereIn('blocks.parent_id', gettype(data_get($params, 'parent_id')) == "array" ? data_get($params, 'parent_id') : [data_get($params, 'parent_id')]);
        endif;

        if(!$sort && is_null(data_get($params, 'parent_id'))):
            $query->whereNull('blocks.parent_id');
        endif;

        //For Sort
        if($sort && data_get($params, 'name')):
            $query = $this->sortResult($query, data_get($params, 'name'), data_get($params, 'sort'));
        endif;

        return $paginate ? $this->resultWithPagination($query, data_get($params, 'max_count') ?? 10) : $this->resultSet($query);
    }
}
