<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Auth\ApiAuthController@login');
Route::post('/register', 'Auth\ApiAuthController@register');

Route::group(['middleware' => 'auth:api'], function() {
	Route::get('/user', function (Request $request) {
	    return $request->user();
	});
	Route::post('/logout', 'Auth\ApiAuthController@logout');
	Route::get('/teams', 'TeamController@index');
	Route::get('/teams/{team}', 'TeamController@show')->name('team.view');
	Route::post('/teams', 'TeamController@store');
	Route::post('/invites', 'InviteController@store');
});

Route::get('/invites/{token}', 'InviteController@accept');
