<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\AgendaMasukController;
use App\Http\Controllers\AgendaMasukDetailController;
use App\Http\Controllers\KipBController;
use App\Http\Controllers\KodeBarangController;
use App\Http\Controllers\SesiController;
use App\Models\AgendaMasukDetail;
use App\Models\KipB;
use App\Models\KodeBarang;

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
Route::middleware(['guest'])->group(function(){
    Route::get('/',[SesiController::class,'index'])->name('login2');
    Route::post('/',[SesiController::class,'login2']);

    Route::get('/signup',[SesiController::class,'signup'])->name('signup');
    Route::post('/signup-proses',[SesiController::class,'signup_proses'])->name('signup-proses');
});
Route::get('/home',function(){
    return redirect('/agendas');
});
Route::middleware(['auth'])->group(function(){
Route::get('/agendas',[AgendaMasukController::class,'index']);        
Route::get('penyedias/data', [PenyediaController::class, 'getData'])->name('penyedias.data');
Route::resource('/penyedias', \App\Http\Controllers\PenyediaController::class);

Route::get('agendas/data', [AgendaMasukController::class, 'getData'])->name('agendas.data');
Route::resource('/agendas', \App\Http\Controllers\AgendaMasukController::class);

Route::get('agendadtls/data/{id_agenda}', [AgendaMasukDetailController::class, 'getData'])->name('agendadtls.getData');
Route::resource('/agendadtls', \App\Http\Controllers\AgendaMasukDetailController::class);
Route::get('agendadtls/{id_agenda}', [AgendaMasukDetailController::class, 'index'])->name('agendadtls.index');
Route::get('/agendadtls/create/{id_agenda}', [AgendaMasukDetailController::class, 'create'])->name('agendadtls.create');

Route::get('kipbs/data', [KipBController::class, 'getData'])->name('kipbs.data');
Route::resource('/kipbs', \App\Http\Controllers\KipBController::class);

Route::get('kodes/data', [KodeBarangController::class, 'getData'])->name('kodes.data');
Route::resource('/kodes', \App\Http\Controllers\KodeBarangController::class); 

Route::get('/logout',[SesiController::class,'logout']);
});
