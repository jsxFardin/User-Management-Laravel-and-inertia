<?php
namespace App\Interfaces;

interface LatrineInterface
{
    public function lists($paginate = false, $params = null, $sort = false);
    public function total();
    public function show($id);
    public function storeData($data);
    public function updateData($data, $id);
}
