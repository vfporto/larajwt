<?php

namespace App\Http\Controllers;

use App\Justificativa;
use Illuminate\Http\Request;
use App\Ocorrencia;

class JustificativaController extends Controller
{
    public function index(){
        $lista = Justificativa::all();

        return response()->json($lista);
    }

    public function show($id){
        $retorno = Justificativa::find($id);

        if(!$retorno) {return response()->json(['erro' => 'Registro não encontrado'], 404);}
        return response()->json($retorno);
    }

    public function store(Request $request){
        $ocorrencia = Ocorrencia::with('justificativa', 'registroDiario', 'registroDiario.registros')->find($request->ocorrencia_id);
        dd($ocorrencia);
        if($ocorrencia && !empty($ocorrencia->justificativa)){
            $just = new Justificativa();
            //$just->fill($request->all());
            $just->observacao = $request->observacao;
            $just->tipo_justificativa_id = $request->tipo_justificativa_id;
            $just->ocorrencia_id = $ocorrencia->ocorrencia_id;
            $just->save();
            dd($just);
            return $just->toJson(JSON_PRETTY_PRINT);
        }
        return response()->json(['erro' => 'Ocorrencia não encontrada'], 404);
        //$just->save();

        //return response()->json($just);
    }

    public function update(Request $request, $id){
        $retorno = Justificativa::find($id);

        if(!$retorno) { return response()->json(['erro' => 'Registro não encontrado'], 404); }

        $retorno->fill($request->all());
        $retorno->save();
        return response()->json($retorno);
    }

    public function destroy($id){
        $justificativa = Justificativa::find($id);
        if(!$justificativa){ return response()->json(['erro' => 'Registro não encontrado'], 404); }
        $justificativa->delete();
    }




}
