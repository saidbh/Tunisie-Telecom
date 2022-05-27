<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OffreCommercialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offre_commercial = array(
            array('id' => '1','name' => 'Mobile à Facture','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '2','name' => 'Mobile Prp Brut','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '3','name' => 'Clés 3G','description' => NULL,'created_at' => '2022-05-13 00:41:24','updated_at' => '2022-05-13 00:41:24'),
            array('id' => '4','name' => 'Netbox','description' => NULL,'created_at' => '2022-05-13 00:41:24','updated_at' => '2022-05-13 00:41:24'),
            array('id' => '5','name' => 'M2M','description' => NULL,'created_at' => '2022-05-13 00:41:24','updated_at' => '2022-05-13 00:41:24'),
            array('id' => '6','name' => 'Waffi VDSL','description' => NULL,'created_at' => '2022-05-13 00:41:24','updated_at' => '2022-05-13 00:41:24'),
            array('id' => '7','name' => 'Rapido 2020','description' => NULL,'created_at' => '2022-05-13 00:41:24','updated_at' => '2022-05-13 00:41:24'),
            array('id' => '8','name' => 'Autres THD','description' => NULL,'created_at' => '2022-05-13 00:41:24','updated_at' => '2022-05-13 00:41:24'),
            array('id' => '9','name' => 'Portabilité IN Prp','description' => NULL,'created_at' => '2022-05-13 00:41:24','updated_at' => '2022-05-13 00:41:24'),
            array('id' => '10','name' => 'Portabilité IN MAF','description' => NULL,'created_at' => '2022-05-13 00:41:24','updated_at' => '2022-05-13 00:41:24'),
        );
        DB::table('offre_commercial')->insert($offre_commercial);
    }
}
