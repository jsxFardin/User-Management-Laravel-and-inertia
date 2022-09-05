<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'active'
    ];
    protected $hidden = [
        'type',
    ];

    /**
     * Interact with the user's address.
     *
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    public function permissions()
    {
        return $this->belongsToMany(\App\Models\Roles\Permission::class);
    }

    static function rolesUser($user)
    {
        $roles_ids = [];

        foreach ($user->roles as $role) {
            $roles_ids[] = $role->id;
        }

        return $roles_ids;
    }

    public function getRoles()
    {
        return DB::table('roles')
            ->when(auth()->user()->roles[0]->id, function($query) {
                $query->where('id', '>=' , auth()->user()->roles[0]->id);
            })
            ->select('id as value', 'name as label')->get();
    }
}
