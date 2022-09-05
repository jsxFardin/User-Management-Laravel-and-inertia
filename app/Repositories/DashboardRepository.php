<?php

namespace App\Repositories;

use App\Interfaces\DashboardInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepository extends BaseRepository implements DashboardInterface
{
    private function desludgesTblQuery()
    {
        return DB::table('desludges')
            ->join('latrine_with_desludges_reports', 'latrine_with_desludges_reports.id', 'desludges.latrine_id')
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
            });
    }

    public function desludgedVolume($param)
    {
        $query = $this->desludgesTblQuery();

        $query = $query->select('latrine_with_desludges_reports.sanitation_zone_name as name', DB::raw('SUM(desludges.total_volume_desludged) as total_volume_desludged'))
            ->selectRaw('DATE(desludges.collection_date) as collection_date')
            ->groupBy('latrine_with_desludges_reports.sanitation_zone_id', DB::raw('DATE(desludges.collection_date)'))
            ->when(!is_null(data_get($param, 'fromDate')) && is_null(data_get($param, 'toDate')) 
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query) use($param){
                $query->whereDate(DB::raw('DATE(desludges.collection_date)'), '>', data_get($param, 'fromDate'));
            })
            ->when(!is_null(data_get($param, 'fromDate')) && !is_null(data_get($param, 'toDate')) 
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query) use($param){
                $query->whereBetween(DB::raw('DATE(desludges.collection_date)'),
                    [data_get($param, 'fromDate'), data_get($param, 'toDate')]);
            })
            ->when(is_null(data_get($param, 'fromDate')) && is_null(data_get($param, 'toDate')) 
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query){
                $query->whereBetween(DB::raw('DATE(desludges.collection_date)'),
                    [Carbon::now()->subDays(5)->format('Y-m-d'), Carbon::now()->format('Y-m-d')]);
            })
            ->when(!is_null(data_get($param, 'camp')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.camp_id', json_decode(data_get($param, 'camp')));
            })
            ->when(!is_null(data_get($param, 'block')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.block_id', json_decode(data_get($param, 'block')));
            })
            ->when(!is_null(data_get($param, 'sanitationZones')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.sanitation_zone_id', json_decode(data_get($param, 'sanitationZones')));
            })
            ->when(!is_null(data_get($param, 'year')), function($query) use($param) {
                $query->whereIn(DB::raw('YEAR(desludges.collection_date)'), json_decode(data_get($param, 'year')));
            })
            ->when(!is_null(data_get($param, 'month')), function($query) use($param) {
                $query->whereIn(DB::raw('MONTH(desludges.collection_date)'), json_decode(data_get($param, 'month')));
            })
            ->orderBy('desludges.collection_date', 'ASC')
            ->get();

        $results = json_decode($query, true);

        $dates = array_map(function($data){
            return $data['collection_date'];
        }, $results);

        $dates = array_values(array_unique($dates));

        $dateSet = [];
        foreach($dates as $date):
            $dateSet[$date] = [];
        endforeach;

        $dataSet = [];
        foreach($results as $result):
            $color = rand_color();
            if(in_array($color, array_column($dataSet, 'backgroundColor'))):
                $color = rand_color();
            endif;

            $dataSet[$result['name']]['data'] = $dateSet;
            $dataSet[$result['name']]['label'] = $result['name'];
            $dataSet[$result['name']]['backgroundColor'] = $color;
            $dataSet[$result['name']]['stack'] =  "stack";
        endforeach;

        $dataSet = array_values($dataSet);

        foreach($results as $result):
            foreach($dataSet as $d => $data):
                if($data['label'] == $result['name']):
                    array_push($dataSet[$d]['data'][$result['collection_date']], (Double) number_format($result['total_volume_desludged'],2,".",""));
                else:
                    array_push($dataSet[$d]['data'][$result['collection_date']], (Double) 0);
                endif;
            endforeach;
        endforeach;

        foreach($dataSet as $key => $item):
            $dataSet[$key]['data'] = array_map(function($item){
                return array_sum($item);
            }, array_values($item['data']));
        endforeach;

        return ['labels' => $dates, 'datasets' => $dataSet];
    }

    private function latrineTblQuery()
    {
        return DB::table('latrine_with_desludges_reports')
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
            });
    }

    public function latrineDesludgeQuery($param)
    {
        $query = $this->latrineTblQuery();
        $desludgeData = $query->where(function($condition){
                $condition->whereBetween('latrine_with_desludges_reports.next_desludge_date',
                    [Carbon::now()->format('Y-m-d'), Carbon::now()->addDays(5)->format('Y-m-d')])
                ->orWhereDate('latrine_with_desludges_reports.next_desludge_date', '<', Carbon::now()->format('Y-m-d'));
            })
            ->when(!is_null(data_get($param, 'camp')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.camp_id', json_decode(data_get($param, 'camp')));
            })
            ->when(!is_null(data_get($param, 'block')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.block_id', json_decode(data_get($param, 'block')));
            })
            ->when(!is_null(data_get($param, 'sanitationZones')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.sanitation_zone_id', json_decode(data_get($param, 'sanitationZones')));
            })
            ->select('latrine_with_desludges_reports.uid_no', 'latrine_with_desludges_reports.block_name',
                'latrine_with_desludges_reports.camp_name', 'latrine_with_desludges_reports.last_desludge_date','latrine_with_desludges_reports.days_left',
                'latrine_with_desludges_reports.sanitation_zone_name', 'latrine_with_desludges_reports.last_volume_desludged')
            ->selectRaw('if(latrine_with_desludges_reports.days_left < 0, "Failed", latrine_with_desludges_reports.next_desludge_date) as next_desludge_date')
            ->selectRaw('latrine_with_desludges_reports.camp_id')
            ->groupBy('latrine_with_desludges_reports.id')
            ->orderBy('latrine_with_desludges_reports.last_desludge_date')
            ->get();

        //BUILD ARRAY
        $dateData = []; $listData = [];
        foreach($desludgeData as $item):
            if(!array_key_exists($item->next_desludge_date, $dateData)):
                $dateData[$item->next_desludge_date][] = $item->next_desludge_date == "Failed" ?
                    $item->next_desludge_date : Carbon::parse($item->next_desludge_date)->format('F j, Y');

                $item->last_desludge_date = Carbon::parse($item->last_desludge_date)->format('F j, Y');
                $item->days_left = $item->days_left < 0 ?
                    abs($item->days_left) . " Day's Ago" : $item->days_left . " Day's left";
                $listData[$item->next_desludge_date][] = $item;
            else:
                array_push($dateData[$item->next_desludge_date], ($item->next_desludge_date == "Failed" ?
                    $item->next_desludge_date : Carbon::parse($item->next_desludge_date)->format('F j, Y')));

                $item->last_desludge_date = Carbon::parse($item->last_desludge_date)->format('F j, Y');
                $item->days_left = $item->days_left < 0 ?  abs($item->days_left) . " Day's Ago" : $item->days_left . " Day's left";
                array_push($listData[$item->next_desludge_date], $item);
            endif;
        endforeach;

        $dateData = array_map(function($item){
            return $item == "Failed" ? "Date Over" : Carbon::parse($item)->format('F j, Y');
        }, array_keys($dateData));
        $listData = array_values($listData);

        return compact('dateData', 'listData');

    }

    public function typeofLatrine($param)
    {
        $query = $this->latrineTblQuery();

        $query = $query
            ->when(!is_null(data_get($param, 'camp')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.camp_id', json_decode(data_get($param, 'camp')));
            })
            ->when(!is_null(data_get($param, 'block')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.block_id', json_decode(data_get($param, 'block')));
            })
            ->when(!is_null(data_get($param, 'sanitationZones')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.sanitation_zone_id', json_decode(data_get($param, 'sanitationZones')));
            })
            ->groupBy('latrine_with_desludges_reports.id', 'latrine_with_desludges_reports.pit_type_id', 'latrine_with_desludges_reports.sanitation_zone_id')
            ->select('latrine_with_desludges_reports.pit_type_name', 'latrine_with_desludges_reports.sanitation_zone_name', DB::raw('count(latrine_with_desludges_reports.id) as total'))
            ->get();

        $results = json_decode($query, true);

        $pitTypes = array_map(function($data){
            return $data['pit_type_name'];
        }, $results);

        $pitTypes = array_values(array_unique($pitTypes));

        $pitTypesSet = [];
        foreach($pitTypes as $date):
            $pitTypesSet[$date] = 0;
        endforeach;

        $dataSet = [];
        foreach($results as $result):
            $color = rand_color();
            if(in_array($color, array_column($dataSet, 'backgroundColor'))):
                $color = rand_color();
            endif;

            $dataSet[$result['sanitation_zone_name']]['data'] = $pitTypesSet;
            $dataSet[$result['sanitation_zone_name']]['label'] = $result['sanitation_zone_name'];
            $dataSet[$result['sanitation_zone_name']]['backgroundColor'] = $color;
            $dataSet[$result['sanitation_zone_name']]['stack'] =  "stack";
        endforeach;

        $dataSet = array_values($dataSet);

        foreach($results as $result):
            foreach($dataSet as $d => $data):
                if($data['label'] == $result['sanitation_zone_name']):
                    $dataSet[$d]['data'][$result['pit_type_name']] += 1;
                endif;
            endforeach;
        endforeach;

        foreach($dataSet as $key => $item):
            $dataSet[$key]['data'] = array_values($item['data']);
        endforeach;

        return ['labels' => $pitTypes, 'datasets' => $dataSet];
    }

    public function desludgedTypeofLatrine($param)
    {
        $query = $this->latrineTblQuery();

        $query = $query
            ->when(!is_null(data_get($param, 'camp')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.camp_id', json_decode(data_get($param, 'camp')));
            })
            ->when(!is_null(data_get($param, 'block')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.block_id', json_decode(data_get($param, 'block')));
            })
            ->when(!is_null(data_get($param, 'sanitationZones')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.sanitation_zone_id', json_decode(data_get($param, 'sanitationZones')));
            })
            ->groupBy('latrine_with_desludges_reports.sanitation_zone_id', 'latrine_with_desludges_reports.pit_type_id')
            ->select('latrine_with_desludges_reports.pit_type_name', 'latrine_with_desludges_reports.sanitation_zone_name', DB::raw('sum(latrine_with_desludges_reports.last_volume_desludged) as total'))
            ->get();

        $results = json_decode($query, true);

        $pitTypes = array_map(function($data){
            return $data['pit_type_name'];
        }, $results);

        $pitTypes = array_values(array_unique($pitTypes));

        $pitTypesSet = [];
        foreach($pitTypes as $date):
            $pitTypesSet[$date] = 0;
        endforeach;

        $dataSet = [];
        foreach($results as $result):
            $color = rand_color();
            if(in_array($color, array_column($dataSet, 'backgroundColor'))):
                $color = rand_color();
            endif;

            $dataSet[$result['sanitation_zone_name']]['data'] = $pitTypesSet;
            $dataSet[$result['sanitation_zone_name']]['label'] = $result['sanitation_zone_name'];
            $dataSet[$result['sanitation_zone_name']]['backgroundColor'] = $color;
            $dataSet[$result['sanitation_zone_name']]['stack'] =  "stack";
        endforeach;

        $dataSet = array_values($dataSet);

        foreach($results as $result):
            foreach($dataSet as $d => $data):
                if($data['label'] == $result['sanitation_zone_name']):
                    $dataSet[$d]['data'][$result['pit_type_name']] = 
                        (Double) number_format(($result['total'] + $dataSet[$d]['data'][$result['pit_type_name']]),2,".","");
                endif;
            endforeach;
        endforeach;

        foreach($dataSet as $key => $item):
            $dataSet[$key]['data'] = array_values($item['data']);
        endforeach;

        return ['labels' => $pitTypes, 'datasets' => $dataSet];
    }

    public function totalHoursUsed($param)
    {
        $query = $this->desludgesTblQuery();

        $query = $query
            ->when(!is_null(data_get($param, 'camp')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.camp_id', json_decode(data_get($param, 'camp')));
            })
            ->when(!is_null(data_get($param, 'block')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.block_id', json_decode(data_get($param, 'block')));
            })
            ->when(!is_null(data_get($param, 'sanitationZones')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.sanitation_zone_id', json_decode(data_get($param, 'sanitationZones')));
            })
            ->when(!is_null(data_get($param, 'year')), function($query) use($param) {
                $query->whereIn(DB::raw('YEAR(desludges.collection_date)'), json_decode(data_get($param, 'year')));
            })
            ->when(!is_null(data_get($param, 'month')), function($query) use($param) {
                $query->whereIn(DB::raw('MONTH(desludges.collection_date)'), json_decode(data_get($param, 'month')));
            })
            ->when(!is_null(data_get($param, 'fromDate')) && is_null(data_get($param, 'toDate')) 
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query) use($param){
                $query->whereDate(DB::raw('DATE(desludges.collection_date)'), '>', data_get($param, 'fromDate'));
            })
            ->when(!is_null(data_get($param, 'fromDate')) && !is_null(data_get($param, 'toDate')) 
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query) use($param){
                $query->whereBetween(DB::raw('DATE(desludges.collection_date)'),
                    [data_get($param, 'fromDate'), data_get($param, 'toDate')]);
            })
            ->when(is_null(data_get($param, 'fromDate')) && is_null(data_get($param, 'toDate')) 
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query){
                $query->whereBetween(DB::raw('DATE(desludges.collection_date)'),
                    [Carbon::now()->subDays(5)->format('Y-m-d'), Carbon::now()->format('Y-m-d')]);
            })
            ->select('latrine_with_desludges_reports.sanitation_zone_name as name', DB::raw('SUM(desludges.man_woman_days_used) as man_woman_days_used'))
            ->selectRaw('Date(collection_date) as collection_date')
            ->groupBy('latrine_with_desludges_reports.sanitation_zone_id', DB::raw('DATE(desludges.collection_date)'))
            ->orderBy('desludges.collection_date', 'ASC')
            ->get();

        $results = json_decode($query, true);

        $dates = array_map(function($data){
            return $data['collection_date'];
        }, $results);

        $dates = array_values(array_unique($dates));

        $dateSet = [];
        foreach($dates as $date):
            $dateSet[$date] = [];
        endforeach;

        $dataSet = [];
        foreach($results as $result):
            $color = rand_color();
            if(in_array($color, array_column($dataSet, 'backgroundColor'))):
                $color = rand_color();
            endif;

            $dataSet[$result['name']]['data'] = $dateSet;
            $dataSet[$result['name']]['label'] = $result['name'];
            $dataSet[$result['name']]['backgroundColor'] = $color;
            $dataSet[$result['name']]['stack'] =  "stack";
        endforeach;

        $dataSet = array_values($dataSet);

        foreach($results as $result):
            foreach($dataSet as $d => $data):
                if($data['label'] == $result['name']):
                    array_push($dataSet[$d]['data'][$result['collection_date']], (Double) number_format($result['man_woman_days_used'],2,".",""));
                else:
                    array_push($dataSet[$d]['data'][$result['collection_date']], (Double) 0);
                endif;
            endforeach;
        endforeach;

        foreach($dataSet as $key => $item):
            $dataSet[$key]['data'] = array_map(function($item){
                return array_sum($item);
            }, array_values($item['data']));
        endforeach;

        return ['labels' => $dates, 'datasets' => $dataSet];
    }

    public function seeForeignMaterials($param)
    {
        $query = $this->desludgesTblQuery();

        $query = $query
            ->when(!is_null(data_get($param, 'camp')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.camp_id', json_decode(data_get($param, 'camp')));
            })
            ->when(!is_null(data_get($param, 'block')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.block_id', json_decode(data_get($param, 'block')));
            })
            ->when(!is_null(data_get($param, 'sanitationZones')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.sanitation_zone_id', json_decode(data_get($param, 'sanitationZones')));
            })
            ->when(!is_null(data_get($param, 'year')), function($query) use($param) {
                $query->whereIn(DB::raw('YEAR(desludges.collection_date)'), json_decode(data_get($param, 'year')));
            })
            ->when(!is_null(data_get($param, 'month')), function($query) use($param) {
                $query->whereIn(DB::raw('MONTH(desludges.collection_date)'), json_decode(data_get($param, 'month')));
            })
            ->when(!is_null(data_get($param, 'fromDate')) && is_null(data_get($param, 'toDate')) 
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query) use($param){
                $query->whereDate(DB::raw('DATE(desludges.collection_date)'), '>', data_get($param, 'fromDate'));
            })
            ->when(!is_null(data_get($param, 'fromDate')) && !is_null(data_get($param, 'toDate')) 
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query) use($param){
                $query->whereBetween(DB::raw('DATE(desludges.collection_date)'),
                    [data_get($param, 'fromDate'), data_get($param, 'toDate')]);
            })
            ->when(is_null(data_get($param, 'fromDate')) && is_null(data_get($param, 'toDate')) 
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query){
                $query->whereBetween(DB::raw('DATE(desludges.collection_date)'),
                    [Carbon::now()->subDays(5)->format('Y-m-d'), Carbon::now()->format('Y-m-d')]);
            })
            ->select('latrine_with_desludges_reports.sanitation_zone_name as name', DB::raw('SUM(desludges.see_foreign_materials) as see_foreign_materials'))
            ->selectRaw('Date(collection_date) as collection_date')
            ->groupBy('latrine_with_desludges_reports.sanitation_zone_id', DB::raw('DATE(desludges.collection_date)'))
            ->orderBy('desludges.collection_date', 'ASC')
            ->get();

        $results = json_decode($query, true);

        $dates = array_map(function($data){
            return $data['collection_date'];
        }, $results);

        $dates = array_values(array_unique($dates));

        $dateSet = [];
        foreach($dates as $date):
            $dateSet[$date] = [];
        endforeach;

        $dataSet = [];
        foreach($results as $result):
            $color = rand_color();
            if(in_array($color, array_column($dataSet, 'backgroundColor'))):
                $color = rand_color();
            endif;

            $dataSet[$result['name']]['data'] = $dateSet;
            $dataSet[$result['name']]['label'] = $result['name'];
            $dataSet[$result['name']]['backgroundColor'] = $color;
            $dataSet[$result['name']]['stack'] =  "stack";
        endforeach;

        $dataSet = array_values($dataSet);

        foreach($results as $result):
            foreach($dataSet as $d => $data):
                if($data['label'] == $result['name']):
                    array_push($dataSet[$d]['data'][$result['collection_date']], (Int) $result['see_foreign_materials']);
                else:
                    array_push($dataSet[$d]['data'][$result['collection_date']], (Int) 0);
                endif;
            endforeach;
        endforeach;

        foreach($dataSet as $key => $item):
            $dataSet[$key]['data'] = array_map(function($item){
                return array_sum($item);
            }, array_values($item['data']));
        endforeach;

        return ['labels' => $dates, 'datasets' => $dataSet];
    }

    public function totalLitterFuelUsed($param)
    {
        $query = $this->desludgesTblQuery();
        $query = $query
            ->when(!is_null(data_get($param, 'camp')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.camp_id', json_decode(data_get($param, 'camp')));
            })
            ->when(!is_null(data_get($param, 'block')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.block_id', json_decode(data_get($param, 'block')));
            })
            ->when(!is_null(data_get($param, 'sanitationZones')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.sanitation_zone_id', json_decode(data_get($param, 'sanitationZones')));
            })
            ->when(!is_null(data_get($param, 'year')), function($query) use($param) {
                $query->whereIn(DB::raw('YEAR(desludges.collection_date)'), json_decode(data_get($param, 'year')));
            })
            ->when(!is_null(data_get($param, 'month')), function($query) use($param) {
                $query->whereIn(DB::raw('MONTH(desludges.collection_date)'), json_decode(data_get($param, 'month')));
            })
            ->when(!is_null(data_get($param, 'fromDate')) && is_null(data_get($param, 'toDate')) 
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query) use($param){
                $query->whereDate(DB::raw('DATE(desludges.collection_date)'), '>', data_get($param, 'fromDate'));
            })
            ->when(!is_null(data_get($param, 'fromDate')) && !is_null(data_get($param, 'toDate')) 
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query) use($param){
                $query->whereBetween(DB::raw('DATE(desludges.collection_date)'),
                    [data_get($param, 'fromDate'), data_get($param, 'toDate')]);
            })
            ->when(is_null(data_get($param, 'fromDate')) && is_null(data_get($param, 'toDate')) 
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query){
                $query->whereBetween(DB::raw('DATE(desludges.collection_date)'),
                    [Carbon::now()->subDays(5)->format('Y-m-d'), Carbon::now()->format('Y-m-d')]);
            })
            ->select('latrine_with_desludges_reports.sanitation_zone_name as name',
                DB::raw('SUM(desludges.litre_of_petrol) as litre_of_petrol'))
            ->selectRaw('Date(collection_date) as collection_date')
            ->groupBy('latrine_with_desludges_reports.sanitation_zone_id', DB::raw('DATE(desludges.collection_date)'))
            ->orderBy('desludges.collection_date', 'ASC')
            ->get();

        $results = json_decode($query, true);

        $dates = array_map(function($data){
            return $data['collection_date'];
        }, $results);

        $dates = array_values(array_unique($dates));

        $dateSet = [];
        foreach($dates as $date):
            $dateSet[$date] = [];
        endforeach;

        $dataSet = [];
        foreach($results as $result):
            $color = rand_color();
            if(in_array($color, array_column($dataSet, 'backgroundColor'))):
                $color = rand_color();
            endif;

            $dataSet[$result['name']]['data'] = $dateSet;
            $dataSet[$result['name']]['label'] = $result['name'];
            $dataSet[$result['name']]['backgroundColor'] = $color;
            $dataSet[$result['name']]['stack'] =  "stack";
        endforeach;

        $dataSet = array_values($dataSet);

        foreach($results as $result):
            foreach($dataSet as $d => $data):
                if($data['label'] == $result['name']):
                    array_push($dataSet[$d]['data'][$result['collection_date']], (Double) number_format($result['litre_of_petrol'],2,".",""));
                else:
                    array_push($dataSet[$d]['data'][$result['collection_date']], (Double) 0);
                endif;
            endforeach;
        endforeach;

        foreach($dataSet as $key => $item):
            $dataSet[$key]['data'] = array_map(function($item){
                return array_sum($item);
            }, array_values($item['data']));
        endforeach;

        return ['labels' => $dates, 'datasets' => $dataSet];
    }
}
