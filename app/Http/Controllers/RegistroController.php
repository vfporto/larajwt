<?php

namespace App\Http\Controllers;

use App\Registro;
use Illuminate\Http\Request;
use App\Usuario;

class RegistroController extends Controller
{
    public function index(){
        $lista = Registro::all();

        return response()->json($lista);
    }

    public function show($id){
        $retorno = Registro::find($id);

        if(!$retorno) {return response()->json(['erro' => 'Registro não encontrado'], 404);}
        return response()->json($retorno);
    }

    public function store(Request $request){
        $registro = new Registro();
        $registro->fill($request->all());
        $registro->save();

        return response()->json($registro);
    }

    public function update(Request $request, $id){
        $retorno = Feriado::find($id);

        if(!$retorno) { return response()->json(['erro' => 'Registro não encontrado'], 404); }

        $retorno->fill($request->all());
        return response()->json($retorno);
    }

    public function destroy($id){
        $registro = Registro::find($id);
        if(!tipo){ return response()->json(['erro' => 'Registro não encontrado'], 404); }
        $registro->delete();
    }

    public function registrarPonto(Request $request){

        $cartao = $request->cartao;
        $dataHora = $request->dataHora;

        $usuario = Usuario::where('cartao','=',$cartao);

    }
}
