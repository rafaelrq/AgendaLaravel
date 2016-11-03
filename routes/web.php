<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome'); 	
});
*/
Route::get('/', 'AgendaController@index');
Route::resource('/agenda', 'AgendaController@index');


Route::post ( '/add', 'AgendaController@add' );
Route::post ( '/edit', 'AgendaController@edit' );
Route::post ( '/delete', 'AgendaController@delete' );
Route::post ( '/search', 'AgendaController@search' );