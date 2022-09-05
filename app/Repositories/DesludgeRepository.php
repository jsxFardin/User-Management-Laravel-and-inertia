<?php

namespace App\Repositories;

use App\Interfaces\DesludgeInterface;
use App\Models\Latrine\Desludge;
use Illuminate\Support\Facades\DB;

class DesludgeRepository extends BaseRepository implements DesludgeInterface
{
    protected $desludge;
    public function __construct(Desludge $desludge)
    {
        $this->desludge = $desludge;
    }

    public function query()
    {
        return $this->desludge
            ->join('pit_types', 'pit_types.id', 'desludges.pit_type_id')
            ->join('sludge_transfers', 'sludge_transfers.id', 'desludges.sludge_transfer_id')
            ->join('latrine_with_desludges_reports', 'latrine_with_desludges_reports.id', 'desludges.latrine_id')
            ->leftJoin('users', 'users.id', 'desludges.user_id')
            ->when(!$this->isAdmin, function($query) {
                $query->join('tag_areas as tag_camps', function($join) {
                    $join->on('tag_camps.taggable_id', 'latrine_with_desludges_reports.camp_id')
                        ->where('tag_camps.taggable_type', \App\Models\Encampment\Camp::class)
                        ->when($this->isAgency, function($query){
                            $query->whereNull('tag_camps.team_id');
                        });
                })
                ->join('tag_areas as tag_blocks', function($join) {
                    $join->on('tag_blocks.taggable_id', 'latrine_with_desludges_reports.block_id')
                        ->where('tag_blocks.taggable_type', \App\Models\Encampment\Block::class)
                        ->when($this->isAgency, function($query){
                            $query->whereNull('tag_blocks.team_id');
                        });
                })
                ->join('tag_users as tag_agency_users', function($join){
                    $join->on('tag_agency_users.taggable_id','tag_camps.agency_id')
                        ->on('tag_agency_users.taggable_id', 'tag_blocks.agency_id')
                        ->where('tag_agency_users.taggable_type', \App\Models\Agency::class);
                })
                ->where('tag_agency_users.user_id', $this->userinfo->id)
                ->when(!$this->isAgency, function($query) {
                    $query->join('tag_users as tag_team_users', function($join){
                        $join->on('tag_team_users.taggable_id', 'tag_blocks.team_id')
                            ->on('tag_team_users.taggable_id', 'tag_blocks.team_id')
                            ->where('tag_team_users.taggable_type', \App\Models\Team::class);
                    })
                    ->where('tag_team_users.user_id', $this->userinfo->id);
                });
            })
            ->groupBy('desludges.id')
            ->select(
                'desludges.*',
                'pit_types.name as pit_type_name',
                'users.id as desludge_user_id',
                'users.name as desludge_user_name',
                'sludge_transfers.name as sludge_transferred_to',
                'latrine_with_desludges_reports.uid_no',
                'latrine_with_desludges_reports.camp_id',
                'latrine_with_desludges_reports.block_id',
                'latrine_with_desludges_reports.sub_block_id',
                'latrine_with_desludges_reports.facility_type_id',
                'latrine_with_desludges_reports.facility_used_id',
                'latrine_with_desludges_reports.construction_status_id',
                'latrine_with_desludges_reports.latrine_structure_id',
                'latrine_with_desludges_reports.constructor_id',
                'latrine_with_desludges_reports.chamber_door',
                'latrine_with_desludges_reports.male_number_stickers',
                'latrine_with_desludges_reports.male_number_user',
                'latrine_with_desludges_reports.female_number_stickers',
                'latrine_with_desludges_reports.female_number_user',
                'latrine_with_desludges_reports.children_number',
                'latrine_with_desludges_reports.common_shared',
                'latrine_with_desludges_reports.functional',
                'latrine_with_desludges_reports.non_functional',
                'latrine_with_desludges_reports.min_or_repair',
                'latrine_with_desludges_reports.pwsn_hand_rail_outside',
                'latrine_with_desludges_reports.pwsn_hand_rail_inside',
                'latrine_with_desludges_reports.pwsn_ramp',
                'latrine_with_desludges_reports.pwsn_stair',
                'latrine_with_desludges_reports.pwsn_high_commode',
                'latrine_with_desludges_reports.hwd',
                'latrine_with_desludges_reports.hwd_water',
                'latrine_with_desludges_reports.hwd_soap',
                'latrine_with_desludges_reports.longitude',
                'latrine_with_desludges_reports.latitude',
                'latrine_with_desludges_reports.total_chamber',
                'latrine_with_desludges_reports.total_ring_number',
                'latrine_with_desludges_reports.septic_tank_dimension',
                'latrine_with_desludges_reports.total_volume',
                'latrine_with_desludges_reports.sanitation_zone_id',
                'latrine_with_desludges_reports.camp_name',
                'latrine_with_desludges_reports.block_name',
                'latrine_with_desludges_reports.sub_block_name',
                'latrine_with_desludges_reports.facility_type_name',
                'latrine_with_desludges_reports.facility_used_name',
                'latrine_with_desludges_reports.construction_status_name',
                'latrine_with_desludges_reports.latrine_structure_name',
                'latrine_with_desludges_reports.donor_name',
                'latrine_with_desludges_reports.sanitation_zone_name',
                'latrine_with_desludges_reports.last_desludge_date',
                'latrine_with_desludges_reports.next_desludge_date',
                'latrine_with_desludges_reports.days_left',
                'latrine_with_desludges_reports.last_volume_desludged'
            );
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
                $query->whereIn('latrine_with_desludges_reports.sanitation_zone_id', data_get($params, 'sanitationZones'));
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
            ->when(!is_null(data_get($params, 'name')) && !is_null(data_get($params, 'sort')), function($query) use($params){
                $query->orderBy(data_get($params, 'name'), data_get($params, 'sort'));
            });

        if ($sort && data_get($params, 'name')) :
            $query = $this->sortResult($query, data_get($params, 'name'), data_get($params, 'sort'));
        endif;

        return $paginate ? $this->resultWithPagination($query, data_get($params, 'max_count') ?? 10) : $this->resultSet($query);
    }

    public function yearMonth()
    {
        return $this->desludge
            ->selectRaw('(GROUP_CONCAT(
                DISTINCT CONCAT(DATE_FORMAT(collection_date, "%Y"))
                ORDER BY id ASC
                SEPARATOR ","
            )) AS year')
            ->selectRaw('(GROUP_CONCAT(
                DISTINCT CONCAT(DATE_FORMAT(collection_date, "%M"))
                ORDER BY id ASC
                SEPARATOR ","
            )) AS month')
            ->first();
    }

    public function show($id)
    {
        $query = $this->query();
        return $query->findOrFail($id);
    }
}
