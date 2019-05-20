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
    return response()->json(Carbon::now(-3)->subHours(3)->timestamp);
});



Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');

    Route::get('user', 'ApiController@getAuthUser');

    //Route::resource('usuarios', 'UsuariosController');
    Route::get('usuarios', 'UsuariosController@index');
    Route::get('usuarios/{id}', 'UsuariosController@show');
    Route::resource('tipo_usuarios', 'TipoUsuariosController');
});





Route::resource('open_usuarios', 'UsuariosController');
Route::resource('open_tipo_usuarios', 'TipoUsuariosController');

