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

Route::middleware('auth:api')->group(function () {
    Route::apiResource('categories',    'Resources\CategoryController');
    Route::apiResource('sponsors',      'Resources\SponsorController');
    Route::apiResource('courses',       'Resources\CourseController');
});

Route::apiResource('workshops',       'Resources\WorkshopController');

