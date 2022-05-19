<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class technicOffresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offre_type = array(
            array('id' => '1','name' => 'ADSL','description' => NULL,'created_at' => '2022-05-13 00:56:54','updated_at' => '2022-05-13 00:56:54'),
            array('id' => '2','name' => 'Fixes','description' => NULL,'created_at' => '2022-05-13 00:56:54','updated_at' => '2022-05-13 00:56:54'),
            array('id' => '3','name' => 'FO internet','description' => NULL,'created_at' => '2022-05-13 00:58:50','updated_at' => '2022-05-13 00:58:50'),
            array('id' => '4','name' => 'Taux de penetration','description' => NULL,'created_at' => '2022-05-13 00:58:50','updated_at' => '2022-05-13 00:58:50')
        );
        DB::table('offre_type')->insert($offre_type);
    }
}
