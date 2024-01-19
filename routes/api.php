<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DetalleIngresoController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\TrabajadoreController;
use App\Http\Controllers\VentaController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/cliente', [ClienteController::class, 'index']);
Route::get('/cliente/{id}', [ClienteController::class, 'show']);
Route::post('/cliente', [ClienteController::class, 'store']);
Route::put('/cliente/{id}', [ClienteController::class, 'update']);
Route::delete('/cliente/{id}', [ClienteController::class, 'destroy']);

Route::get('/trabajador', [TrabajadoreController::class, 'index']);
Route::get('/trabajador/{id}', [TrabajadoreController::class, 'show']);
Route::post('/trabajador', [TrabajadoreController::class, 'store']);
Route::put('/trabajador/{id}', [TrabajadoreController::class, 'update']);
Route::delete('/trabajador/{id}', [TrabajadoreController::class, 'destroy']);

Route::get('/Ventas', [VentaController::class, 'index']);
Route::get('/Ventas/{id}', [VentaController::class, 'show']);
Route::post('/Ventas', [VentaController::class, 'create']);
Route::put('/Ventas/{id}', [VentaController::class, 'update']);
Route::delete('/Ventas/{id}', [VentaController::class, 'destroy']);

Route::get('/detalleventa', [DetalleVentaController::class, 'index']);
Route::get('/detalleventa/{id}', [DetalleVentaController::class, 'show']);
Route::post('/detalleventa', [DetalleVentaController::class, 'create']);
Route::put('/detalleventa/{id}', [DetalleVentaController::class, 'update']);
Route::delete('/detalleventa/{id}', [DetalleVentaController::class, 'destroy']);

Route::get('/detalleingreso', [DetalleIngresoController::class, 'index']);
Route::get('/detalleingreso/{id}', [DetalleIngresoController::class, 'show']);
Route::post('/detalleingreso', [DetalleIngresoController::class, 'create']);
Route::put('/detalleingreso/{id}', [DetalleIngresoController::class, 'update']);
Route::delete('/detalleingreso/{id}', [DetalleIngresoController::class, 'destroy']);

Route::get('/articulos', [ArticuloController::class, 'index']);
Route::get('/articulos/{id}', [ArticuloController::class, 'show']);
Route::post('/articulos', [ArticuloController::class, 'create']);
Route::put('/articulos/{id}', [ArticuloController::class, 'update']);
Route::delete('/articulos/{id}', [ArticuloController::class, 'destroy']);
