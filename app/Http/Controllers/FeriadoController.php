<?php

namespace App\Http\Controllers;

use App\Feriado;
use Illuminate\Http\Request;

class FeriadoController extends Controller
{
    public function index(){
        $lista = Feriado::all();

        return response()->json($lista);
    }

    public function show($id){
        $retorno = Feriado::find($id);

        if(!$retorno) {return response()->json(['erro' => 'Registro não encontrado'], 404);}
        return response()->json($retorno);
    }

    public function store(Request $request){
        $feriado = new Feriado();
        $feriado->fill($request->all());
        $feriado->save();

        return response()->json($feriado);
    }

    public function update(Request $request, $id){
        $retorno = Feriado::find($id);

        if(!$retorno) { return response()->json(['erro' => 'Registro não encontrado'], 404); }

        $retorno->fill($request->all());
        return response()->json($retorno);
    }

    public function destroy($id){
        $feriado = Feriado::find($id);
        if(!tipo){ return response()->json(['erro' => 'Registro não encontrado'], 404); }
        $feriado->delete();
    }
}
