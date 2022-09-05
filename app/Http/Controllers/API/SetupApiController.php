<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SetupApiController extends BaseController
{
    /**
     * @OA\Post(
     * path="/api/v1/get-setup",
     * operationId="All Setup",
     * tags={"Setup"},
     * summary="All Setup",
     * description="All Setup",
     *      @OA\Response(
     *          response=201,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function index()
    {
        // CALL LATRINE SETUP DATA
        $getLatrineData = getLatrineSetUpData(false);

        return $this->sendSuccess(
            "success",
            JsonResponse::HTTP_OK,
            [
                'donors' => $getLatrineData['donors'] ?? [],
                'construction_status' => $getLatrineData['construction_status'] ?? [],
                'pit_types' => $getLatrineData['pit_types'] ?? [],
                'latrine_structures' => $getLatrineData['latrine_structures'] ?? [],
                'facility_useds' => $getLatrineData['facility_useds'] ?? [],
                'facility_types' => $getLatrineData['facility_type'] ?? [],
                'sludge_transfers' => $getLatrineData['sludge_transfers'] ?? [],
            ]
        );
    }
}
