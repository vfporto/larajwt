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
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;

class OcorrenciaController extends Controller
{
    public function index()
    {
        $lista = Ocorrencia::with('tipoOcorrencia', 'justificativa', 'justificativa.tipoJustificativa')->get();
        //return response()->json($lista);
        return $lista->toJson(JSON_PRETTY_PRINT);
    }

    public function show($id)
    {
        $retorno = Ocorrencia::find($id)->with('tipoOcorrencia', 'justificativa', 'justificativa.tipoJustificativa')->first();
        if (!$retorno) {
            return response()->json(['erro' => 'Registro não encontrado'], 404);
        }
        //return response()->json($retorno);
        //dd($retorno);
        return $retorno->toJson(JSON_PRETTY_PRINT);
    }

    public function store(Request $request)
    {
        $ocorrencia = new Ocorrencia();
        $ocorrencia->fill($request->all());
        $ocorrencia->save();
        return response()->json($ocorrencia);
    }

    public function update(Request $request, $id)
    {
        $retorno = Ocorrencia::find($id);
        if (!$retorno) {
            return response()->json(['erro' => 'Registro não encontrado'], 404);
        }
        $retorno->fill($request->all());
        return response()->json($retorno);
    }

    public function destroy($id)
    {
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
    public function gerarOcorrenciasGeral()
    {
        //limpar todas as ocorrencias existentes
        Ocorrencia::whereNotNull('id')->delete();

        //Cria ocorrencias para o mes corrente...
        $usuarios = User::all();
        $dtIni = Carbon::now()->startOfMonth();
        $dtFim = Carbon::now()->subDay();
        $periodo = CarbonPeriod::create($dtIni, $dtFim);

        foreach ($usuarios as $user) {
            foreach ($periodo as $key => $data) {
                $this->gerarOcorrenciasPorDataPorUsuario($user, $data->toDateString());
            }
        }
        $ocorrencias = Ocorrencia::all();
        //return $ocorrencias->toJson(JSON_PRETTY_PRINT);
        return response()->json(['message' => 'Ocorrencias Geradas'], 200);
    }



    /*public function gerarOcorrenciasPorIdUsuarioHoje($userId){
        $dt = Carbon::now()->toDateString();
        $this->gerarOcorrenciasPorDataPorUsuario($userId, $dt);
    }*/

    public function gerarOcorrenciasPorDataPorUsuario($user, $data)
    {
        $dt = Carbon::createFromDate($data);

        if ($dt->isWeekday()) {                               //Se for dia de semana
            if (!Feriado::where('data', $data)->first()) {     //E não for feriado

                //Recupera o registro diario do empregado
                $registroDiario = RegistroDiario::where('data', $data)
                    ->where('user_id', $user->id)
                    ->with(['registros', 'ocorrencias'])
                    ->first();

                //Se não houver registro diario, criar um...
                if (!$registroDiario) {
                    $registroDiario = new RegistroDiario(); //criar construtor com parametros... assim é um *** fazer...
                    $registroDiario->data = $data;
                    $registroDiario->user_id = $user->id;
                    $registroDiario->save();
                }
                //dd($registroDiario);
                //Verificar regras de Negócio para Ocorrências e gerá-las
                 //dd($registroDiario->registros);
                $ocorrencia = null;

                if (!$registroDiario->registros || count($registroDiario->registros) <= 1) { // empty($registroDiario->registros)) {
                    $this->gerarOcorrencia($registroDiario, 'FPI'); //Falta Periodo Integral
                } else {
                    if (count($registroDiario->registros) > 4)  {
                        $this->gerarOcorrencia($registroDiario, 'NMI'); //num marcaçoes inconsistentes
                    } else  if (count($registroDiario->registros) < 4)  {
                        $this->gerarOcorrencia($registroDiario, 'FMP'); //falta meio periodo
                    } else { //em tese, 4 marcações...contar as horas, como teste..
                        $regs = $registroDiario->registros;
                        $tempo = Carbon::parse($regs[0]->horario)->floatDiffInRealHours($regs[1]->horario);
                        $tempo += Carbon::parse($regs[2]->horario)->floatDiffInRealHours($regs[3]->horario);

                        //dd($registroDiario, $regs, $tempo);
                        if ($tempo < 7.75)  $this->gerarOcorrencia($registroDiario, 'I8H'); // tempo inferior a 8h diarias
                    }

                    /* //não deu certo... impossivel reconhecer marcações "exóticas", como alguém almoçar das 11:00 ao 12:00 e outras marcações exóticas
                    $regs = $registroDiario->registros;
                    $j = $user->jornadas;
                    $vetor = array($j[0]->id => array(), $j[1]->id => array(), 'fora' => array());
                    $ini0 = Carbon::parse($j[0]->entrada)->subMinutes(15);
                    $fim0 = Carbon::parse($j[0]->saida)->addMinutes(15);
                    $ini1 = Carbon::parse($j[1]->entrada)->subMinutes(15);
                    $fim1 = Carbon::parse($j[1]->saida)->addMinutes(15);
                    foreach ($regs as $r) {
                        $h = Carbon::parse($r->horario);
                        if ($h->between($ini0, $fim0)) {
                            array_push($vetor[$j[0]->id], $h);
                        } else  if ($h->between($ini1, $fim1)) {
                            array_push($vetor[$j[1]->id], $h);
                        } else {
                            array_push($vetor['fora'], $h);
                        }
                    }
                    dd($vetor, $regs, $j);
                    //teste com menos de 4 marcações
                    //if (count($registroDiario->registros)<4){
                    //    $this->gerarOcorrencia($registroDiario, 'NMI');
                    //}
                    */
                }
            }
        }
    }


    public function gerarOcorrencia($regDiario, $codOcorrencia)
    {
        $ocorrencia = new Ocorrencia();
        $ocorrencia->tipo_ocorrencia_id = TipoOcorrencia::where('codigo', $codOcorrencia)->first()->id;
        $ocorrencia->registro_diario_id = $regDiario->id;
        $ocorrencia->save();
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
