<?php

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

//Persons
Route::get('persons', 'App\Http\Controllers\PersonController@index');
Route::post('persons/create', 'App\Http\Controllers\PersonController@store');
Route::get('persons/{id}', 'App\Http\Controllers\PersonController@show');
Route::put('persons/{id}', 'App\Http\Controllers\PersonController@update');
Route::delete('persons/{id}', 'App\Http\Controllers\PersonController@destroy');

//Addresses
Route::get('addresses', 'App\Http\Controllers\AddressController@index');
Route::post('addresses/create', 'App\Http\Controllers\AddressController@store');
Route::get('addresses/{id}', 'App\Http\Controllers\AddressController@show');
Route::put('addresses/{id}', 'App\Http\Controllers\AddressController@update');
Route::delete('addresses/{id}', 'App\Http\Controllers\AddressController@destroy');
// Adiciona uma nova rota para buscar todos os endereços, incluindo os soft deleted, se necessário
Route::get('addresses/all/{id}', 'App\Http\Controllers\AddressController@fetchAll');
