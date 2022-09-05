<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;



    public function mappingIds($data, string $value, string $label){
        return $data->map(function($item) use($value, $label){
            return [
                'value' => data_get($item, $value),
                'label' => data_get($item, $label),
            ];
        });
    }
}
