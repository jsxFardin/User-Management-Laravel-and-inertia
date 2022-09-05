<?php

namespace App\Models\Encampment;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\DB;

class Camp extends BaseModel
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'short_name',
        'name',
        'location',
        'longitude',
        'latitude',
        'area',
        'active'
    ];

    /**
     * Interact with the user's address.
     *
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    public function getScopedCamps($request, $ids = null, $listVal = false)
    {
        $results = DB::table('camps')
            ->select('*')
            ->where('active', 1)
            ->get();

        return $listVal ? $this->mappingIds($results, 'id', 'name') : $results;
    }
    public function getScopedCampsByAgency($request, $ids = null, $listVal = false)
    {
        $results = [];
        if (count($ids) < 1) {
            $results = DB::table('camps')
                ->select('*')
                ->where('active', 1)
                ->get();
        } else {
            $results = DB::table('agencies')
                ->join('tag_areas as ta', 'ta.agency_id', 'agencies.id')
                ->join('camps as c', function ($join) use ($ids) {
                    $join->on('c.id', '=', 'ta.taggable_id')
                        ->where('ta.taggable_type', '=', \App\Models\Encampment\Camp::class)
                        ->whereIn('ta.agency_id', $ids);
                })->distinct('ta.taggable_id')
                ->select('c.*')
                ->get();
        }

        return $listVal ? $this->mappingIds($results, 'id', 'name') : $results;
    }
}
