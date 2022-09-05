<?php

namespace App\Traits;

trait FormateDropDown
{
    public function formateDropDown($data)
    {
        return $data->map(function ($item) {
            return [
                'value' => data_get($item, 'id'),
                'label' => data_get($item, 'name'),
                'short_name' => data_get($item, 'short_name'),
            ];
        });
    }
}
