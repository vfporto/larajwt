<?php

namespace App\Http\Controllers;

use App\Jornada;
use Illuminate\Http\Request;

class JornadaController extends Controller
{
    public function index(){
        $lista = Jornada::all();

        return response()->json($lista);
    }

    public function show($id){
        $retorno = Jornada::find($id);

        if(!$retorno) {return response()->json(['erro' => 'Registro não encontrado'], 404);}
        return response()->json($retorno);
    }

    public function store(Request $request){
        $jornada = new Jornada();
        $jornada->fill($request->all());
        $jornada->save();

        return response()->json($jornada);
    }

    public function update(Request $request, $id){
        $retorno = Feriado::find($id);

        if(!$retorno) { return response()->json(['erro' => 'Registro não encontrado'], 404); }

        $retorno->fill($request->all());
        return response()->json($retorno);
    }

    public function destroy($id){
        $jornada = Jornada::find($id);
        if(!$jornada){ return response()->json(['erro' => 'Registro não encontrado'], 404); }
        $jornada->delete();
    }
}
