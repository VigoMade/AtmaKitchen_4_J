<?php

use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\HampersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResepController;
use App\Models\Penitip;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('login');
});

//Login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');

//regis
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionRegister'])->name('actionRegister');
Route::get('register/verify/{verify_key}', [RegisterController::class, 'verify'])->name('verify');

//lupa password
Route::get('/lupaPassword', function () {
    return view('lupaPassword');
})->name('lupaPassword');


//logout
Route::get('logout', [LoginController::class, 'actionLogout'])->name('actionLogout')->middleware('auth');

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
Route::get('register/verify/{verify_key}', [PegawaiController::class, 'verify'])->name('verify');


//gaji
Route::resource('/gaji', GajiController::class);


//pengeluaran lainnya
Route::get('/createPengeluaran', function () {
    return view('MOPengeluaranLainnya.createPengeluaran');
});

Route::get('/editPengeluaran', function () {
    return view('MOPengeluaranLainnya.editPengeluaran');
});

Route::get('/indexPengeluaran', function () {
    return view('MOPengeluaranLainnya.indexPengeluaran');
});

//pembelian bahan baku
Route::get('/createPembelianBB', function () {
    return view('MOPembelianBahanBaku.createPembelianBB');
});

Route::get('/editPembelianBB', function () {
    return view('MOPembelianBahanBaku.editPembelianBB');
});

Route::get('/indexPembelianBB', function () {
    return view('MOPembelianBahanBaku.indexPembelianBB');
});



//resep
Route::resource('/reseps', ResepController::class);
Route::get('/reseps/{id_detail_resep_bahan}/{id_resep}/{id_bahanBaku}/edit', [ResepController::class, 'edit'])->name('reseps.edit');
Route::put('/reseps/{id_detail_resep_bahan}/{id_resep}/{id_bahanBaku}', [ResepController::class, 'update'])->name('reseps.update');
Route::get('/reseps/search', 'ResepController@search')->name('reseps.search');


//bahan baku
Route::resource('/bahanBaku', BahanBakuController::class);
Route::get('/bahanBaku/search', 'BahanBakuController@search')->name('bahanBaku.search');

