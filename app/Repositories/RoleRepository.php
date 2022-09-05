<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;
use App\Models\Role;

class RoleRepository extends BaseRepository implements RoleInterface
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    private function query(){
        return $this->role
            ->when(!is_null(data_get($this->userinfo, 'role_id')), function($query){
                $query->where('id', '>=' , $this->userinfo->role_id);
            });
    }

    public function lists($paginate = false, $params = null, $sort = false)
    {
        $query = $this->query();

        //For Sort
        if ($sort && data_get($params, 'name')) :
            $query = $this->sortResult($query, data_get($params, 'name'), data_get($params, 'sort'));
        endif;

        return $paginate ? $this->resultWithPagination($query, data_get($params, 'max_count') ?? 10) : $this->resultSet($query);
    }

    public function store($data, $batch = false)
    {
        if($batch):
            return $this->role->Insert($data);
        else:
            return $this->role->create($data);
        endif;
    }

    public function update($data, $id)
    {
        $this->role->where('id', $id)->update($data);
        return $data;
    }
}
