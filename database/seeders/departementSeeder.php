<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class departementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departements = array(
            array('id' => '1','name' => 'Département techniques','created_at' => '2022-05-13 00:36:02','updated_at' => '2022-05-13 00:36:02'),
            array('id' => '2','name' => 'Département Commerciale','created_at' => '2022-05-13 00:36:02','updated_at' => '2022-05-13 00:36:02')
        );
        DB::table('departements')->insert($departements);
    }
}
