<?php

namespace App\Repositories;

use App\Interfaces\SanitizationZoneInterface;
use App\Models\Latrine\Setup\SanitationZone;
use Illuminate\Support\Facades\DB;

class SanitizationZoneRepository extends BaseRepository implements SanitizationZoneInterface
{
    protected $zone;

    public function __construct(SanitationZone $zone)
    {
        $this->zone = $zone;
    }

    public function query()
    {
        $params = ['isAdmin' => $this->isAdmin, 'isAgency' => $this->isAgency, 'user' => $this->userinfo->id];

        return DB::table('sanitation_zones')
            ->join('latrine_with_desludges_reports', 'latrine_with_desludges_reports.sanitation_zone_id', 'sanitation_zones.id')
            ->when(!is_null(data_get($params, 'isAdmin')) && !data_get($params, 'isAdmin'), function($query) use($params) {
                $query->join('tag_areas as tag_camps', function($join) use($params) {
                    $join->on('tag_camps.taggable_id', 'latrine_with_desludges_reports.camp_id')
                        ->where('tag_camps.taggable_type', \App\Models\Encampment\Camp::class)
                        ->when(!is_null(data_get($params, 'isAgency')) && data_get($params, 'isAgency'), function($query){
                            $query->whereNull('tag_camps.team_id');
                        });
                })
                ->join('tag_areas as tag_blocks', function($join) use($params){
                    $join->on('tag_blocks.taggable_id', 'latrine_with_desludges_reports.block_id')
                        ->where('tag_blocks.taggable_type', \App\Models\Encampment\Block::class)
                        ->when(!is_null(data_get($params, 'isAgency')) && data_get($params, 'isAgency'), function($query){
                            $query->whereNull('tag_blocks.team_id');
                        });
                })
                ->join('tag_users as tag_agency_users', function($join){
                    $join->on('tag_agency_users.taggable_id','tag_camps.agency_id')
                        ->on('tag_agency_users.taggable_id', 'tag_blocks.agency_id')
                        ->where('tag_agency_users.taggable_type', \App\Models\Agency::class);
                })
                ->where('tag_agency_users.user_id', data_get($params, 'user'))
                ->when(!is_null(data_get($params, 'isAgency')) && !data_get($params, 'isAgency'), function($query) use($params){
                    $query->join('tag_users as tag_team_users', function($join){
                        $join->on('tag_team_users.taggable_id', 'tag_blocks.team_id')
                            ->on('tag_team_users.taggable_id', 'tag_blocks.team_id')
                            ->where('tag_team_users.taggable_type', \App\Models\Team::class);
                    })
                    ->where('tag_team_users.user_id', data_get($params, 'user'));
                });
            })
            ->select('sanitation_zones.id', 'sanitation_zones.name', 'sanitation_zones.longitude', 'sanitation_zones.latitude', 'sanitation_zones.remarks', 'sanitation_zones.active', 'latrine_with_desludges_reports.camp_name', 'latrine_with_desludges_reports.block_name')
            ->selectRaw('(SELECT COUNT(id) FROM latrines WHERE latrines.sanitation_zone_id = sanitation_zones.id ) as total_latrine')
            ->selectRaw('MAX(latrine_with_desludges_reports.last_desludge_date) as last_desludge_date')
            ->selectRaw('(
                SELECT
                    MIN(lwdr.next_desludge_date)
                FROM latrine_with_desludges_reports as lwdr
                WHERE DATE(lwdr.next_desludge_date) > (SELECT MAX(lwdr1.last_desludge_date) FROM latrine_with_desludges_reports as lwdr1)
                AND lwdr.sanitation_zone_id = sanitation_zones.id
                GROUP BY lwdr.sanitation_zone_id
            ) as next_desludge_date')
            ->selectRaw('SUM(latrine_with_desludges_reports.last_volume_desludged) as last_volume_desludged')
            ->selectRaw('COUNT(DISTINCT IF(latrine_with_desludges_reports.days_left <= 3, latrine_with_desludges_reports.id, NULL)) AS danger')
            ->selectRaw('COUNT(DISTINCT IF(latrine_with_desludges_reports.days_left > 3 AND days_left <= 6, latrine_with_desludges_reports.id, NULL)) AS warning')
            ->groupBy('sanitation_zones.id');
    }

    public function lists($paginate = false, $params = null, $sort = false)
    {
        $query = $this->query();

        $query->when(!is_null(data_get($params, 'camp')), function($query) use($params) {
                $query->whereIn('latrine_with_desludges_reports.camp_id', data_get($params, 'camp'));
            })
            ->when(!is_null(data_get($params, 'block')), function($query) use($params) {
                $query->whereIn('latrine_with_desludges_reports.block_id', data_get($params, 'block'));
            })
            ->when(!is_null(data_get($params, 'sanitationZones')), function($query) use($params) {
                $query->whereIn('sanitation_zones.id', data_get($params, 'sanitationZones'));
            })
            ->when(!is_null(data_get($params, 'year')), function($query) use($params) {
                $query->whereIn(DB::raw('YEAR(latrine_with_desludges_reports.next_desludge_date)'), data_get($params, 'year'));
            })
            ->when(!is_null(data_get($params, 'month')), function($query) use($params) {
                $query->whereIn(DB::raw('MONTH(latrine_with_desludges_reports.next_desludge_date)'), data_get($params, 'month'));
            })
            ->when(!is_null(data_get($params, 'fromDate')) && is_null(data_get($params, 'toDate'))
                && is_null(data_get($params, 'year')) && is_null(data_get($params, 'month')), function($query) use($params){
                $query->whereDate(DB::raw('DATE(latrine_with_desludges_reports.next_desludge_date)'), '>', data_get($params, 'fromDate'));
            })
            ->when(!is_null(data_get($params, 'fromDate')) && !is_null(data_get($params, 'toDate'))
                && is_null(data_get($params, 'year')) && is_null(data_get($params, 'month')), function($query) use($params){
                $query->whereBetween(DB::raw('DATE(latrine_with_desludges_reports.next_desludge_date)'),
                    [data_get($params, 'fromDate'), data_get($params, 'toDate')]);
            })
            ->when(is_null(data_get($params, 'name')) && is_null(data_get($params, 'sort')), function($query) use($params){
                $query->orderBy('danger', 'desc');
                $query->orderBy('warning', 'desc');
            });

        //For Sort
        if ($sort && data_get($params, 'name')) :
            $query = $this->sortResult($query, data_get($params, 'name'), data_get($params, 'sort'));
        else:

            $query = $query->orderBy('danger', 'DESC')
                ->orderBy('warning', 'DESC')
                ->orderBy('next_desludge_date', 'ASC')
                ->orderBy('last_desludge_date', 'DESC');
        endif;

        return $paginate ? $this->resultWithPagination($query, data_get($params, 'max_count') ?? 10) : $this->resultSet($query);
    }

    public function store($data, $conditions)
    {
        # code...
    }

    public function delete($data)
    {
        # code...
    }
}
