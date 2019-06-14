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
            'nome' => 'AREA-51',
            //'gerente_id' => 1
       ]);

       App\Area::create([
        'nome' => 'IFPR-BANCA',
        //'gerente_id' => 2
   ]);
    }
}
