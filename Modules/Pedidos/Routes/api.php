<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['auth:api']], function () {
    Route::resource('pedido', PedidosController::class);
    
});

Route::resource('motorizado-pedidos', PedidoMotorizadoController::class );
Route::resource('cliente/pedido', PedidosClienteController::class);
Route::resource('login/pedido', PedidosLoginController::class);
// Route::resource('motorizado-pedidos', PedidoMotorizadoController::class )->only(['show']);
