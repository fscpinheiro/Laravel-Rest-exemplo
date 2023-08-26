<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/cpf/{number}',function ($number){
    Log::info($number);

   
    //if (ValidateCPF($number)) {
    //    return "OK CPF VÁLIDO";
    //} else {
    //    return "Ops! CPF INVÁLIDO";
    //}
    return "OK";
});