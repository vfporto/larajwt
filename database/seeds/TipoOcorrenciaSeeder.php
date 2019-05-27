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
            'codigo' => 'FAI'
        ]);
        App\TipoOcorrencia::create([
            'nome' => 'Falta período matutino',
            'codigo' => 'FAM'
        ]);
        App\TipoOcorrencia::create([
            'nome' => 'Falta período vespertino',
            'codigo' => 'FAV'
        ]);
        App\TipoOcorrencia::create([
            'nome' => 'Atraso entrada período matutino',
            'codigo' => 'AEM'
        ]);
        App\TipoOcorrencia::create([
            'nome' => 'Atraso entrada período vespertino',
            'codigo' => 'AEV'
        ]);
        App\TipoOcorrencia::create([
            'nome' => 'Saída antecipada período matutino',
            'codigo' => 'SAM'
        ]);
        App\TipoOcorrencia::create([
            'nome' => 'Saída antecipada período vespertino',
            'codigo' => 'SAV'
        ]);
        App\TipoOcorrencia::create([
            'nome' => 'Núm ímpar marcações período matutino',
            'codigo' => 'NIM'
        ]);
        App\TipoOcorrencia::create([
            'nome' => 'Núm ímpar marcações período vespertino',
            'codigo' => 'NIV'
        ]);
    }
}
