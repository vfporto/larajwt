<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use App\Usuario;
use App\Feriado;

class RegistroDiarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inicio = CarbonImmutable::now()->firstOfYear(); //inicio: começo deste ano
        $fim = CarbonImmutable::createMidnightDate();   // fim: hoje...
        $periodo = CarbonPeriod::create($inicio, $fim);

        //$userId = 1;
        $usuarios = Usuario::all();
        foreach ($usuarios as $usuario) {
            foreach ($periodo as $key => $data) {
                $num = rand(0, 14); // aprox. 7% de chances
                if ($num > 0) {
                    if ($data->isWeekday()) {
                        if (!Feriado::where('data', $data)->first()) {
                            App\RegistroDiario::create([
                                'usuario_id' => $usuario->id,
                                'data' => $data->toDateString(),
                            ]);
                        }
                    }
                }
            }
        }


        /* $userId = 1;
        for($dia=0; $dia <= 31; $dia++):
            $this->createRegistroDiario($userId, $dia);
        endfor;*/
    }
    /*
    private function createRegistroDiario($userId, $data){
        $data = Carbon::createFromDate(2019,1,$data);

        if($data->isWeekday()){
            App\RegistroDiario::create([
                'usuario_id' => $userId,
                'data' => $data->toDateString(),
            ]);
        }

    }*/
}
