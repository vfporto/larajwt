<?php

namespace App\Http\Controllers;

use App\Ocorrencia;
use App\Feriado;
use App\RegistroDiario;
use App\Registro;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\TipoOcorrencia;
use App\Justificativa;

class OcorrenciaController extends Controller
{
    public function index() {
        $lista = Ocorrencia::with('tipoOcorrencia', 'justificativa', 'justificativa.tipoJustificativa')->get();
        //return response()->json($lista);
        return $lista->toJson(JSON_PRETTY_PRINT);
    }

    public function show($id) {
        $retorno = Ocorrencia::find($id)->with('tipoOcorrencia', 'justificativa', 'justificativa.tipoJustificativa')->first();
        if (!$retorno) { return response()->json(['erro' => 'Registro não encontrado'], 404); }
        //return response()->json($retorno);
        //dd($retorno);
        return $retorno->toJson(JSON_PRETTY_PRINT);
    }

    public function store(Request $request) {
        $ocorrencia = new Ocorrencia();
        $ocorrencia->fill($request->all());
        $ocorrencia->save();
        return response()->json($ocorrencia);
    }

    public function update(Request $request, $id) {
        $retorno = Ocorrencia::find($id);
        if (!$retorno) {  return response()->json(['erro' => 'Registro não encontrado'], 404); }
        $retorno->fill($request->all());
        return response()->json($retorno);
    }

    public function destroy($id) {
        $ocorrencia = Ocorrencia::find($id);
        if (!$ocorrencia) {
            return response()->json(['erro' => 'Registro não encontrado'], 404);
        }
        $ocorrencia->delete();
        return response()->json(['msg' => 'Excluido com sucesso!'], 200);
    }



/******************************************************************************
 *              G E R A Ç Ã O    D E   O C O R R Ê N C I A S
 ******************************************************************************/
    public function gerarOcorrenciasGeral(){
        //limpar todas as ocorrencias existentes
        Ocorrencia::whereNotNull('id')->delete();

        //Cria ocorrencias para o mes corrente...
        $usuarios = User::all();
        $dtIni = Carbon::now()->startOfMonth();
        $dtFim = Carbon::now()->subDay();
        $periodo = CarbonPeriod::create($dtIni, $dtFim);

        foreach($usuarios as $user){
            foreach ($periodo as $key => $data) {
            $this->gerarOcorrenciasPorDataPorUsuario($user->id, $data->toDateString());
            }
        }
        $ocorrencias = Ocorrencia::all();
        //return $ocorrencias->toJson(JSON_PRETTY_PRINT);
        return response()->json(['message' => 'Ocorrencias Geradas'],200);


    }



    public function gerarOcorrenciasPorIdUsuarioHoje($userId){
        $dt = Carbon::now()->toDateString();
        $this->gerarOcorrenciasPorDataPorUsuario($userId, $dt);
    }

    public function gerarOcorrenciasPorDataPorUsuario($userId, $data) {
        $dt = Carbon::createFromDate($data);

        if($dt->isWeekday()){                               //Se for dia de semana
            if(!Feriado::where('data',$data)->first()){     //E não for feriado

                //Recupera o registro diario do empregado
                //$registroDiario = new RegistroDiarioController()->getByUserIdByDate($userId, $date); //nao funcionou... verificar pq
                $registroDiario = RegistroDiario::where('data', $data)
                    ->where('user_id', $userId)
                    ->with(['registros','ocorrencias'])
                    ->first();

                //Se não houver registro diario, criar um...
                if(!$registroDiario){
                    $registroDiario = new RegistroDiario(); //criar construtor com parametros... assim é um *** fazer...
                    $registroDiario->data = $data;
                    $registroDiario->user_id = $userId;
                    $registroDiario->save();
                }
                //dd($registroDiario);
                //Gerar ocorrencias para este registro diario
                return $this->gerarOcorrenciasByRegistroDiario($registroDiario);
            }
        }
    }

    public function gerarOcorrenciasByRegistroDiario($registroDiario){

        $ocorrencia = null;
        //dd($registroDiario->registros);
        if(!$registroDiario->registros || count($registroDiario->registros)==0) {// empty($registroDiario->registros)) {
            //dd($registroDiario);
            // Falta Integral

            $ocorrencia = new Ocorrencia();
            $ocorrencia->tipo_ocorrencia_id = TipoOcorrencia::where('codigo', 'FPI')->first()->id;
            $ocorrencia->registro_diario_id = $registroDiario->id;
            $ocorrencia->save();
        } else {
            //teste com menos de 4 marcações
            if (count($registroDiario->registros)<4){
            $ocorrencia = new Ocorrencia(); //olha a oportunidade pra fazer um contrutor com parametros
            $ocorrencia->tipo_ocorrencia_id = TipoOcorrencia::where('codigo', 'NMI')->first()->id;
            $ocorrencia->registro_diario_id = $registroDiario->id;
            $ocorrencia->save();
            }


        }
        //dd($registroDiario, $ocorrencia);





    }


    public function gerarOcorrenciasByRegistroDiarioId($registroDiarioId){
        //por enquanto não é necessário
    }


    public function verificaFaltaIntegral($registroDiarioId) {
        //estou fazendo tudo no método gerarOcorrencia
    }





    /*  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *
     *                              J U S T I F I C A T I V A S
     *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  */

     //TODO: Decidir se esses metodos ficam aqui ou em JustificativaController...
/*
    public function justificarOcorrencia(Request $request){

        $just = new Justificativa();
        $just->

    }
*/


}
