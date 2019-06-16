<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registro;
use App\RegistroDiario;
use App\User;
use App\Http\Resources\UserResource;
use Carbon\Carbon;
use PHPUnit\Runner\Exception;
use PhpParser\Node\Stmt\TryCatch;

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
        $retorno->save();
        return response()->json($retorno);
    }

    public function destroy($id){
        $registro = Registro::find($id);
        if(!$registro){ return response()->json(['erro' => 'Registro não encontrado'], 404); }
        $registro->delete();
    }

    public function registrarPontoByRequest(Request $request){
        //$dataHora = Carbon::createFromTimestamp($request->unixTime);
        //$user = User::where('cartao','=',$request->cartao)->first();
        $cartao = $request->cartao;
        $unixTime = $request->unixTime;

        if(!$cartao)  { return response()->json(['erro' => 'Cartao nao informado!'], 400); }
        if(!$unixTime) { return response()->json(['erro' => 'Hora não informada!'], 400); }

        return $this->registrarPontoByCartaoHora($cartao, $unixTime);
    }


    public function registrarPontoByCartaoHora($cartao, $unixTime){

        //Tratamento dos inputs
        $dataHora = null;
        try{
            $dataHora = Carbon::createFromTimestamp($unixTime);
        } catch(Exception $e){
            return response()->json(['erro' => 'Data invalida!'], 403);
        }
        $data = $dataHora->toDateString();
        $hora = $dataHora->toTimeString();

        $user = User::where('cartao', $cartao)->first();
        if(!$user){ return response()->json(['erro' => 'Cartao nao cadastrado!'], 404); } //ou 403


        //Começa criação do Registro
        //1o verifica se já há registro diário para vincular o registro
        $registroDiario = RegistroDiario::where('data', $data)
            ->where('user_id', $user->id)->with('registros')->first();

        //Se é o primeiro registro do dia, criar registro diário
        if(!$registroDiario){
            $registroDiario = new RegistroDiario(); //TODO: criar consntrutor com parâmentros.. :/
            $registroDiario->data = $data;
            $registroDiario->user_id = $user->id;
            $registroDiario->save();
        }
        /* //Caso dê algum BO, retorna erro...
        if(!$registroDiario){ return response()->json(['erro' => 'Reg Diario não criado!'], 403); } */


        //Verifica se usuario já efetuou registro em menos de 5 minutos (RN-05, RF-05)
        if(!empty($registroDiario->registros)){
            $horaCarbon = Carbon::parse($hora);//->subHours(3);
            foreach($registroDiario->registros as $reg){
                $temp = Carbon::parse($reg->horario);
                $diff = $horaCarbon->diffInMinutes($temp);
                //dd($dataHora, $horaCarbon, $diff);
                if($diff <= 5) {
                    return response()->json(['erro' => 'Registro enviado, porem descartado!'], 200);
                }

            }
        }


        //Com o Registro Diário OK, criar objeto Registro e persistir;
        $registro = new Registro(); // criar construtor com parametros, blabalbla...
        $registro->horario = $hora;
        $registro->registro_diario_id = $registroDiario->id;
        $registro->save();
        if(!$registro){ return response()->json(['erro' => 'Reg não criado!'], 403); }

        //Retorna informaçõs uteis
        //TODO: verificar se há alguma outra informação útil para retornar
        return response()->json([
            'user' => new UserResource($user),
            'data' => $data,
            'hora' => $hora,
            'registro' => $registro
        ]);
    }

}
