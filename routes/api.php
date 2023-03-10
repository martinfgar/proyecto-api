<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\LoginController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('login',[LoginController::class,'login']);
Route::post('register',[LoginController::class,'register']);
Route::middleware('auth:api')->get('empresas',[EmpresaController::class,'empresas']);
Route::middleware('auth:api')->get('acciones/empresa/{id}',[StocksController::class,'acciones']);
Route::middleware('auth:api')->get('acciones/today/empresa/{id?}',[StocksController::class,'accionesHoy']);
Route::middleware('auth:api')->get('acciones/historico/empresa/{id?}',[StocksController::class,'accionesHistoricas']);