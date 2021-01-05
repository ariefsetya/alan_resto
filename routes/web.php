<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{tab?}', 'RestoController@index');
Route::post('/add_menu', 'RestoController@add_menu');
Route::get('/add_temp/{food_id}', 'RestoController@add_temp');
