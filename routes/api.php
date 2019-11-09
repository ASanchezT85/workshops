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

Route::post('login',      'Auth\PassportController@login');
Route::post('register',   'Auth\PassportController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('me',              'Auth\PassportController@details');
    Route::get('logout',          'Auth\PassportController@logout');
});

Route::get('dashborard', 'DashboardController@dashborard')->name('dashborard');

