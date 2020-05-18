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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/refresh','WhazzupController@refresh');

//SQUAWK
Route::post('/squawk/find','SquawkController@find');


//AIRPORTS
Route::get('/airports','AirportsController@index');
Route::view('/airports/add','airports.add');
Route::post('/airports/add','AirportsController@add');
Route::get('/airports/{id}/edit','AirportsController@edit');
Route::patch('/airports/{airport}/update','AirportsController@update');
Route::get('/airports/{airport}/delete','AirportsController@destroy');