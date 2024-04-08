<?php

use App\Http\Controllers\JabatanController;
use App\Http\Controllers\HampersController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

//resep
Route::get('/createResep', function () {
    return view('AdminResep.createResep');
});

Route::get('/editResep', function () {
    return view('AdminResep.editResep');
});

Route::get('/indexResep', function () {
    return view('AdminResep.indexResep');
});

//bahan baku
Route::get('/createBahan', function () {
    return view('AdminBahanBaku.createBahanBaku');
});

Route::get('/editBahan', function () {
    return view('AdminBahanBaku.editBahanBaku');
});

Route::get('/indexBahan', function () {
    return view('AdminBahanBaku.indexBahanBaku');
});

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





Route::get('/editKaryawan', function () {
    return view('MOKaryawan.editKaryawan');
});

Route::get('/createKaryawan', function () {
    return view('MOKaryawan.createKaryawan');
});

Route::get('/indexKaryawan', function () {
    return view('MOKaryawan.indexKaryawan');
});

//gaji
Route::get('/editGaji', function () {
    return view('OwnerGaji.editGaji');
});

Route::get('/indexGaji', function () {
    return view('OwnerGaji.indexGaji');
});
