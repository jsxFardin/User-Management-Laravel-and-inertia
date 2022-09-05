<?php
namespace App\Interfaces;

interface BlockInterface
{
    public function query();
    public function lists($paginate = false, $params = null, $sort = false);
}
