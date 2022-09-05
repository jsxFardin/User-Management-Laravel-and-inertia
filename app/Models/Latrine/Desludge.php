<?php

namespace App\Models\Latrine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Desludge extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['collection_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'collection_date',
        'latrine_id',
        'pit_type_id',
        'sludge_transfer_id',
        'dia_of_ring',
        'count_desludge_ring',
        'dimension_of_septic_tank',
        'desludged_height_from_top',
        'total_volume_desludged',
        'see_foreign_materials',
        'septic_tank_id_ts_number',
        'ring_left_behind',
        'litre_of_petrol',
        'man_woman_days_used',
        'remarks',
        'status',
    ];
}
