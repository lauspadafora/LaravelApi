<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');

Route::get('/', function () {
    return view('welcome');
});

//Route::auth();

Route::get('/login','Auth\AuthController@getLogin');
Route::post('/login','Auth\AuthController@authenticate');
Route::get('/logout','Auth\AuthController@logout');

Route::get('/home', 'HomeController@index');

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function () {
    Route::get('/frecuencia/index', 'FrecuenciaController@index')->name('frecuencia.index');
    Route::post('/frecuencia/store', 'FrecuenciaController@store')->name('frecuencia.store');
    Route::get('/frecuencia/show/{id}', 'FrecuenciaController@show')->name('frecuencia.show');
    Route::put('/frecuencia/update/{id}', 'FrecuenciaController@update')->name('frecuencia.update');
    Route::match(['get', 'delete'], '/frecuencia/destroy/{id}', 'FrecuenciaController@destroy')->name('frecuencia.destroy');
});

