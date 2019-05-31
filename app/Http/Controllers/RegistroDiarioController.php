<?php

namespace App\Http\Controllers;

use App\RegistroDiario;
use App\Usuario;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class RegistroDiarioController extends Controller {
    public function index() {
        $lista = RegistroDiario::with(['registros', 'ocorrencias'])->get();
        //dd($lista);
        return response()->json($lista);
    }

    public function show($id) {
        $retorno = RegistroDiario::find($id);
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
        $usuario = $request->user();

        if($request->data){ $data = CarbonImmutable::createFromDate($request->data); }
        else { $data = CarbonImmutable::now(); }

        $dataini = $data->firstOfMonth();
        $datafim = $data->lastOfMonth();

        return $this->frequenciaByIdPeriodo($usuario->id, $dataini, $datafim);

        /*
        $usuario = $request->user();

        if($request->data){
            $data = CarbonImmutable::createFromDate($request->data);
        } else {
            $data = CarbonImmutable::now();
            //$data = CarbonImmutable::createFromDate('2019-01-15');//data generica de janeiro
        }

        $dataini = $data->firstOfMonth();
        $datafim = $data->lastOfMonth();
        $lista = RegistroDiario::where('usuario_id', $usuario->id)
            ->whereDate('data', '>=', $dataini)
            ->whereDate('data', '<=', $datafim)
            ->with('registros') //TODO: alterar pra enviar uma string unica com os registros
            ->get();

        return response()->json([
            'user' =>  $usuario,
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

        $lista = RegistroDiario::where('usuario_id', $userId)
            ->whereDate('data', '>=', $dataini)
            ->whereDate('data', '<=', $datafim)
            ->with([ 'registros', 'ocorrencias' ]) //TODO: alterar pra enviar uma string unica com os registros
            ->get();

        return response()->json([
            'user' =>  Usuario::find($userId),
            'dataini' => $dataini,
            'datafim' => $datafim,
            'lista' => $lista
        ]);
    }

}
