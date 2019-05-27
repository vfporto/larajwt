<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registro;
use App\RegistroDiario;
use App\Usuario;
use Carbon\Carbon;

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
        $retorno = Registro::find($id);

        if(!$retorno) { return response()->json(['erro' => 'Registro não encontrado'], 404); }

        $retorno->fill($request->all());
        return response()->json($retorno);
    }

    public function destroy($id){
        $registro = Registro::find($id);
        if(!$registro){ return response()->json(['erro' => 'Registro não encontrado'], 404); }
        $registro->delete();
    }

    //public function registrarPonto($cartao, $unixTime){
    public function registrarPonto(Request $request){

        //$dataHora = Carbon::createFromTimestamp($unixTime);
        //$usuario = Usuario::where('cartao','=',$cartao);

        $dataHora = Carbon::createFromTimestamp($request->unixTime);
        $data = $dataHora->toDateString();
        $hora = $dataHora->toTimeString();

        $usuario = Usuario::where('cartao','=',$request->cartao)->first();
        if(!$usuario){ return response()->json(['erro' => 'Não autorizado!'], 404); } //ou 403


        $registroDiario = RegistroDiario::where('dia', $data)
            ->where('usuario_id', $usuario->id)->first();
            //dd($registroDiario);

        if(!$registroDiario){
            $registroDiario = new RegistroDiario();
            $registroDiario->dia = $data;
            $registroDiario->usuario_id = $usuario->id;
            $registroDiario->save();
        }
        if(!$registroDiario){ return response()->json(['erro' => 'Reg Diario não criado!'], 403); } //ou 403

        $registro = new Registro();
        $registro->horario = $hora;
        $registro->registro_diario_id = $registroDiario->id;
        $registro->save();
        if(!$registro){ return response()->json(['erro' => 'Reg não criado!'], 403); }

        //Teste Retorno...
        return response()->json([
            'usuario' => $usuario,
            'data' => $data,
            'hora' => $hora,
            'registro' => $registro
        ]);
    }

}
