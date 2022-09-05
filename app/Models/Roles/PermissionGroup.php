<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    use HasFactory;

    public $timestapms = false;

    protected $fillable = [
        'name',
        'label',
        'parent_id',
        'sort',
        'status',
    ];
}
