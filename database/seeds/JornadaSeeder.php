<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JornadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Jornada::create([
            'nome' => 'Turno manhã',
            'entrada' => Carbon::createFromTime(8)->toTimeString(),
            'saida' => Carbon::createFromTime(12)->toTimeString()
        ]);

       App\Jornada::create([
            'nome' => 'Turno tarde',
            'entrada' => Carbon::createFromTime(14)->toTimeString(),
            'saida' => Carbon::createFromTime(18)->toTimeString()
        ]);
    }
}
