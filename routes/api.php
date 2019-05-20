<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Carbon\CarbonTimeZone;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json([
        'message' => 'PontuALL API - ONLINE',
        'time' => Carbon::now()->subHours(3)->timestamp,
        ]);
});

Route::get('/time', function () {
    return response()->json(Carbon::now()->subHours(3)->timestamp);
});


Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');

    Route::get('user', 'ApiController@getAuthUser');

    Route::get('products', 'ProductController@index');
    Route::get('products/{id}', 'ProductController@show');
    Route::post('products', 'ProductController@store');
    Route::put('products/{id}', 'ProductController@update');
    Route::delete('products/{id}', 'ProductController@destroy');
    Route::resource('usuarios', 'UsuariosController');
});






Route::resource('usuarioz', 'UsuariosController');
Route::resource('tipo_usuarioz', 'TipoUsuariosController');
