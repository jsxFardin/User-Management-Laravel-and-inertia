<?php
namespace App\Interfaces;

interface AgencyInterface
{
    public function query();
    public function lists($paginate = false, $params = null, $sort = false);
    public function storeData($data);
    public function updateData($data, $id);
    public function show($id);
    public function destroy($id);
}
