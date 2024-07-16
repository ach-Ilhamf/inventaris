<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\AgendaMasukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/penyedias', \App\Http\Controllers\PenyediaController::class);
Route::resource('/agendas', \App\Http\Controllers\AgendaMasukController::class);
Route::resource('/agendadtls', \App\Http\Controllers\AgendaMasukDetailController::class);