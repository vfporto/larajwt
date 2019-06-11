<?php

use Illuminate\Http\Request;
use Carbon\Carbon;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/', function () {
    return response()->json([
        'message' => 'PontuALL API - ONLINE',
        'time' => Carbon::now()->subHours(3)->timestamp,
    ]);
});

//Devolve a hora em UnixTime -- usada em testes, já pode ser excluída...
Route::get('/time', function() {return response()->json(Carbon::now()->subHours(3)->timestamp);});






//Rota para marcação do ponto com JSON
//dados JSON: {cartao: numCartao, unixTime: valorUnixTime}
Route::post('registrarPonto', 'RegistroController@registrarPontoByRequest');

//Rota criada a pedidos... exemplo: http://localhost:8000/api/registrarPonto/10000/1560208197
Route::get('registrarPonto/{cartao}/{unixTime}', 'RegistroController@registrarPontoByCartaoHora');



Route::post('login', 'ApiController@login');
//Route::post('register', 'ApiController@register'); //Rota desabilitada pq nossa aplicação usa a funcionalidade



/********************************************************
 *  ROTAS PROTEGIDAS
 ********************************************************/
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');

    //Resources
    Route::resource('users', 'UserController');
    Route::resource('areas', 'AreaController');
    Route::resource('feriados', 'FeriadoController');
    Route::resource('jornadas', 'JornadaController');
    Route::resource('tiposOcorrencia', 'TipoOcorrenciaController');
    Route::resource('tiposJustificativa', 'TipoJustificativaController');
    Route::resource('tipoUsuario', 'TipoUsuarioController');

    //Route::get('user', 'ApiController@getAuthUser');
    Route::get('user', function (Request $request) {
        return response()->json($request->user());
    });
    Route::get('me', 'ApiController@me');
    Route::get('refresh', 'ApiController@refresh');



    Route::get('frequenciaMensal', 'RegistroDiarioController@frequenciaMensal');
    //teste ocorrencia...
    //Route::get('gerarOcorrencia/{id}','OcorrenciaController@gerarOcorrenciasPorIdUsuarioHoje');
    //frequenciaByIdPeriodo
    //frequenciaByIdAnoMes




});
//----------------------- FIM ROTAS PROTEGIDAS -----------------------------------
Route::get('gerarOcorrencia/{id}','OcorrenciaController@gerarOcorrenciasPorIdUsuarioHoje');

Route::get('frequenciaMensal/{id}/{ano}/{mes}', 'RegistroDiarioController@frequenciaByIdAnoMes');




 //HACKZ
 /*Route::resource('usuarioz', 'UserController');
 Route::resource('areaz', 'AreaController');
 Route::resource('feriadoz', 'FeriadoController');
 Route::resource('jornadaz', 'JornadaController');
 Route::resource('tiposOcorrenciaz', 'TipoOcorrenciaController');
 Route::resource('tiposJustificativaz', 'TipoJustificativaController');
 Route::resource('tipoUsuarioz', 'TipoUsuarioController');
*/
 Route::apiResources([
    'userz' => 'UserController',
    'areaz' => 'AreaController',
    'feriadoz' => 'FeriadoController',
    'jornadaz' => 'JornadaController',
    'tiposOcorrenciaz' => 'TipoOcorrenciaController',
    'tiposJustificativaz' => 'TipoJustificativaController',
    'tipoUsuarioz' => 'TipoUsuarioController',
    'registroz' => 'RegistroController',
    'registroDiarioz' => 'RegistroDiarioController',
 ]);




Route::get('/teste', function () {
    //return Carbon::createFromTime(12)->toTimeString();
    //return Carbon::createMidnightDate(now())->firstOfMonth()->toDateString();
    //return Carbon::now()->createMidnightDate()->toDateTimeString();//->firstOfMonth()->toDateString();
    //dd(Carbon::createFromDate('2019-04-22'));
    return Carbon::createFromDate('2019-04-22')->toDateTimeString();
});


Route::fallback(function(){
    return response()->json([
        'message' => '404 - Pagina nao encontrada'], 404);
});
