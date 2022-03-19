<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentsController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('documents', [ DocumentsController::class, 'index']);
Route::post('documents', [ DocumentsController::class, 'store']);
Route::post('documents/upload', [ DocumentsController::class, 'create']);
Route::post('documents/excel', [ DocumentsController::class, 'download']);