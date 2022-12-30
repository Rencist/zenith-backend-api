<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GejalaController;

Route::get('hello', function () {
    return response()->json();
});

Route::post('/create_user', [UserController::class, 'createUser']);
Route::post('/login_user', [UserController::class, 'loginUser']);
Route::post('/create_gejala', [GejalaController::class, 'createGejala']);
Route::get('/get_gejala', [GejalaController::class, 'getGejala']);

Route::middleware(['iam'])->group(
    function () {
        Route::get('test', function(){
            return response()->json([
                "success" => true
            ]);
        });
    }
);
    
Route::middleware(['iam', 'admin'])->group(
    function () {
    }
);