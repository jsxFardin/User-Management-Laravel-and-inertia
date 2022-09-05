<?php

namespace App\Interfaces;

interface SanitizationZoneInterface {

    public function query();
    public function lists($paginate = false, $params = null, $sort = false);
    public function store($data, $conditions);
    public function delete($data);
}
