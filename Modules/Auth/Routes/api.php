<?php

use Illuminate\Http\Request;
use Modules\Auth\Http\Controllers\AuthController;

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
Route::post('/register', [AuthController::class, 'create']);
Route::post('/auth/login', [AuthController::class, 'store']);
Route::post('/generar', [AuthController::class, 'generate']);
Route::post('/edit', [AuthController::class, 'update']);



Route::resource('motorizado', AuthMotorizadoController::class);