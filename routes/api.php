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

Route::get('/user', function (Request $request) {
    return 12;
})->middleware('auth:api');

//POST запрос создания поста
Route::post('posters', 'PosterController@store');

//GET запрос полученя постов
Route::get('posters', 'PosterController@show');

//GET запрос удаления поста
Route::delete('posters', 'PosterController@destroy');
