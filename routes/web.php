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
        Route::get('ajax/user-details', [UserController::class, 'userDetails'])->name('ajax.userDetails');
        Route::get('ajax/auth-user', [UserController::class, 'authUser'])->name('ajax.authUser');

        // Status update
        Route::put('user/status/{user}', [UserController::class, 'updateStatus'])->name('user.status');
        Route::put('role/status/{role}', [RoleController::class, 'updateStatus'])->name('role.status');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/map', [DashboardController::class, 'map'])->name('map');

        Route::post('user/uploadimage', [UserController::class, 'uploadImage'])->name('upload.image');
        Route::put('user/changepassword/{user}', [UserController::class, 'changePassword'])->name('changepassword');
        Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::resource('user', User\UserController::class);
        Route::resource('role', User\RoleController::class);

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
