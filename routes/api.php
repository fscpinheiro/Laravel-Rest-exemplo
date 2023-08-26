<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ClienteController;    

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

//Route::apiResource('/clientes', ClienteController::class);

Route::get('/clientes/busca', [ClienteController::class, 'buscaGeral']);
Route::get('/clientes/{id}', [ClienteController::class, 'show']);
Route::get('/clientes', [ClienteController::class,'index']);
Route::post('/clientes', [ClienteController::class,'store']);
Route::patch('/clientes/{id}', [ClienteController::class, 'update']);
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
