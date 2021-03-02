<?php

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(static function() {
    Route::resource('account', Controllers\Auth\RegisterController::class);
});

Route::middleware('auth:sanctum')->group(static function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
