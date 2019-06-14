<?php

namespace App\Http\Controllers;

use App\Feriado;
use Illuminate\Http\Request;
use App\Http\Resources\FeriadoResource;

class FeriadoController extends Controller
{
    public function index(){
        $lista = Feriado::all();

        return response()->json($lista);
    }

    public function show($id){
        $feriado = Feriado::find($id);

        if(!$feriado) {return response()->json(['erro' => 'Registro não encontrado'], 404);}
        //return response()->json($feriado);
        return new FeriadoResource($feriado);
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
        $retorno->save();
        return response()->json($retorno);
    }

    public function destroy($id){
        $feriado = Feriado::find($id);
        if(!$feriado){ return response()->json(['erro' => 'Registro não encontrado'], 404); }
        $feriado->delete();
        return response()->json(['message' => 'Registro excluido'], 200);
    }
}
