<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\RegistroDiario;
use App\User;

class RegistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$userId = 1;
        $mes = 1;
        $ano = 2019;

        for($i=0; $i <= 31; $i++):
            $data = Carbon::createFromDate($ano, $mes, $i);

            $rd = RegistroDiario::where('data', $data->toDateString())
                    ->where('user_id', $userId)->first();

            if($rd){
                $this->createRegistro($rd->id, '08:00:00');
                $this->createRegistro($rd->id, '12:00:00');
                $this->createRegistro($rd->id, '14:00:00');
                $this->createRegistro($rd->id, '18:00:00');
            }
        endfor;*/


        $users = User::with('registrosDiarios', 'jornadas')->get();
        //$lista = RegistroDiario::all();
        foreach ($users as $user) {
            //dd($user);
            foreach ($user->registrosDiarios as $rd) {
                //dd($rd);
                foreach ($user->jornadas as $jornada) {
                    //dd($user->jornadas);
                    $num = rand(0, 15); //chance de 1 em 15 de não marcar...
                    if($num > 0) {
                        $hora = Carbon::create($jornada->entrada)
                            ->subMinutes(rand(0, 20))
                            ->addMinutes(rand(0, 30))
                            ->toTimeString();
                            //dd($hora);
                        $this->createRegistro($rd->id, $hora);
                    }

                    $num = rand(0, 15); //chance de 1 em 15 de não marcar...
                    if($num > 0) {
                        $hora = Carbon::create($jornada->saida)
                            ->subMinutes(rand(0, 20))
                            ->addMinutes(rand(0, 30))
                            ->toTimeString();
                        $this->createRegistro($rd->id, $hora);
                    }
                }
                //dd(RegistroDiario::with('registros')->find($rd->id));
            }

        }


    }

    private function createRegistro($rd_id, $hora){
        App\Registro::create([
            'registro_diario_id' => $rd_id,
            'horario' =>$hora
        ]);
    }
}
