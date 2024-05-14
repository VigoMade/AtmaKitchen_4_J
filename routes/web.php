<?php

use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\HampersController;
use App\Http\Controllers\HistoryAdminController;
use App\Http\Controllers\HistoryCustomerController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PembelianBBController;
use App\Http\Controllers\PengeluaranLainnyaController;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\ResetPasswordController;
use App\Models\PengeluaranLainnya;
use Illuminate\Support\Facades\Auth;
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
//forget

Route::get('/lupaPassword', function () {
    return view('lupaPassword');
})->name('lupaPassword');

Route::get('/reset/{email}', [ResetPasswordController::class, 'reset'])->name('reset');
Route::post('reset/action', [ResetPasswordController::class, 'actionReset'])->name('actionReset');
Route::get('/reset/{email}/{verify_key}', [ResetPasswordController::class, 'gotoResetPassword'])->name('gotoResetPassword');
Route::put('/reset/{email}', [ResetPasswordController::class, 'update'])->name('reset.update');

// landing page customer
Route::get('/landingPageCustomer', function () {
    return view('landingPageCustomer');
})->name('landingPageCustomer');

// landing page tim
Route::get('/landingPageAdmin', function () {
    return view('landingPageAdmin');
})->name('landingPageAdmin');

Route::get('/landingPageMO', function () {
    return view('landingPageMO');
})->name('landingPageMO');

Route::get('/landingPageOwner', function () {
    return view('landingPageOwner');
})->name('landingPageOwner');

Route::get('/informasiUmum', function () {
    return view('Katalog.informasiUmum');
})->name('informasiUmum');

Route::get('/aboutUs', function () {
    return view('Katalog.aboutUs');
})->name('aboutUs');

Route::get('/store', function () {
    return view('Katalog.store');
})->name('store');



//logout
Route::get('/logout', [LoginController::class, 'actionLogout'])->name('actionLogout');




//ADMIN//
//produks
Route::resource('/produks', ProdukController::class);
Route::get('/produks/search', 'ProdukController@search')->name('produks.search');
//hampers
Route::resource('/hampers', HampersController::class);
Route::get('/hampers/search', 'HampersController@search')->name('hampers.search');
//bahan baku
Route::resource('/bahanBaku', BahanBakuController::class);
Route::get('/bahanBaku/search', 'BahanBakuController@search')->name('bahanBaku.search');
//resep
Route::resource('/reseps', ResepController::class);
Route::get('/reseps/{id_detail_resep_bahan}/{id_resep}/edit', [ResepController::class, 'edit'])->name('reseps.edit');
Route::put('/reseps/{id_detail_resep_bahan}/{id_resep}/{id_bahanBaku}', [ResepController::class, 'update'])->name('reseps.update');
Route::get('/reseps/search', [ResepController::class, 'search'])->name('reseps.search');
//Customer
Route::resource('/dataCust', AdminCustomerController::class);
Route::get('/dataCust/search', [AdminCustomerController::class, 'search'])->name('dataCust.search');
Route::resource('/history', HistoryAdminController::class);


//MO//
//jabatan
Route::resource('/jabatan', JabatanController::class);
//penitip
Route::resource('/penitip', PenitipController::class);
Route::get('/penitip/search', 'PenitipController@search')->name('penitip.search');
//karyawan
Route::resource('/pegawai', PegawaiController::class);
Route::get('/pegawai/search', 'PegawaiController@search')->name('pegawai.search');
Route::get('registerPegawai/verify/{verify_key}', [PegawaiController::class, 'verifyPegawai'])->name('verifyPegawai');
//Pengeluaran Lainnya
Route::resource('/pengeluaranLainnya', PengeluaranLainnyaController::class);
Route::get('/pengeluaranLainnya/search', [PengeluaranLainnya::class, 'show'])->name('pengeluaranLainnya.search');
//pembelian BahanBaku
Route::resource('/pembelianBB', PembelianBBController::class);
Route::put('/pembelianBB/{id_pembelian}/{id_bahanBaku}', [PembelianBBController::class, 'update'])->name('pembelianBB.update');
Route::get('/pembelianBB/search', [PembelianBBController::class, 'search'])->name('pembelianBB.search');

//OWNER//
//gaji
Route::resource('/gaji', GajiController::class);


//Customer
Route::resource('/customer', ProfileController::class);
Route::resource('/historyCustomer', HistoryCustomerController::class);
Route::get('/historyCustomer/search', [HistoryCustomerController::class, 'search'])->name('historyCustomer.search');


//Informari
Route::get('/informasiProduk/{jenis_produk}', [KatalogController::class, 'show'])->name('informasiProduk.show');
