<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class BaseRepository {
    protected $userinfo;
    protected $isAdmin;
    protected $isAgency;
    protected $isSupervisor;

    public function setAuthId($id)
    {
        $user = DB::table('users')
            ->join('role_user', 'role_user.user_id', 'users.id')
            ->join('roles', 'roles.id', 'role_user.role_id')
            ->select('users.id', 'users.id_no', 'users.name', 'users.username', 'users.email', 'users.mobile', 'users.active', 'roles.id as role_id', 'roles.name as role_name')
            ->selectRaw("case roles.id
                    when 1 then 'isAdmin'
                    when 2 then 'isAgency'
                    when 3 then 'isSupervisor'
                    ELSE 'isVolunteer'
                end as role_type")
            ->where('users.id', $id)
            ->first();

        $this->userinfo = $user;
        $this->isAdmin = $user->role_type == "isAdmin";
        $this->isAgency = $user->role_type == "isAgency";
        $this->isSupervisor = $user->role_type == "isSupervisor";
        $this->isVolunteer = $user->role_type == "isVolunteer";
    }

    public function resultWithPagination($results, $max_count)
    {
        return $results->paginate($max_count);
    }

    public function resultSet($results)
    {
        return $results->get();
    }

    public function sortResult($result, $name, $sort)
    {
        return $result->orderBy($name, $sort);
    }
}
