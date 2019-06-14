<?php

namespace App\Http\Controllers;

use App\TipoOcorrencia;
use Illuminate\Http\Request;

class TipoOcorrenciaController extends Controller
{
    public function index(){
        $lista = TipoOcorrencia::all();

        return response()->json($lista);
    }

    public function show($id){
        $retorno = TipoOcorrencia::find($id);

        if(!$retorno) {return response()->json(['erro' => 'Registro não encontrado'], 404);}
        return response()->json($retorno);
    }

    public function store(Request $request){
        $tipoOcorrencia = new TipoOcorrencia();
        $tipoOcorrencia->fill($request->all());
        $tipoOcorrencia->save();

        return response()->json($tipoOcorrencia);
    }

    public function update(Request $request, $id){
        $retorno = Feriado::find($id);

        if(!$retorno) { return response()->json(['erro' => 'Registro não encontrado'], 404); }

        $retorno->fill($request->all());
        $retorno->save();
        return response()->json($retorno);
    }

    public function destroy($id){
        $tipoOcorrencia = TipoOcorrencia::find($id);
        if(!$tipoOcorrencia){ return response()->json(['erro' => 'Registro não encontrado'], 404); }
        $tipoOcorrencia->delete();
    }
}
