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

//Ruta de ejemplo para el LandingPage

Route::get('/', ['as' => '/', 'uses' => 'homeController@index']);
Route::get('terms/terms', ['as' => 'terms/terms', 'uses' => 'homeController@terms']);
Route::get('terms/privacy', ['as' => 'terms/privacy', 'uses' => 'homeController@privacy']);;



