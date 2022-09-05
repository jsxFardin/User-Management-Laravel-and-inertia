<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagArea extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'agency_id',
        'taggable_type',
        'taggable_id',
        'team_id',
    ];

    
    public function taggable()
    {
        return $this->morphTo();
    }
}
