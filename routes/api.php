<?php

use App\Http\Controllers\API\SetupApiController;
use App\Http\Controllers\API\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function () use ($router) {

    Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);

    // Auth User Only
    Route::middleware('auth:api')->name('api.')->namespace('\App\Http\Controllers\API')->group(function () {
        // All Setup
        Route::get('get-setup', [SetupApiController::class, 'index']);
        Route::get('user-info', [UserApiController::class, 'getUserInfo']);
        Route::apiResources([
            'complaint' => ComplaintApiController::class,
            'inspection' => InspectionApiController::class,
            'desludge' => DesludgeApiController::class,
        ]);
    });
});
