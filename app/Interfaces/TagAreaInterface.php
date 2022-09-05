<?php

namespace App\Interfaces;

interface TagAreaInterface {

    public function store($data, $conditions);
    public function delete($data);

}
