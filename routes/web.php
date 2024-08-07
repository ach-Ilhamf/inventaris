<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\AgendaMasukController;
use App\Http\Controllers\AgendaMasukDetailController;
use App\Http\Controllers\BarangHabisKeluarController;
use App\Http\Controllers\BarangHabisTerimaController;
use App\Http\Controllers\BarangPakaiHabisController;
use App\Http\Controllers\ExportFileController;
use App\Http\Controllers\KipBController;
use App\Http\Controllers\KodeBarangController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SesiController;

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

Route::get('pegawais/data', [PegawaiController::class, 'getData'])->name('pegawais.data');
Route::resource('/pegawais', \App\Http\Controllers\PegawaiController::class);

Route::get('agendadtls/data/{id_agenda}', [AgendaMasukDetailController::class, 'getData'])->name('agendadtls.getData');
Route::post('agendadtls/cetak/{id_agenda}', [AgendaMasukDetailController::class, 'buktiMemorial'])->name('agendadtls.cetakBuktiMemorial');
Route::resource('/agendadtls', \App\Http\Controllers\AgendaMasukDetailController::class);
Route::get('agendadtls/{id_agenda}', [AgendaMasukDetailController::class, 'index'])->name('agendadtls.index');
Route::get('/agendadtls/create/{id_agenda}', [AgendaMasukDetailController::class, 'create'])->name('agendadtls.create');

Route::get('kipbs/data', [KipBController::class, 'getData'])->name('kipbs.data');
Route::resource('/kipbs', \App\Http\Controllers\KipBController::class);
Route::get('export-kipb', [KipBController::class, 'export_kipb_excel'])->name('export.kipb');

Route::get('kodes/data', [KodeBarangController::class, 'getData'])->name('kodes.data');
Route::resource('/kodes', \App\Http\Controllers\KodeBarangController::class);

Route::get('barangs/data', [BarangPakaiHabisController::class, 'getData'])->name('barangs.data');
Route::resource('/barangs', \App\Http\Controllers\BarangPakaiHabisController::class);

Route::get('barangterimas/data', [BarangHabisTerimaController::class, 'getData'])->name('barangterimas.data');
Route::resource('/barangterimas', \App\Http\Controllers\BarangHabisTerimaController::class);
Route::get('export-barangterima', [BarangHabisTerimaController::class, 'export_barang_terima'])->name('export.barangterima');

Route::get('barangkeluars/data', [BarangHabisKeluarController::class, 'getData'])->name('barangkeluars.data');
Route::resource('/barangkeluars', \App\Http\Controllers\BarangHabisKeluarController::class);
Route::get('export-barangkeluar', [BarangHabisKeluarController::class, 'export_barang_keluar'])->name('export.barangkeluar');

Route::get('/account',[SesiController::class,'edit_user'])->name('edit-user');
Route::put('/account-update/{id}', [SesiController::class, 'update_user'])->name('update-user');

Route::get('/logout',[SesiController::class,'logout']);
});