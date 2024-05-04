<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForgetPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\PresensiController;
use App\Http\Controllers\ProdukController;
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
Route::post('/login', [AuthController::class, 'actionactionLogin_mobile']);
Route::post('/reset', [ForgetPasswordController::class, 'reset']);
Route::get('/reset/{email}/{verify_key}', [ForgetPasswordController::class, 'gotoResetPassword']);
Route::put('/presensi/{id}', [PresensiController::class, 'update']);
Route::get('/presensi', [PresensiController::class, 'index']);
Route::get('/produk', [ProdukController::class, 'index_mobile']);
Route::get('/produk/{filename}', [ProdukController::class, 'getImage']);


