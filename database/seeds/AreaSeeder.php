<?php

use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Area::create([
            'nome' => 'Area 51',
            //'gerente_id' => 1
       ]);
    }
}
