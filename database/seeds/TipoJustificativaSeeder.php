<?php

use Illuminate\Database\Seeder;

class TipoJustificativaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\TipoJustificativa::create([
            'nome' => 'Atestado Médico',
            'codigo' => 'ATM'
        ]);
        App\TipoJustificativa::create([
            'nome' => 'Compensação Serviço Eleitoral',
            'codigo' => 'CSE'
        ]);
        App\TipoJustificativa::create([
            'nome' => 'Compensação Doação de Sangue',
            'codigo' => 'CDS'
        ]);
        App\TipoJustificativa::create([
            'nome' => 'Serviço Externo',
            'codigo' => 'SVE'
        ]);
        App\TipoJustificativa::create([
            'nome' => 'Outra justificativa',
            'codigo' => 'OJU'
        ]);
        App\TipoJustificativa::create([
            'nome' => 'Abono Gerencial',
            'codigo' => 'AGE'
        ]);
    }
}
