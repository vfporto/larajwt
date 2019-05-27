<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\RegistroDiario;

class RegistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = 1;
        $mes = 1;
        $ano = 2019;

        for($i=0; $i <= 31; $i++):
            $data = Carbon::createFromDate($ano, $mes, $i);

            $rd = RegistroDiario::where('dia', $data->toDateString())
                    ->where('usuario_id', $userId)->first();

            if($rd){
                $this->createRegistro($rd->id, '08:00:00');
                $this->createRegistro($rd->id, '12:00:00');
                $this->createRegistro($rd->id, '14:00:00');
                $this->createRegistro($rd->id, '18:00:00');
            }
        endfor;
    }

    private function createRegistro($rd_id, $hora){
        App\Registro::create([
            'registro_diario_id' => $rd_id,
            'horario' =>$hora
        ]);
    }
}
