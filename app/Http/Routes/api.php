<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\CheckInController;

Route::get('hello', function () {
    return response()->json();
});

Route::post('/create_user', [UserController::class, 'createUser']);
Route::post('/login_user', [UserController::class, 'loginUser']);
Route::post('/create_pasien', [PasienController::class, 'createPasien']);
Route::post('/login_pasien', [PasienController::class, 'loginPasien']);
Route::get('/get_pasien', [PasienController::class, 'getPasien']);
Route::get('/get_pasien/detail/{pasien_id}', [PasienController::class, 'getPasienDetail']);
Route::post('/create_gejala', [GejalaController::class, 'createGejala']);
Route::get('/get_gejala', [GejalaController::class, 'getGejala']);

Route::middleware(['iam'])->group(
    function () {
        Route::get('test', function(){
            return response()->json([
                "success" => true
            ]);
        });
        Route::post('/create_check_in', [CheckInController::class, 'createCheckIn']);
    }
);
    
Route::middleware(['iam', 'admin'])->group(
    function () {
    }
);