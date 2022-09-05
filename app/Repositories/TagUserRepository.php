<?php

namespace App\Repositories;

use App\Interfaces\TagUserInterface;
use App\Models\TagUser;

class TagUserRepository implements TagUserInterface
{
    protected $tags;

    public function __construct(TagUser $tags)
    {
        $this->tags = $tags;
    }

    public function store($data)
    {
        return $this->tags->insert($data);
    }

    public function delete($data)
    {
        return $this->tags
            ->when(data_get($data, 'user_id'), function($query) use($data) {
                $query->whereIn('user_id', gettype(data_get($data, 'user_id')) == "array" ? data_get($data, 'user_id') : [data_get($data, 'user_id')]);
            })
            ->when(data_get($data, 'taggable_type'), function($query) use($data) {
                $query->whereIn('taggable_type', gettype(data_get($data, 'taggable_type')) == "array" ? data_get($data, 'taggable_type') : [data_get($data, 'taggable_type')]);
            })
            ->when(data_get($data, 'taggable_id'), function($query) use($data) {
                $query->whereIn('taggable_id', gettype(data_get($data, 'taggable_id')) == "array" ? data_get($data, 'taggable_id') : [data_get($data, 'taggable_id')]);
            })
            ->delete();
    }
}
