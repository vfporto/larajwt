<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FeriadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Alguns feriados...
        $this->criarFeriado('2019-12-25', 'Natal');
        $this->criarFeriado('2019-05-01', 'Dia do Trabalhador');
        $this->criarFeriado('2019-01-01', 'Ano Novo');
        $this->criarFeriado('2019-09-07', 'Independência do Brasil');

    }

    private function criarFeriado($data, $nome){
        $dt = Carbon::createFromDate($data);
        //if($dt->isWeekday()){
            App\Feriado::create([
                'data' => $dt->toDateString(),
                'nome' => $nome
            ]);
        //}
    }
}
