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

Route::group(['prefix' => 'app'], function () {
    Route::get('/{any?}', function () {
	    return view('app');
	});
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
	Route::get('teams', 'TeamController@index')->middleware('auth');
	Route::get('teams/{team}', 'TeamController@show')->middleware('auth')->name('team.view');
	Route::post('/teams', 'TeamController@store')->middleware('auth');

	Route::get('/home', 'HomeController@index')->name('home');
});


