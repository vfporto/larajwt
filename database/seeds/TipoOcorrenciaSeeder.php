<?php

use Illuminate\Database\Seeder;

class TipoOcorrenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\TipoOcorrencia::create([
            'nome' => 'Falta período integral',
            'codigo' => 'FPI'
        ]);
        App\TipoOcorrencia::create([
            'nome' => 'Falta meio período',
            'codigo' => 'FMP'
        ]);
        App\TipoOcorrencia::create([
            'nome' => 'Dia trabalho inferior a 8h',
            'codigo' => 'I8H'
        ]);
        App\TipoOcorrencia::create([
            'nome' => 'Marcações inconsistentes',
            'codigo' => 'NMI'
        ]);
    }
}
