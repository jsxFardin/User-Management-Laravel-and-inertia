<?php

namespace App\Repositories;

use App\Interfaces\TagAreaInterface;
use App\Models\TagArea;

class TagAreaRepository implements TagAreaInterface
{
    protected $tags;

    public function __construct(TagArea $tags)
    {
        $this->tags = $tags;
    }

    public function store($data, $conditions)
    {
        $this->delete($conditions);

        return $this->tags->insert($data);
    }

    public function delete($data)
    {
        return $this->tags
            ->when(data_get($data, 'agency_id'), function($query) use($data) {
                $query->whereIn('agency_id', gettype(data_get($data, 'agency_id')) == "array" ? data_get($data, 'agency_id') : [data_get($data, 'agency_id')]);
            })
            ->when(data_get($data, 'team_id'), function($query) use($data) {
                $query->whereIn('team_id', gettype(data_get($data, 'team_id')) == "array" ? data_get($data, 'team_id') : [data_get($data, 'team_id')]);
            })
            ->when(!data_get($data, 'team_id'), function($query){
                $query->whereNull('team_id');
            })
            ->when(data_get($data, 'taggable_type'), function($query) use($data) {
                $query->where('taggable_type', $data['taggable_type']);
            })
            ->when(data_get($data, 'taggable_id'), function($query) use($data) {
                $query->whereIn('taggable_id', gettype(data_get($data, 'taggable_id')) == "array" ? data_get($data, 'taggable_id') : [data_get($data, 'taggable_id')]);
            })
            ->delete();
    }
}
