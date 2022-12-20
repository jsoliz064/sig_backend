<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\LicenseCategoryController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('modelos',[CarModelController::class,'index'])->name('modelos.index');
Route::get('licencias',[LicenseCategoryController::class,'index'])->name('licencias.index');
Route::get('vehiculos',[VehicleController::class,'index'])->name('vehiculos.index');
Route::get('choferes',[UserController::class,'index'])->name('users.index');
Route::get('sessions',[SessionController::class,'session']);


