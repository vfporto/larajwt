<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RegistroDiarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = 1;
        for($i=0; $i <= 31; $i++):
            $this->createRegistroDiario($userId, $i);
        endfor;
    }

    private function createRegistroDiario($userId, $dia){
        $data = Carbon::createFromDate(2019,1,$dia);

        if($data->isWeekday()){
            App\RegistroDiario::create([
                'usuario_id' => $userId,
                'dia' => $data->toDateString(),
            ]);
        }

    }
}
