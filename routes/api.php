<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CoordinateController;
use \App\Http\Controllers\BusController;
use \App\Http\Controllers\VehicleController;
use \App\Http\Controllers\DriverController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=> 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('admin', [AuthController::class, 'adminLogin']);
});

Route::group(['prefix'=> 'bus'], function () {
    Route::get('index', [BusController::class, 'index']);
    Route::get('show/{id}', [BusController::class, 'show']);
    Route::get('all', [BusController::class, 'busesWithTheyPaths']);
});

Route::group(['prefix'=> 'coordinate'], function () {
    Route::get('show/{id}/{comingback}', [CoordinateController::class, 'show']);
});


Route::group(['prefix'=> 'vehicles'], function () {
    Route::get('show/{id}', [VehicleController::class, 'show']);
    Route::get('vehiculos-user/{id}', [VehicleController::class, 'vehiculosuser']);
    Route::get('all', [VehicleController::class, 'all']);
    Route::get('ruta/{id}', [VehicleController::class, 'ruta']);
});

Route::group(['prefix'=> 'drivers'], function () {
    Route::put('ocupar-vehiculo',[DriverController::class, 'ocupar']);
    Route::put('liberar-vehiculo',[DriverController::class, 'liberar']);
    Route::get('nearbuses/{bus}/{lat}/{long}', [DriverController::class, 'getBussesAround']);
    Route::put('setLatLong/{user}/{vehicle}', [DriverController::class, 'setPosition']);
});

Route::group(['prefix'=> 'sessions'], function () {
    Route::post('/write', [SessionController::class, 'create']);
});
