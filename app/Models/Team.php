<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Team extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_name',
        'agency_id',
        'contact_person',
        'email',
        'mobile',
        'active'
    ];

    public function agency()
    {
        return $this->hasOne(Agency::class);
    }

    public function tag_team()
    {
        return $this->morphOne(TagUser::class, 'taggable');
    }

    public function getUserTeamData($request, $ids = null)
    {
        return DB::table('teams')
            ->join('agencies', 'agencies.id', 'teams.agency_id')
            ->when(auth()->user()->isVolunteer(), function ($query) {
                $query->where('teams.active', 1)
                    ->where('agencies.active', 1);
            })
            ->when((!is_null($ids) &&  count($ids) != 0), function ($query) use ($ids) {
                $query->whereIn('teams.agency_id', $ids);
            })
            ->groupBy('teams.id')
            ->select('teams.*', 'agencies.agency_name as agency_name')
            ->when(!is_null($request->name), function ($query) use ($request) {
                $query->orderBy($request->name, $request->sort);
            })
            ->when(!is_null($request->search), function ($query) use ($request) {
                $query->where('agencies.agency_name', 'LIKE', '%' . $request->get('search') . '%')
                    ->orWhere('teams.team_name', 'LIKE', '%' . $request->get('search') . '%')
                    ->orWhere('teams.contact_person', 'LIKE', '%' . $request->get('search') . '%')
                    ->orWhere('teams.email', 'LIKE', '%' . $request->get('search') . '%')
                    ->orWhere('teams.mobile', 'LIKE', '%' . $request->get('search') . '%');
            })
            ->when(!is_null($request->agency), function ($query) use ($request) {
                $query->where('teams.agency_id', $request->agency);
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

    public function teamCampBlock($request, $only_id = false, $listVal = false)
    {
        $results = DB::table('tag_areas as ta')
            ->join('agencies as a', 'a.id', 'ta.agency_id')
            ->join('teams as t', 't.id', 'ta.team_id')
            ->when($request->has('agency_id'), function ($query) use ($request) {
                $query->whereIn('ta.agency_id', gettype($request->agency_id) == "array" ? $request->agency_id : [$request->agency_id]);
            })
            ->when($request->has('team_id'), function ($query) use ($request) {
                $query->whereIn('ta.team_id', gettype($request->team_id) == "array" ? $request->team_id : [$request->team_id]);
            })
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
                    });;
            })

            ->when($request->has('user_id'), function ($query) use ($request) {
                $query->leftJoin('tag_users as tu', function ($join) use ($request) {
                    $join->on('tu.taggable_id', '=', 'a.id')
                        ->where('tu.taggable_type', '=', \App\Models\Agency::class);
                })
                    ->whereIn('tu.user_id', gettype($request->user_id) == "array" ? $request->user_id : [$request->user_id]);
            })
            ->select(
                'ta.agency_id',
                'a.agency_name',
                'ta.team_id',
                't.team_name',
                'c.id as camp_id',
                'c.name as camp_name',
                'b.id as block_id',
                'b.name as block_name',
                'b.camp_id as block_camp_id',
                'c.short_name as camp_short_name',
                'b.short_name as block_short_name'
            )
            ->get();

        $indexs = $listVal ? ['value', 'label', 'short_name'] : ['id', 'name', 'short_name'];
        $datas = [];

        foreach ($results as $result) :
            if (!is_null($result->camp_id) && !array_key_exists($result->camp_id, $datas)) :
                $camp['agency_id'] = $result->agency_id;
                if (!$only_id) $camp['agency_name'] = $result->agency_name;
                $camp['team_id'] = $result->team_id;
                if (!$only_id) $camp['team_name'] = $result->team_name;
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

    public function getTeamBlocks($ids = null, $listVal = false)
    {
        $data = DB::table('blocks as b')
            ->join('tag_areas as ta', 'ta.taggable_id', 'b.id')
            ->join('agencies as a', 'a.id', 'ta.agency_id')
            ->where('a.active', 1)
            ->where('b.active', 1)
            ->when((!is_null($ids) && count($ids) != 0), function ($query) use ($ids) {
                $query->whereIn('a.id', $ids);
            })
            ->select('b.*')
            ->get();

        return $listVal ? $this->mappingIds($data, 'id', 'name') : $data;
    }

    public function AgencyTeams($ids, $listVal = false)
    {
        $data = DB::table('teams')
            ->whereIn('agency_id', $ids)
            ->get();

        return $listVal ? $this->mappingIds($data, 'id', 'team_name') : $data;
    }
}
