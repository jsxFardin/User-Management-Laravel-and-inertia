<?php
namespace App\Interfaces;

interface CampInterface
{
    public function lists($paginate = false, $params = null, $sort = false);
    public function show($id);
}
