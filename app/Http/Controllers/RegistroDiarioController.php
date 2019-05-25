<?php

namespace App\Http\Controllers;

use App\RegistroDiario;
use Illuminate\Http\Request;

class RegistroDiarioController extends Controller
{
    public function index(){
        $lista = RegistroDiario::all();

        return response()->json($lista);
    }

    public function show($id){
        $retorno = RegistroDiario::find($id);

        if(!$retorno) {return response()->json(['erro' => 'Registro não encontrado'], 404);}
        return response()->json($retorno);
    }

    public function store(Request $request){
        $registroDiario = new RegistroDiario();
        $registroDiario->fill($request->all());
        $registroDiario->save();

        return response()->json($registroDiario);
    }

    public function update(Request $request, $id){
        $retorno = RegistroDiario::find($id);

        if(!$retorno) { return response()->json(['erro' => 'Registro não encontrado'], 404); }

        $retorno->fill($request->all());
        return response()->json($retorno);
    }

    public function destroy($id){
        $registroDiario = RegistroDiario::find($id);
        if(!tipo){ return response()->json(['erro' => 'Registro não encontrado'], 404); }
        $registroDiario->delete();
    }

    public function registrarPonto(Request $request){

        $cartao = $request->cartao;
        $dataHora = $request->dataHora;

        $usuario = Usuario::where('cartao','=',$cartao);

    }
}
