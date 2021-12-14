<?php

use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\Api\PemasokController;
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

// Route::post('register', [PassportAuthController::class, 'register']);
// Route::post('login', [PassportAuthController::class, 'login']);

// Route::middleware('auth:api')->group(function () {
// 	Route::get('get-user', [PassportAuthController::class, 'userInfo']);
// 	Route::post('logout', [PassportAuthController::class, 'logout']);
// });
Route::resource('pemasok', PemasokController::class);
