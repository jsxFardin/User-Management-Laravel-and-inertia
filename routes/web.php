<?php

use App\Http\Controllers\Agency\AgencyController;
use App\Http\Controllers\CsvDataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Encampment\BlockController;
use App\Http\Controllers\Latrine\ComplaintController;
use App\Http\Controllers\Latrine\InspectionController;
use App\Http\Controllers\Latrine\LatrineController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Team\TeamController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (auth()->user()) :
        return redirect(RouteServiceProvider::HOME);
    endif;
    return Inertia::render('Auth/Login', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/password/reset', function () {
    return Inertia::render('Auth/ForgotPassword', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::namespace('App\Http\Controllers')->group(function () {

    Route::middleware(['auth', 'verified'])->group(function () {
        // Ajax Request
        Route::get('ajax/get-menus', [DashboardController::class, 'getMenus'])->name('ajax.menus');
        Route::get('ajax/block-details', [BlockController::class, 'blockAndCampDetails'])->name('ajax.blockAndCampDetails');
        Route::get('ajax/team-details', [TeamController::class, 'teamDetails'])->name('ajax.teamDetails');
        Route::get('ajax/user-details', [UserController::class, 'userDetails'])->name('ajax.userDetails');
        Route::get('ajax/auth-user', [UserController::class, 'authUser'])->name('ajax.authUser');
        Route::get('ajax/total-volume-desludged', [DashboardController::class, 'totalVolumeDesludged'])->name('ajax.total.volume.desludged');
        Route::get('ajax/latrine-desludge-schedule', [DashboardController::class, 'latrineDesludgeSchedule'])->name('ajax.latrineDesludgeSchedule');
        Route::get('ajax/typeof-latrine', [DashboardController::class, 'typeofLatrine'])->name('ajax.typeof.latrine');
        Route::get('ajax/total-desludged-typeof-latrine', [DashboardController::class, 'totalDesludgedTypeofLatrine'])->name('ajax.totalDesludgedTypeofLatrine');
        Route::get('ajax/total-hours-used', [DashboardController::class, 'totalHoursUsed'])->name('ajax.total.hours.used');
        Route::get('ajax/see-foreign-materials', [DashboardController::class, 'seeForeignMaterials'])->name('ajax.see.foreign.materials');
        Route::get('ajax/total-litter-fuel-used', [DashboardController::class, 'totalLitterFuelUsed'])->name('ajax.total.litter.fuel.used');
        Route::get('ajax/required-sanitation-zone', [DashboardController::class, 'mostReqDesludgeSanitationZone'])->name('ajax.mostReqDesludgeSanitationZone');

        // Status update
        Route::put('agency/status/{agency}', [AgencyController::class, 'updateStatus'])->name('agency.status');
        Route::put('team/status/{team}', [TeamController::class, 'updateStatus'])->name('team.status');
        Route::put('user/status/{user}', [UserController::class, 'updateStatus'])->name('user.status');
        Route::put('role/status/{role}', [RoleController::class, 'updateStatus'])->name('role.status');
        Route::put('inspection/status/{inspection}', [InspectionController::class, 'updateStatus'])->name('inspection.status');
        Route::put('complaint/status/{complaint}', [ComplaintController::class, 'updateStatus'])->name('complaint.status');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/map', [DashboardController::class, 'map'])->name('map');

        Route::resource('agency', Agency\AgencyController::class);
        Route::post('user/uploadimage', [UserController::class, 'uploadImage'])->name('upload.image');
        Route::put('user/changepassword/{user}', [UserController::class, 'changePassword'])->name('changepassword');
        Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::resource('user', User\UserController::class);
        Route::resource('role', User\RoleController::class);
        Route::resource('position', User\PositionController::class);
        Route::resource('team', Team\TeamController::class);

        // Setup
        Route::prefix('setup')->name('setup.')->group(function () {
            Route::resources([
                'facility' => Setup\FacilityController::class,
                'facility-used' => Setup\FacilityUsedController::class,
                'pit' => Setup\PITController::class,
                'structure' => Setup\StructureController::class,
                'construction' => Setup\ConstructionController::class,
                'donor' => Setup\DonorController::class,
                'transfer' => Setup\TransferController::class,
                'camp' => Encampment\CampController::class,
                'block' => Encampment\BlockController::class,
                'sanitation-zone' => Setup\SanitationZoneController::class,
            ]);
            Route::get('season', [App\Http\Controllers\Setup\SeasonController::class, 'index'])->name('season.index');
            Route::put('season/{season}',  [App\Http\Controllers\Setup\SeasonController::class, 'update'])->name('season.update');
            Route::put('block/status/{block}', [BlockController::class, 'updateStatus'])->name('block.status');
        });
        Route::put('/latrine/status/{latrine}', [LatrineController::class, 'updateStatus'])->name('latrine.status');

        Route::resources([
            'latrine' => Latrine\LatrineController::class,
        ]);
        Route::resources([
            'complaint' => Latrine\ComplaintController::class,
            'desludge' => Latrine\DesludgeController::class,
            'inspection' => Latrine\InspectionController::class,
        ]);

        //REPORTS
        Route::get('report/latrine', [ReportController::class, 'latrineReport'])->name('report.latrine.index');
        Route::get('report/desludge', [ReportController::class, 'desludgeReport'])->name('report.desludge.index');
        Route::get('report/sanitation-zone', [ReportController::class, 'sanitationZoneReport'])->name('report.sanitation-zone.index');

        Route::get('download-latrine-report', [ReportController::class, 'downloadLatrineReport'])->name('download.latrineReport');
        Route::get('download-desludge-report', [ReportController::class, 'downloadDesludgeReport'])->name('download.desludgeReport');
        Route::get('download-sanitation-zone-report', [ReportController::class, 'downloadSanitationZoneReport'])->name('download.sanitationZoneReport');

        Route::get('import-data', [CsvDataController::class, 'index'])->name('import.index');
        Route::post('import-data', [CsvDataController::class, 'store'])->name('import.store');
    });
});
