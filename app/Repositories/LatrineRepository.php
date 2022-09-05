<?php

namespace App\Repositories;

use App\Interfaces\LatrineInterface;
use App\Models\Latrine\Latrine;
use Illuminate\Support\Facades\DB;

class LatrineRepository extends BaseRepository implements LatrineInterface
{
    protected $latrine;

    public function __construct(Latrine $latrine)
    {
        $this->latrine = $latrine;
    }

    public function query()
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
            })
            ->select('latrine_with_desludges_reports.*')
            ->groupBy('latrine_with_desludges_reports.id');
    }

    public function lists($paginate = false, $params = null, $sort = false)
    {
        $query = $this->query();

        if(!is_null($params) && count($params)):
            $query->when(!is_null(data_get($params, 'latrine_structure')), function($query) use($params) {
                $query->where('latrine_structure_id', data_get($params, 'latrine_structure'));
            })
            ->when(!is_null(data_get($params, 'construction_status')), function($query) use($params) {
                $query->where('construction_status_id', data_get($params, 'construction_status'));
            })
            ->when(!is_null(data_get($params, 'facility_used')), function($query) use($params) {
                $query->where('facility_used_id', data_get($params, 'facility_used'));
            })
            ->when(!is_null(data_get($params, 'facility_type')), function($query) use($params) {
                $query->where('facility_type_id', data_get($params, 'facility_type'));
            })
            ->when(!is_null(data_get($params, 'camp')), function($query) use($params) {
                $query->where('camp_id', data_get($params, 'camp'));
            })
            ->when(!is_null(data_get($params, 'block')), function($query) use($params) {
                $query->where('block_id', data_get($params, 'block'));
            })
            ->when(!is_null(data_get($params, 'uid_no')), function($query) use($params) {
                $query->where('uid_no', data_get($params, 'uid_no'));
            });
        endif;

        //For Sort
        if ($sort && data_get($params, 'name')) :
            $query = $this->sortResult($query, data_get($params, 'name'), data_get($params, 'sort'));
        endif;

        return $paginate ? $this->resultWithPagination($query, data_get($params, 'max_count') ?? 10) : $this->resultSet($query);
    }

    public function total()
    {
        return $query = $this->query()->get()->count();
    }

    public function show($id)
    {

        $query = $this->query();

        return $query->where('id', $id)->first();
    }

    public function storeData($data)
    {
        return $this->store($data);
    }

    public function updateData($data, $id)
    {
        $data = $data->except('uid_no');
        return $this->update($data, $id);
    }

    private function store($data, $batch = false)
    {
        if ($batch) :
            return $this->latrine->Insert($data);
        else :
            $inputData = $data->all();
            $inputData['uid_no'] = $this->latrine->generateLatrineId($data);
            return $this->latrine->create($inputData);
        endif;
    }

    private function update($data, $id)
    {
        $latrine = $this->latrine->findOrFail($id);
        $latrine->update($data);
        return $latrine;
    }
}
