<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForgetPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\PresensiController;
use App\Http\Controllers\Api\ProdukControllerM;
use App\Http\Controllers\Api\PegawaiControllerM;
use App\Http\Controllers\Api\HistoriController;
use App\Http\Controllers\Api\HampersControllerM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', [AuthController::class, 'login']);
Route::post('/reset', [ForgetPasswordController::class, 'reset']);
Route::get('/reset/{email}/{verify_key}', [ForgetPasswordController::class, 'gotoResetPassword']);
Route::put('/presensi/{id}', [PresensiController::class, 'update']);
Route::get('/presensi', [PresensiController::class, 'index']);
Route::post('/presensi', [PresensiController::class, 'store']);
Route::get('/produk/{title}', [ProdukControllerM::class, 'index_mobile']);
Route::get('/produks', [ProdukControllerM::class, 'getSpecialProduk']);
Route::get('/pegawai', [PegawaiControllerM::class, 'index_mobile']);
Route::get('/history/{id}', [HistoriController::class, 'index']);
Route::get('/history_/{search}', [HistoriController::class, 'search']);
Route::get('/hampers', [HampersControllerM::class, 'getHampers']);



