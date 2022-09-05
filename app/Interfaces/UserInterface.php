<?php
namespace App\Interfaces;

interface UserInterface
{
    public function query();
    public function lists($paginate = false, $params = null, $sort = false);
    public function total($params = null);
    public function show($id);
    public function storeData($data);
    public function updateData($data, $id);
    public function store($data, $batch = false);
    public function update($data, $id);
}
