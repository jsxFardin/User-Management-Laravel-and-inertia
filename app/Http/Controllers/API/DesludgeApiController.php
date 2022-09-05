<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Latrine\Desludge;
use App\Models\Latrine\Latrine;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DesludgeApiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();

        $results = DB::table('desludges')
            ->join('latrines', 'latrines.id', 'desludges.latrine_id')
            ->join('pit_types', 'pit_types.id', 'desludges.pit_type_id')
            ->join('sludge_transfers', 'sludge_transfers.id', 'desludges.sludge_transfer_id')
            ->join('camps', 'camps.id', 'latrines.camp_id')
            ->join('blocks', 'blocks.id', 'latrines.block_id')
            ->join('sanitation_zones', 'sanitation_zones.id', 'latrines.sanitation_zone_id')
            ->where('user_id', $userId)
            ->where('collection_date', '>', DB::raw('NOW()- interval 3 day'))
            ->select('desludges.*', 'latrines.uid_no', 'camps.name as camp_name', 'blocks.short_name as block_name', 'sanitation_zones.name as sanitation_zone_name', 'pit_types.name as pit_type', 'sludge_transfers.name as sludge_transfer')
            ->orderBy('desludges.collection_date', 'ASC')
            ->get();

        $results = json_decode($results, true);

        if(count($results)):
            $keys = max(array_keys($results));
            foreach($results as $key => $result):
                $date = \Carbon\Carbon::parse($result['collection_date'])->format('Y-m-d');
                $startTime = \Carbon\Carbon::parse($result['collection_date']);
                if(array_key_exists(($key + 1), $results) && ($key + 1) != $keys):
                    if($date == \Carbon\Carbon::parse($results[$key + 1]['collection_date'])->format('Y-m-d')):
                        $finishTime = \Carbon\Carbon::parse($results[$key + 1]['collection_date']);
                    else:
                        $finishTime = \Carbon\Carbon::parse($result['collection_date']);
                    endif;

                    $results[$key]['duration'] = $finishTime->diffForHumans($startTime);
                    $results[$key]['collection_time'] = date('g:i a',strtotime($result['collection_date']));
                    $results[$key]['collection_date'] = \Carbon\Carbon::parse($result['collection_date'])->format('Y-m-d');
                else:
                    $results[$key]['duration'] = null;
                    $results[$key]['collection_time'] = date('g:i a',strtotime($result['collection_date']));
                    $results[$key]['collection_date'] = \Carbon\Carbon::parse($result['collection_date'])->format('Y-m-d');
                endif;
            endforeach;
        endif;

        krsort($results);

        return $this->sendSuccess("Success", 200, array_values($results));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $desludges = $request->all();
            $userId = Auth::id();

            DB::beginTransaction();
            if(array_key_exists('latrine_id', $desludges) && array_key_exists('pit_type_id', $desludges)):
                $desludges['latrine_id'] = Latrine::where('uid_no', $desludges['latrine_id'])->first()->id;
                $desludges['user_id'] = $userId;
                Desludge::create($desludges);
            else:
                $uids = Latrine::whereIn('uid_no', array_map(function($item){
                    return $item['latrine_id'];
                }, $desludges))->select('id', 'uid_no')->get()->toArray();

                $desludges = array_map(function($item) use($uids, $userId){
                    $item['latrine_id'] = $uids[array_search($item['latrine_id'], array_column($uids, 'uid_no'))]['id'];
                    $item['user_id'] = $userId;
                    return $item;
                }, $desludges);

                Desludge::insert($desludges);
            endif;

            DB::commit();
            return $this->sendSuccess('success', JsonResponse::HTTP_OK, "Desludge created successfully");
        } catch (Exception $ex) {
            DB::rollBack();
            return $this->sendError('failed', JsonResponse::HTTP_BAD_REQUEST, "Failed to create desludge : " . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Latrine\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Desludge $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Latrine\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit(Desludge $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Latrine\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desludge $complaint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Latrine\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desludge $complaint)
    {
        //
    }
}
