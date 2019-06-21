<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use App\User;
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
        //$inicio = CarbonImmutable::now()->firstOfYear(); //inicio: começo deste ano
        $inicio = CarbonImmutable::now()->firstOfMonth(); //inicio: começo deste mês
        $fim = CarbonImmutable::now()->subDays(1);   // fim: ontem...
        $periodo = CarbonPeriod::create($inicio, $fim);

        //$userId = 1;
        $users = User::all();
        foreach ($users as $user) {
            foreach ($periodo as $key => $data) {
                $num = rand(0, 100);
                if ($num > 15) { // aprox. 15% de chances
                    if ($data->isWeekday()) {
                        if (!Feriado::where('data', $data)->first()) {
                            App\RegistroDiario::create([
                                'user_id' => $user->id,
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
                'user_id' => $userId,
                'data' => $data->toDateString(),
            ]);
        }

    }*/
}
