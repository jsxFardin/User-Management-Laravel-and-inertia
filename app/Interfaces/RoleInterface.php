<?php
namespace App\Interfaces;

interface RoleInterface
{
    public function lists($paginate = false, $params = null, $sort = false);
    public function store($data, $batch = false);
    public function update($data, $id);
}
