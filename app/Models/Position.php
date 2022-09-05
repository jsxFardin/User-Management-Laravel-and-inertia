<?php

namespace App\Models;

use App\Traits\AutoUserActivityLog;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends BaseModel
{
    use HasFactory, AutoUserActivityLog;

    protected $guarded = ['id'];

    protected function name(): Attribute 
    {
        return Attribute::make(
            get: fn($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
