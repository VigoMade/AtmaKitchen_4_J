<?php

use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\HampersController;
use App\Http\Controllers\HistoryAdminController;
use App\Http\Controllers\HistoryCustomerController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\KonfirmasiController;
use App\Http\Controllers\KonfirmasiPembayaranController;
use App\Http\Controllers\KonfirmasiPenarikanSaldo;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PembagianKomisiController;
use App\Http\Controllers\PembelianBBController;
use App\Http\Controllers\PenarikanSaldoController;
use App\Http\Controllers\PengeluaranLainnyaController;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\TransaksiController;
use App\Models\Alamat;
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

Route::get('/detailProduk', function () {
    return view('Katalog.detailProduk');
})->name('detailProduk');

Route::get('/pembayaran', function () {
    return view('pembayaran');
})->name('pembayaran');

Route::get('/nota', function () {
    return view('nota');
})->name('nota');




Route::get('/laporanPenjualanProduk', function () {
    return view('Laporan.laporanPenjualanProduk');
})->name('laporanPenjualanProduk');

Route::get('/laporanStockBB', function () {
    return view('Laporan.laporanStockBB');
})->name('laporanStockBB');








Route::get('/createAlamat', [AlamatController::class, 'create'])->name('alamat.create');
Route::post('/storeAlamat', [AlamatController::class, 'store'])->name('alamat.store');





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
Route::get('/informasiProduk', [KatalogController::class, 'index'])->name('landingPageCustomer');
Route::get('/showByTanggal', [KatalogController::class, 'showByTanggal'])->name('showByTanggal');
Route::get('/informasiProduk/{jenis_produk}', [KatalogController::class, 'show'])->name('informasiProduk.show');
Route::get('/detailProduk/{id_produk}', [KatalogController::class, 'showById'])->name('detailProduk.showById');
Route::get('/showHampers', [KatalogController::class, 'showHampers'])->name('showHampers');
Route::get('/showHampers/{id_hampers}', [KatalogController::class, 'showHampersById'])->name('showHampers.showByIdHampers');

//TransCust
Route::resource('/transaksi', TransaksiController::class);
Route::get('/alamat', [AlamatController::class, 'index'])->name('alamat.index');
Route::delete('/alamat/{id_alamat}', [AlamatController::class, 'destroy'])->name('alamat.delete');
Route::get('/createAlamat', [AlamatController::class, 'create'])->name('alamat.create');
Route::put('/alamat/{id_alamat}', [AlamatController::class, 'update'])->name('alamat.update');
Route::post('/storeAlamat', [AlamatController::class, 'store'])->name('alamat.store');
Route::put('/alamatAktif/{id_alamat}', [AlamatController::class, 'setAktif'])->name('alamat.setAktif');
Route::get('/alamat/{id_alamat}', [AlamatController::class, 'edit'])->name('alamat.edit');
Route::get('/alamatSearch', [AlamatController::class, 'show'])->name('alamat.search');


//Tambah Ke Keranjang
Route::post('/masukKeranjang', [KatalogController::class, 'store'])->name('masukKeranjang.store');
Route::post('/masukBuy', [KatalogController::class, 'storeBuy'])->name('masukBuy.storeBuy');
Route::post('/masukKeranjangHampers/{id_hampers}', [KatalogController::class, 'storeHampers'])->name('masukKeranjangHampers.store');
Route::post('/masukBuyHampers/{id_hampers}', [KatalogController::class, 'storeHampersBuy'])->name('masukBuyHampers.storeBuy');


Route::get('/indexJarak', [AlamatController::class, 'indexJarak'])->name('indexJarak');
Route::get('/createJarak/{id_transaksi}', [AlamatController::class, 'createJarak'])->name('createJarak');
Route::put('/updateJarak/{id_transaksi}', [AlamatController::class, 'updateJarak'])->name('updateJarak');

Route::get('/konfirmasiPembayaran', [KonfirmasiPembayaranController::class, 'index'])->name('konfirmasiPembayaran.index');
Route::get('/konfirmasiPembayaran/{id_transaksi}', [KonfirmasiPembayaranController::class, 'create'])->name('konfirmasiPembayaran.create');
Route::post('/konfirmasiPembayaran/{id_transaksi}', [KonfirmasiPembayaranController::class, 'store'])->name('konfirmasiPembayaran.store');
Route::put('/rejectAdmin/{id_transaksi}', [KonfirmasiPembayaranController::class, 'reject'])->name('rejectAdmin');
Route::resource('/pemasukan', PemasukanController::class);

//Konfirmasi MO
Route::get('/indexKonfirmasi', [KonfirmasiController::class, 'index'])->name('indexKonfirmasi.index');
Route::put('/reject/{id}', [KonfirmasiController::class, 'reject'])->name('reject');
Route::put('/accept/{id}', [KonfirmasiController::class, 'accept'])->name('accept');
Route::put('/prosses/{id}/{deskripsi}/{id_bahan_baku}', [KonfirmasiController::class, 'progress'])->name('prosses');
Route::put('/pickup/{id}', [KonfirmasiController::class, 'pickUp'])->name('pickUp');
Route::put('/send/{id}', [KonfirmasiController::class, 'send'])->name('send');
Route::put('/done/{id}', [KonfirmasiController::class, 'done'])->name('done');
Route::put('/pickUpDone/{id}', [KonfirmasiController::class, 'pickUpDone'])->name('pickUpDone');
Route::post('/notifyapp', [KonfirmasiController::class, 'notifyapp']);

//Konfirmasi Admin
Route::get('/indexAdminKonfirmasi', [KonfirmasiController::class, 'indexAdmin'])->name('indexAdminKonfirmasi.index');


//nota
Route::get('/nota/{id_transaksi}', [NotaController::class, 'index'])->name('nota');

//rekening
Route::resource('/rekening', RekeningController::class);

//Tarik
Route::get('/penarikanSaldo', [PenarikanSaldoController::class, 'index'])->name('historyPenarikanSaldo.index');
Route::get('/penarikanSaldo/create', [PenarikanSaldoController::class, 'create'])->name('penarikanSaldo.create');
Route::post('/penarikanSaldo/store', [PenarikanSaldoController::class, 'store'])->name('penarikanSaldo.store');


//Konfirmasi Saldo
Route::get('/konfirmasiSaldo', [KonfirmasiPenarikanSaldo::class, 'index'])->name('konfirmasiSaldo.index');
Route::put('/konfirmasiSaldo/terima/{id}', [KonfirmasiPenarikanSaldo::class, 'terima'])->name('konfirmasiSaldo.terima');
Route::put('/konfirmasiSaldo/tolak/{id}/{id_customer}', [KonfirmasiPenarikanSaldo::class, 'tolak'])->name('konfirmasiSaldo.tolak');

//Laporan

Route::get('/laporanMO', function () {
    return view('Laporan.indexPageLaporanMO');
})->name('indexPageLaporanMO');


Route::get('/laporanOwner', function () {
    return view('Laporan.indexPageLaporanOwner');
})->name('indexPageLaporanOwner');

Route::get('/laporanPemasukanPengeluran', [LaporanController::class, 'pemasukanPengeluaran'])->name('laporanPemasukanPengeluaran');
Route::get('/laporanPresensi', [LaporanController::class, 'laporanPresensi'])->name('laporanPresensi');
Route::get('/laporanPenitip', [LaporanController::class, 'laporanPenitip'])->name('laporanPenitip');
Route::get('/laporanPenggunaanBB', [LaporanController::class, 'laporanPenggunaanBB'])->name('laporanPenggunaanBB');
Route::get('/laporanPenjualanBulanan', [LaporanController::class, 'laporanPenjualan'])->name('laporanPenjualanBulanan');
Route::get('/laporanStockBB', [LaporanController::class, 'laporanBB'])->name('laporanStockBB');
Route::get('/laporanLaporan', [LaporanController::class, 'laporanLaporan'])->name('laporanLaporan');
Route::get('/laporanJumlahTransaksi', [LaporanController::class, 'laporanJumlahTransaksi'])->name('laporanJumlahTransaksi');

//Pembgian Komisi
Route::get('/pembagianKomisi', [PembagianKomisiController::class, 'index'])->name('OwnerPembagianKomisi.index');
Route::put('/pembagianKomisi/{id_pemasukan}/{id_penitip}', [PembagianKomisiController::class, 'pembagian'])->name('OwnerPembagianKomisi.pembagian');
