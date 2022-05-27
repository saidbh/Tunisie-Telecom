<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class objectifsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objectif_types = array(
            array('id' => '1','name' => 'Reseau direct','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '2','name' => 'Reseau indirect','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '3','name' => 'NI+RA','description' => NULL,'created_at' => '2022-05-13 00:41:24','updated_at' => '2022-05-13 00:41:24'),
            array('id' => '4','name' => 'Migration','description' => NULL,'created_at' => '2022-05-13 00:41:24','updated_at' => '2022-05-13 00:41:24')
        );
        DB::table('objectif_types')->insert($objectif_types);
    }
}
