<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{AccountController,LoginController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// authenticate user

Route::controller(LoginController::class)->group(function() {
    Route::post('/login', 'login')->middleware('guest');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

Route::controller(AccountController::class)->group(function() {
    Route::middleware(['auth:sanctum'])->group(function() {
        Route::post('/accounts', 'create_account');
        Route::get('/accounts/{id}', 'account_detail');
        Route::post('/transfers', 'transfer');
    });
});
