<?php

use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\HampersController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ResepController;
use App\Models\Penitip;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    $penitips = Penitip::orderBy('id_penitip', 'desc')->paginate(5);
    return view('MOPenitip.indexPenitip', compact('penitips'));
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});


//hampers
Route::resource('/produks', ProdukController::class);
Route::get('/produks/search', 'ProdukController@search')->name('produks.search');

//hampers
Route::resource('/hampers', HampersController::class);
Route::get('/hampers/search', 'HampersController@search')->name('hampers.search');


//penitip
Route::resource('/penitip', PenitipController::class);
Route::get('/penitip/search', 'PenitipController@search')->name('penitip.search');





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
