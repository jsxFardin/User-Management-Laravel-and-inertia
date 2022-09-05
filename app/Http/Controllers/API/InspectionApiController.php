<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Latrine\Inspection;
use App\Models\Latrine\Latrine;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InspectionApiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $inspections = $request->all();

            DB::beginTransaction();
            if(array_key_exists('latrine_id', $inspections) && array_key_exists('count_filled_up_ring', $inspections)):
                $inspections['latrine_id'] = Latrine::where('uid_no', $inspections['latrine_id'])->first()->id;
                Inspection::create($inspections);
            else:
                $uids = Latrine::whereIn('uid_no', array_map(function($item){
                    return $item['latrine_id'];
                }, $inspections))->select('id', 'uid_no')->get()->toArray();

                $inspections = array_map(function($item) use($uids){
                    $item['latrine_id'] = $uids[array_search($item['latrine_id'], array_column($uids, 'uid_no'))]['id'];
                    return $item;
                }, $inspections);

                Inspection::insert($inspections);
            endif;
            DB::commit();
            return $this->sendSuccess('success', JsonResponse::HTTP_OK, "Inspection created successfully");
        } catch (Exception $ex) {
            DB::rollBack();
            return $this->sendError('failed', JsonResponse::HTTP_BAD_REQUEST, "Failed to create Inspection : " . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Latrine\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function show(Inspection $inspection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Latrine\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function edit(Inspection $inspection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Latrine\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inspection $inspection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Latrine\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inspection $inspection)
    {
        //
    }
}
