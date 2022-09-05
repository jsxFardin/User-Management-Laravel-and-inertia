<?php

namespace App\Models\Encampment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\DB;

class Block extends Model
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
        'camp_id',
        'parent_id',
        'short_name',
        'name',
        'longitude',
        'latitude',
        'area',
        'number_of_family',
        'number_of_house',
        'population',
        'active'
    ];

    public function latrines() {
        return $this->hasMany(Latrine::class);
    }

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

    public function getBlockParent($request)
    {
        return DB::table('blocks')->select('id as value', 'name as label', 'short_name')
            ->where([
                ['active', 1],
                ['parent_id', $request->get_parent_id],
            ])->get();
    }

    public function getScopedCampBlocks($request, $ids = null, $listVal = false)
    {
        $results = DB::table('blocks')
            ->whereNull('parent_id')
            ->when(!is_null($ids), function($query) use($ids) {
                $query->whereIn('camp_id', $ids);
            })
            ->select('id as value', 'short_name as label', 'camp_id')
            ->get();

        // if(!is_null($ids)):
            return json_decode($results, true);
        // endif;

        // dd($results);

        // $array = [];

        // foreach($results as $result):
        //     $array[$result->camp_id][] = $result;
        // endforeach;

        // return array_values($array);
    }
}
