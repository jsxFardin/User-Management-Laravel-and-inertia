<?php

namespace App\Interfaces;

interface TeamInterface
{
    public function query();
    public function lists($paginate = false, $params = null, $sort = false);
    public function storeData($data);
    public function updateData($data, $id);
    public function show($id);
    public function delete($id);
    public function destroy($id);
}
