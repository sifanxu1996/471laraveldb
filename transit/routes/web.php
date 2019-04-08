<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('routes', 'RoutesController');
Route::get('/routes/{route}/assign', 'RoutesController@assign');
Route::post('/routes/{route}/assignStore', 'RoutesController@assignStore');

/*
Route::get('/routes', 'RoutesController@index');
Route::get('/routes/create', 'RoutesController@create');
Route::post('/routes', 'RoutesController@store');
Route::get('/routes/{route}', 'RoutesController@show');
Route::patch('/routes/{route}', 'RoutesController@update');
Route::delete('/routes/{route}', 'RoutesController@destroy');
Route::get('routes/{route}/edit', 'RoutesController@edit');
*/

Route::get('clients/{client}', 'ClientsController@show');
Route::patch('clients/{client}', 'ClientsController@update');
Route::get('clients/{client}/edit', 'ClientsController@edit');
Route::patch('clients/{client}/deposit', 'ClientsController@deposit');


Route::post('/routes/{route}/runs', 'RouteRunsController@store');
Route::patch('/routes/{route}/runs/{run}', 'RouteRunsController@update');
Route::delete('/routes/{route}/runs/{run}', 'RouteRunsController@destroy');

Route::get('/employees', 'EmployeesController@index');
Route::get('/operators/{operator}', 'OperatorsController@show');