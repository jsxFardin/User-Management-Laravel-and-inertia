<?php

namespace App\Interfaces;

interface DesludgeInterface
{
    public function lists($paginate = false, $params = null, $sort = false);
    public function yearMonth();
    public function show($id);
}
