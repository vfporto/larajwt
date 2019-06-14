<?php

namespace App\Http\Controllers;

use App\TipoJustificativa;
use Illuminate\Http\Request;

class TipoJustificativaController extends Controller
{
    public function index(){
        $lista = TipoJustificativa::all();

        return response()->json($lista);
    }

    public function show($id){
        $retorno = TipoJustificativa::find($id);

        if(!$retorno) {return response()->json(['erro' => 'Registro não encontrado'], 404);}
        return response()->json($retorno);
    }

    public function store(Request $request){
        $tipoJustificativa = new TipoJustificativa();
        $tipoJustificativa->fill($request->all());
        $tipoJustificativa->save();

        return response()->json($tipoJustificativa);
    }

    public function update(Request $request, $id){
        $retorno = TipoJustificativa::find($id);

        if(!$retorno) { return response()->json(['erro' => 'Registro não encontrado'], 404); }

        $retorno->fill($request->all());
        $retorno->save();
        return response()->json($retorno);
    }

    public function destroy($id){
        $tipoJustificativa = TipoJustificativa::find($id);
        if(!$tipoJustificativa){ return response()->json(['erro' => 'Registro não encontrado'], 404); }
        $tipoJustificativa->delete();
    }
}
