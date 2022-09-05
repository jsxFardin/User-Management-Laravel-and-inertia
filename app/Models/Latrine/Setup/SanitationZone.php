<?php

namespace App\Models\Latrine\Setup;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class SanitationZone extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'longitude',
        'latitude',
        'remarks',
        'active'
    ];
}
