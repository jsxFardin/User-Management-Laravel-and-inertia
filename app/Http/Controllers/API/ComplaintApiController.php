<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Latrine\Complaint;
use App\Models\Latrine\Latrine;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplaintApiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $results = DB::table('complaints')
            ->join('latrines', 'latrines.id', 'complaints.latrine_id')
            ->join('camps', 'camps.id', 'latrines.camp_id')
            ->join('blocks', 'blocks.id', 'latrines.block_id')
            ->join('sanitation_zones', 'sanitation_zones.id', 'latrines.sanitation_zone_id')
            ->select('complaints.*', 'latrines.uid_no', 'camps.name as camp_name', 'blocks.short_name as block_name', 'sanitation_zones.name as sanitation_zone_name')
            ->when(!$user->isAdmin(), function ($query) use ($user) {
                $query->whereIn('complaints.latrine_id', $user->getUserlatrineId());
            })
            ->get()
            ->transform(function ($item, $kye) {
                $item->complainant = null;
                $item->take_actions = null;
                $item->resolved_date = null;
                $item->resolved_time = null;

                return $item;
            });

        return $this->sendSuccess("Success", 200, $results);
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
            $complaints = $request->all();

            DB::beginTransaction();
            if (array_key_exists('latrine_id', $complaints) && array_key_exists('complaint', $complaints)) :
                $complaints['latrine_id'] = Latrine::where('uid_no', $complaints['latrine_id'])->first()->id;
                Complaint::create($complaints);
            else :
                $uids = Latrine::whereIn('uid_no', array_map(function ($item) {
                    return $item['latrine_id'];
                }, $complaints))->select('id', 'uid_no')->get()->toArray();

                $complaints = array_map(function ($item) use ($uids) {
                    $item['latrine_id'] = $uids[array_search($item['latrine_id'], array_column($uids, 'uid_no'))]['id'];
                    return $item;
                }, $complaints);

                Complaint::insert($complaints);
            endif;
            DB::commit();
            return $this->sendSuccess('success', JsonResponse::HTTP_OK, "Complaint created successfully");
        } catch (Exception $ex) {
            DB::rollBack();
            return $this->sendError('failed', JsonResponse::HTTP_BAD_REQUEST, "Failed to create complaint : " . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Latrine\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Latrine\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaint $complaint)
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
    public function update(Request $request, Complaint $complaint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Latrine\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        //
    }
}
