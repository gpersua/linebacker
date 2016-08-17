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

Route::get('/', ['as' => 'landing', 'uses' => 'homeController@index']);
Route::get('/', function() { return View::make('home.home'); }); 
Route::get('about', function() { return View::make('home.about'); }); 
Route::get('projects', function() { return View::make('home.projects'); }); 
Route::get('contact', function() { return View::make('home.contact'); });


