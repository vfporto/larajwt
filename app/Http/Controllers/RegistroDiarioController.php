<?php

namespace App\Http\Controllers;

use App\RegistroDiario;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use App\Http\Resources\UserResource;

class RegistroDiarioController extends Controller {
    public function index() {
        $lista = RegistroDiario::with(['user','registros', 'ocorrencias'])->get();
        //dd($lista);
        return response()->json($lista);
    }

    public function show($id) {
        $retorno = RegistroDiario::find($id)->with(['registros', 'ocorrencias'])->first();
        //dd($retorno);
        if (!$retorno) { return response()->json(['erro' => 'Registro não encontrado'], 404); }
        return response()->json($retorno);
    }

    public function store(Request $request) {
        $registroDiario = new RegistroDiario();
        $registroDiario->fill($request->all());
        $registroDiario->save();
        return response()->json($registroDiario);
    }

    public function update(Request $request, $id) {
        $retorno = RegistroDiario::find($id);
        if (!$retorno) {  return response()->json(['erro' => 'Registro não encontrado'], 404); }
        $retorno->fill($request->all());
        return response()->json($retorno);
    }

    public function destroy($id) {
        $registroDiario = RegistroDiario::find($id);
        if (!$registroDiario) {
            return response()->json(['erro' => 'Registro não encontrado'], 404);
        }
        $registroDiario->delete();
        return response()->json(['msg' => 'Excluido com sucesso!'], 200);
    }

    //-----------------------------------------------------------------------------------




    public function frequenciaMensal(Request $request){
        $user = $request->user();

        if($request->data){ $data = CarbonImmutable::createFromDate($request->data); }
        else { $data = CarbonImmutable::now(); }

        $dataini = $data->firstOfMonth();
        $datafim = $data->lastOfMonth();

        return $this->frequenciaByIdPeriodo($user->id, $dataini, $datafim);

        /*
        $user = $request->user();

        if($request->data){
            $data = CarbonImmutable::createFromDate($request->data);
        } else {
            $data = CarbonImmutable::now();
            //$data = CarbonImmutable::createFromDate('2019-01-15');//data generica de janeiro
        }

        $dataini = $data->firstOfMonth();
        $datafim = $data->lastOfMonth();
        $lista = RegistroDiario::where('user_id', $user->id)
            ->whereDate('data', '>=', $dataini)
            ->whereDate('data', '<=', $datafim)
            ->with('registros') //TODO: alterar pra enviar uma string unica com os registros
            ->get();

        return response()->json([
            'user' =>  $user,
            'dataini' => $dataini,
            'datafim' => $datafim,
            'lista' => $lista
        ]);
*/
    }

    public function frequenciaByIdAnoMes($userId, $ano, $mes){
        $dataini = CarbonImmutable::createFromDate($ano, $mes);
        $datafim = $dataini->lastOfMonth();
        return $this->frequenciaByIdPeriodo($userId, $dataini, $datafim);
    }

    public function frequenciaByIdPeriodo($userId, $dataini, $datafim){

        $lista = RegistroDiario::where('user_id', $userId)
            ->whereDate('data', '>=', $dataini)
            ->whereDate('data', '<=', $datafim)
            ->with([ 'registros', 'ocorrencias', 'ocorrencias.tipoOcorrencia' ]) //TODO: alterar pra enviar uma string unica com os registros
            ->get();

        return response()->json([
            'user' =>  new UserResource(User::find($userId)),
            'dataini' => $dataini->toDateString(),
            'datafim' => $datafim->toDateString(),
            'lista' => $lista
        ]);
    }

}
