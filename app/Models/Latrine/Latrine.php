<?php

namespace App\Models\Latrine;

use App\Models\Encampment\Block;
use App\Traits\UniqueIdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;

class Latrine extends Model
{
    use HasFactory, UniqueIdGenerator;

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
        'uid_no',
        'camp_id',
        'block_id',
        'facility_type_id',
        'facility_used_id',
        'construction_status_id',
        'latrine_structure_id',
        'pit_type_id',
        'pwsn',
        'constructor_id',
        'chamber_door',
        'male_number_stickers',
        'male_number_user',
        'female_number_stickers',
        'female_number_user',
        'children_number',
        'common_shared',
        'functional',
        'non_functional',
        'min_or_repair',
        'pwsn_hand_rail_outside',
        'pwsn_hand_rail_inside',
        'pwsn_ramp',
        'pwsn_stair',
        'pwsn_high_commode',
        'hwd',
        'hwd_water',
        'hwd_soap',
        'longitude',
        'latitude',
        'total_chamber',
        'total_ring_number',
        'dia_of_ring',
        'septic_tank_dimension',
        'total_volume',
        'remarks',
        'active',
        'sub_block_id',
        'sanitation_zone_id'
    ];

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    public function getScopedLatrines($request, $paginate = true)
    {
        // DB::enableQueryLog();
        $results = DB::table('latrine_with_desludges_reports')
            // ->join('camps as cmp', 'lt.camp_id', 'cmp.id')
            // ->join('blocks as blk', 'lt.block_id', 'blk.id')
            // ->leftJoin('blocks as sblk', 'lt.sub_block_id', 'sblk.id')
            // ->join('facility_types as ft', 'lt.facility_type_id', 'ft.id')
            // ->join('facility_useds as fu', 'lt.facility_used_id', 'fu.id')
            // ->join('construction_status as cns', 'lt.construction_status_id', 'cns.id')
            // ->join('latrine_structures as lst', 'lt.latrine_structure_id', 'lst.id')
            // ->join('pit_types as pt', 'lt.pit_type_id', 'pt.id')
            // ->leftJoin('donors as dnr', 'lt.constructor_id', 'dnr.id')
            // ->leftJoin('desludges as des', 'des.latrine_id', 'lt.id')
            // ->select('lt.*', 'cmp.name as camp_name', 'blk.name as block_name', 'ft.name as facility_type_name',
            //     'fu.name as facility_used_name', 'cns.name as construction_status_name', 'lst.name as latrine_structure_name',
            //     'pt.name as pit_type_name', 'dnr.name as donor_name', 'sblk.name as sub_block_name')
            // ->selectRaw('MAX(DATE(des.collection_date)) AS last_desludge_date')
            // ->selectRaw('DATE_ADD(MAX(DATE(des.collection_date)), INTERVAL FLOOR(TIMESTAMPDIFF(DAY,
            //     min(des.collection_date),
            //     max(des.collection_date)
            // ) / (count(*) - 1)) DAY) as next_desludge_date')
            ->when(!auth()->user()->isAdmin(), function ($query) use ($request) {
                $query->when($request->has('camps'), function ($query) use ($request) {
                    $query->when(gettype($request->get('camps')) == "array", function ($query) use ($request) {
                        $query->whereIn('camp_id', $request->get('camps'));
                    });
                    $query->when(gettype($request->get('camps')) != "array", function ($query) use ($request) {
                        $query->where('camp_id', $request->get('camps'));
                    });
                })
                    ->when($request->has('blocks'), function ($query) use ($request) {
                        $query->when(gettype($request->get('blocks')) == "array", function ($query) use ($request) {
                            $query->whereIn('block_id', $request->get('blocks'));
                        });
                        $query->when(gettype($request->get('blocks')) != "array", function ($query) use ($request) {
                            $query->where('block_id', $request->get('blocks'));
                        });
                    });
            })
            //For Sort
            ->when($request->has('name'), function($query) use ($request){
                $query->orderBy($request->name, $request->sort);
            })
            // For Filter
            ->when(!is_null($request->uid_no), function($query) use($request) {
                $query->where('uid_no', $request->get('uid_no'));
            })
            ->when(!is_null($request->camp), function($query) use($request) {
                $query->where('camp_id', $request->get('camp'));
            })
            ->when(!is_null($request->block), function($query) use($request) {
                $query->where('block_id', $request->get('block'));
            })
            ->when(!is_null($request->facility_type), function($query) use($request) {
                $query->where('facility_type_id', $request->get('facility_type'));
            })
            ->when(!is_null($request->facility_used), function($query) use($request) {
                $query->where('facility_used_id', $request->get('facility_used'));
            })
            ->when( !is_null($request->latrine_structure), function($query) use($request) {
                $query->where('latrine_structure_id', $request->get('latrine_structure'));
            })
            ->when(!is_null($request->construction_status), function($query) use($request) {
                $query->where('construction_status_id', $request->get('construction_status'));
            })
            ->when(!is_null($request->sanitation_zone), function($query) use($request) {
                $query->where('sanitation_zone_id', $request->get('sanitation_zone'));
            });

        return $paginate ? $results->paginate($request->max_count ?? 10) : $results->get();
    }

    public function getScopedLatrineZones($request, $paginate = true)
    {
        // DB::enableQueryLog();
        $results = DB::table('latrine_with_desludges_reports')
            ->when(!auth()->user()->isAdmin(), function ($query) use ($request) {
                $query->when($request->has('camps'), function ($query) use ($request) {
                    $query->when(gettype($request->get('camps')) == "array", function ($query) use ($request) {
                        $query->whereIn('camp_id', $request->get('camps'));
                    });
                    $query->when(gettype($request->get('camps')) != "array", function ($query) use ($request) {
                        $query->where('camp_id', $request->get('camps'));
                    });
                })
                    ->when($request->has('blocks'), function ($query) use ($request) {
                        $query->when(gettype($request->get('blocks')) == "array", function ($query) use ($request) {
                            $query->whereIn('block_id', $request->get('blocks'));
                        });
                        $query->when(gettype($request->get('blocks')) != "array", function ($query) use ($request) {
                            $query->where('block_id', $request->get('blocks'));
                        });
                    });
            })
            //For Sort
            ->when($request->has('name'), function($query) use ($request){
                $query->orderBy($request->name, $request->sort);
            })
            // For Filter
            ->when(!is_null($request->uid_no), function($query) use($request) {
                $query->where('uid_no', $request->get('uid_no'));
            })
            ->when(!is_null($request->camp), function($query) use($request) {
                $query->where('camp_id', $request->get('camp'));
            })
            ->when(!is_null($request->block), function($query) use($request) {
                $query->where('block_id', $request->get('block'));
            })
            ->when(!is_null($request->facility_type), function($query) use($request) {
                $query->where('facility_type_id', $request->get('facility_type'));
            })
            ->when(!is_null($request->facility_used), function($query) use($request) {
                $query->where('facility_used_id', $request->get('facility_used'));
            })
            ->when( !is_null($request->latrine_structure), function($query) use($request) {
                $query->where('latrine_structure_id', $request->get('latrine_structure'));
            })
            ->when(!is_null($request->construction_status), function($query) use($request) {
                $query->where('construction_status_id', $request->get('construction_status'));
            })
            ->when(!is_null($request->sanitation_zone), function($query) use($request) {
                $query->where('sanitation_zone_id', $request->get('sanitation_zone'));
            })
            ->select('sanitation_zone_id', 'sanitation_zone_name')
            ->selectRaw('COUNT(DISTINCT IF(days_left <= 3, id, NULL)) AS danger')
            ->selectRaw('COUNT(DISTINCT IF(days_left > 3 AND days_left <= 6, id, NULL)) AS warning')
            ->selectRaw('count(id) as total')
            ->groupBy('sanitation_zone_id');

        return $paginate ? $results->paginate($request->max_count ?? 10) : $results->get();
    }

    public function showLatrine($latrine)
    {
        return DB::table('latrines as lt')
            ->where('lt.id', $latrine->id)
            ->join('camps as cmp', 'lt.camp_id', 'cmp.id')
            ->join('blocks as blk', 'lt.block_id', 'blk.id')
            ->leftJoin('blocks as sblk', 'lt.sub_block_id', 'sblk.id')
            ->join('facility_types as ft', 'lt.facility_type_id', 'ft.id')
            ->join('facility_useds as fu', 'lt.facility_used_id', 'fu.id')
            ->join('construction_status as cns', 'lt.construction_status_id', 'cns.id')
            ->join('latrine_structures as lst', 'lt.latrine_structure_id', 'lst.id')
            ->join('pit_types as pt', 'lt.pit_type_id', 'pt.id')
            ->leftJoin('donors as dnr', 'lt.constructor_id', 'dnr.id')
            ->select(
                'lt.id',
                'lt.uid_no',
                'cmp.name as camp_name',
                'blk.name as block_name',
                'ft.name as facility_type_name',
                'fu.name as facility_used_name',
                'cns.name as construction_status_name',
                'lst.name as latrine_structure_name',
                'pt.name as pit_type_name',
                'dnr.name as donor_name',
                'lt.pwsn',
                'lt.chamber_door',
                'lt.male_number_stickers',
                'lt.male_number_user',
                'lt.female_number_stickers',
                'lt.female_number_user',
                'lt.children_number',
                'lt.common_shared',
                'lt.functional',
                'lt.non_functional',
                'lt.min_or_repair',
                'lt.pwsn_hand_rail_outside',
                'lt.pwsn_hand_rail_inside',
                'lt.pwsn_ramp',
                'lt.pwsn_stair',
                'lt.pwsn_high_commode',
                'lt.hwd',
                'lt.hwd_water',
                'lt.hwd_soap',
                'lt.longitude',
                'lt.latitude',
                'lt.total_chamber',
                'lt.total_ring_number',
                'lt.dia_of_ring',
                'lt.septic_tank_dimension',
                'lt.total_volume',
                'lt.remarks',
                'lt.active'
            )->first();
    }

    public function generateLatrineId($request)
    {
        $uniqueId = $this->getUniqueID(Latrine::max('id'), 4);
        return 'L-' .(!is_null($request->camp_sn) ? $request->camp_sn .'-' : '').
                (!is_null($request->block_sn) ? $request->block_sn :'').
                (!is_null($request->subBlock_sn)? $request->subBlock_sn .'-' : '').
                (!is_null($request->total_chamber)? 'D'.$request->total_chamber .'-' : '').
                $uniqueId;
    }
}
