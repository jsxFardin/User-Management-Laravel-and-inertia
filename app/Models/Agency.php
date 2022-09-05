<?php

namespace App\Models;

use App\Models\Encampment\Camp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Agency extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'agency_name',
        'address',
        'contact_person',
        'phone',
        'email',
        'mobile',
        'active'
    ];

    public function tag_agency()
    {
        return $this->morphMany(TagUser::class, 'taggable');
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }

    public static function getUserAgencyData($request, $ids = null)
    {
        // dd($request->all());
        return $results = DB::table('agencies')
            // ->join('tag_areas as ta', 'ta.agency_id', 'agencies.id')
            ->select('agencies.*')
            // ->where('agencies.active', 1)
            ->when(!auth()->user()->isAdmin() && count($ids) != 0, function ($query) use ($ids) {
                $query->whereIn('agencies.id', $ids);
            })
            ->when($request->has('name') && !empty($request->name), function ($query) use ($request) {
                $query->orderBy($request->name, $request->sort);
            })
            ->when(!is_null($request->search), function ($query) use ($request) {
                $query->where('agency_name', 'LIKE', '%' . $request->get('search') . '%')
                    ->orwhere('contact_person', 'LIKE', '%' . $request->get('search') . '%')
                    ->orwhere('email', 'LIKE', '%' . $request->get('search') . '%')
                    ->orwhere('mobile', 'LIKE', '%' . $request->get('search') . '%');
            })
            ->when(!is_null($request->camp), function ($query) use ($request) {
                $query->join('tag_areas as cta', 'cta.agency_id', 'agencies.id');
                $query->join('camps as c', function ($join) use ($request) {
                    $join->on('c.id', '=', 'cta.taggable_id')
                        ->where('cta.taggable_type', '=', \App\Models\Encampment\Camp::class)
                        ->where('cta.taggable_id', $request->get('camp'));
                })->distinct('cta.agency_id');
            })
            ->when(!is_null($request->block), function ($query) use ($request) {
                $query->join('tag_areas as bta', 'bta.agency_id', 'agencies.id');
                $query->join('blocks as b', function ($join) use ($request) {
                    $join->on('b.id', '=', 'bta.taggable_id')
                        ->where('bta.taggable_type', '=', \App\Models\Encampment\Block::class)
                        ->where('bta.taggable_id', $request->get('block'));
                })->distinct('bta.agency_id');
            })
            ->paginate($request->max_count ?? 10);
    }

    public function agencyCampBlock($request, $only_id = false, $listVal = false)
    {
        $results = DB::table('tag_areas as ta')
            ->join('agencies as a', 'a.id', 'ta.agency_id')
            ->leftJoin('camps as c', function ($join) use ($request) {
                $join->on('c.id', '=', 'ta.taggable_id')
                    ->where('ta.taggable_type', '=', \App\Models\Encampment\Camp::class)
                    ->when($request->has('camp_id'), function ($query) use ($request) {
                        $query->whereIn('c.id', gettype($request->camp_id) == "array" ? $request->camp_id : [$request->camp_id]);
                    });
            })
            ->leftJoin('blocks as b', function ($join) use ($request) {
                $join->on('b.id', '=', 'ta.taggable_id')
                    ->where('ta.taggable_type', '=', \App\Models\Encampment\Block::class)
                    ->when($request->has('block_id'), function ($query) use ($request) {
                        $query->whereIn('b.id', gettype($request->block_id) == "array" ? $request->block_id : [$request->block_id]);
                    });
            })

            ->when($request->has('agency_id'), function ($query) use ($request) {
                $query->whereIn('agency_id', gettype($request->block_id) == "array" ? $request->agency_id : [$request->agency_id]);
            })
            ->when($request->has('user_id'), function ($query) use ($request) {
                $query->leftJoin('tag_users as tu', function ($join) use ($request) {
                    $join->on('tu.taggable_id', '=', 'a.id')
                        ->where('tu.taggable_type', '=', \App\Models\Agency::class);
                })
                    ->whereIn('tu.user_id', gettype($request->user_id) == "array" ? $request->user_id : [$request->user_id]);
            })
            ->whereNull('team_id')
            ->select(
                'ta.agency_id',
                'a.agency_name',
                'ta.team_id',
                'c.id as camp_id',
                'c.name as camp_name',
                'c.short_name as camp_short_name',
                'b.id as block_id',
                'b.name as block_name',
                'b.camp_id as block_camp_id',
                'b.short_name as block_short_name'
            )
            ->get();

        $indexs = $listVal ? ['value', 'label', 'short_name'] : ['id', 'name', 'short_name'];
        $datas = [];

        foreach ($results as $result) :
            if (!is_null($result->camp_id) && !array_key_exists($result->camp_id, $datas)) :
                $camp['agency_id'] = $result->agency_id;
                if (!$only_id) $camp['agency_name'] = $result->agency_name;
                $camp[!$only_id ? 'camp' : 'camp_id'] = !$only_id ?
                    array_combine($indexs, [$result->camp_id, $result->camp_name, $result->camp_short_name]) : $result->camp_id;
                $camp[!$only_id ? 'blocks' : 'block_id'] = [];

                $datas[$result->camp_id] = $camp;
            endif;

            if (!is_null($result->block_id) && array_key_exists($result->block_camp_id, $datas)) :
                $arr = array_combine($indexs, [$result->block_id, $result->block_name, $result->block_short_name]);
                $arr['camp_id'] = $result->block_camp_id;

                $datas[$result->block_camp_id][!$only_id ? 'blocks' : 'block_id'][] = !$only_id ? $arr : $result->block_id;
            endif;
        endforeach;

        return array_values($datas);
    }

    public function campBlocks($request, $listVal = false)
    {
        $data = DB::table('blocks as b')
            ->when($request->has('agency_id'), function ($query) use ($request) {
                $query->join('tag_areas as ta', 'ta.taggable_id', 'b.id')
                    ->where('ta.agency_id', $request->get('agency_id'))
                    ->groupBy('b.id');
            })
            ->when($request->has('camp_id'), function ($query) use ($request) {
                $query->where('b.camp_id', $request->get('camp_id'))
                    ->whereNull('b.parent_id');
            })
            ->select('b.id', 'b.short_name as name')
            ->get();

        return $listVal ? $this->mappingIds($data, 'id', 'name') : $data;
    }
}
