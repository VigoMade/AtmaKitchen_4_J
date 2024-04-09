<?php

use App\Http\Controllers\GajiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\HampersController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\BahanBakuController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('MOPenitip.indexPenitip');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

//produk
Route::get('/createProduk', function () {
    return view('AdminProduk.createProduk');
});

Route::get('/editProduk', function () {
    return view('AdminProduk.editProduk');
});

Route::get('/indexProduk', function () {
    return view('AdminProduk.indexProduk');
});

//hampers
Route::resource('/hampers', HampersController::class);
Route::get('/hampers/search', 'HampersController@search')->name('hampers.search');


//penitip
Route::get('/editPenitip', function () {
    return view('MOPenitip.editPenitip');
});

Route::get('/createPenitip', function () {
    return view('MOPenitip.createPenitip');
});

Route::get('/indexPenitip', function () {
    return view('MOPenitip.indexPenitip');
});


//jabatan
Route::resource('/jabatan', JabatanController::class);

//karyawan
Route::resource('/pegawai', PegawaiController::class);
Route::get('/pegawai/search', 'PegawaiController@search')->name('pegawai.search');


//gaji
Route::resource('/gaji', GajiController::class);




//resep
Route::resource('/reseps', ResepController::class);
Route::get('/reseps/{id_detail_resep_bahan}/{id_resep}/{id_bahanBaku}/edit', [ResepController::class, 'edit'])->name('reseps.edit');
Route::put('/reseps/{id_detail_resep_bahan}/{id_resep}/{id_bahanBaku}', [ResepController::class, 'update'])->name('reseps.update');
Route::get('/reseps/search', 'ResepController@search')->name('reseps.search');


//bahan baku
Route::resource('/bahanBaku', BahanBakuController::class);
Route::get('/bahanBaku/search', 'BahanBakuController@search')->name('bahanBaku.search');
