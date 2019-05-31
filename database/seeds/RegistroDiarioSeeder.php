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

    private function createRegistroDiario($userId, $data){
        $data = Carbon::createFromDate(2019,1,$data);

        if($data->isWeekday()){
            App\RegistroDiario::create([
                'usuario_id' => $userId,
                'data' => $data->toDateString(),
            ]);
        }

    }
}
