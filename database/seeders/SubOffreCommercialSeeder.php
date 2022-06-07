<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubOffreCommercialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suboffre_commercial = array(
            array('id' => '1','offre_commercial_id' => '1','name' => 'Privilege','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '2','offre_commercial_id' => '1','name' => 'Corporate Optimum Plus','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '3','offre_commercial_id' => '1','name' => 'Forfait SELECT','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '4','offre_commercial_id' => '1','name' => 'OhMega','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '5','offre_commercial_id' => '1','name' => 'Dim@Connect Hyb','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '6','offre_commercial_id' => '1','name' => 'OPTICA','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '7','offre_commercial_id' => '1','name' => 'Sigounda postpaye','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),

            array('id' => '8','offre_commercial_id' => '2','name' => 'Hayya','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '9','offre_commercial_id' => '2','name' => 'PRE - Jawhara 35Mil','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '10','offre_commercial_id' => '2','name' => 'PRE - ESS Mobile 35mil/min','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '11','offre_commercial_id' => '2','name' => 'PRE - Pack cle 4G','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '12','offre_commercial_id' => '2','name' => 'PRE - Pass Etudiant','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '13','offre_commercial_id' => '2','name' => 'PRE - Po9','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '14','offre_commercial_id' => '2','name' => 'PRE - TM 35mil/min','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '15','offre_commercial_id' => '2','name' => 'PRE - Touriste SIM','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '16','offre_commercial_id' => '2','name' => 'PRE - Trankil TT','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '17','offre_commercial_id' => '2','name' => 'PRE - Vendor_RE','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),

            array('id' => '18','offre_commercial_id' => '3','name' => 'Cle 3G Prepaye','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '19','offre_commercial_id' => '3','name' => 'DimaNet Corporate','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '20','offre_commercial_id' => '3','name' => 'Dimanet Optica','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '21','offre_commercial_id' => '3','name' => 'Nouvelle Offre Dimanet 4G','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '22','offre_commercial_id' => '3','name' => 'Pack clé prépayé','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '23','offre_commercial_id' => '3','name' => 'PRE-pack cle 4G','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),

            array('id' => '24','offre_commercial_id' => '4','name' => 'Netbox 4G DataOnly','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '25','offre_commercial_id' => '4','name' => 'Netbox prepayee','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '26','offre_commercial_id' => '4','name' => 'Netbox Pro','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),

            array('id' => '27','offre_commercial_id' => '5','name' => 'M2M','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),

            array('id' => '28','offre_commercial_id' => '6','name' => 'WAFFI VDSL 2020','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),

            array('id' => '29','offre_commercial_id' => '7','name' => 'Rapido 2020 GU FSI 20','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '30','offre_commercial_id' => '7','name' => 'Rapido 2020 GU TT 100M','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '31','offre_commercial_id' => '7','name' => 'Rapido 2020 GU TT 20M','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '32','offre_commercial_id' => '7','name' => 'Rapido 2020 GU TT 50M','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),

            array('id' => '33','offre_commercial_id' => '8','name' => 'Offre de gros VDSL hybride','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '34','offre_commercial_id' => '8','name' => 'Offre de gros VDSL Postpayé','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '35','offre_commercial_id' => '8','name' => 'Fixe smart VDSL','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '36','offre_commercial_id' => '8','name' => 'Fix waffi VDSL','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '37','offre_commercial_id' => '8','name' => 'Rapido Pro','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '38','offre_commercial_id' => '8','name' => 'Rapido Pro Hybride','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '39','offre_commercial_id' => '8','name' => 'SMART VDSL GU TT','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '40','offre_commercial_id' => '8','name' => 'FIX-Smart VDSL GU FSI','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),

            array('id' => '41','offre_commercial_id' => '9','name' => 'PRE - 1=11','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '42','offre_commercial_id' => '9','name' => 'PRE - Conso 500mil_TT','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '43','offre_commercial_id' => '9','name' => 'PRE - CSSM 35mil/min','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '44','offre_commercial_id' => '9','name' => 'PRE - Day Pass','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '45','offre_commercial_id' => '9','name' => 'PRE – Doublé','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '46','offre_commercial_id' => '9','name' => 'PRE - Employe TT','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '47','offre_commercial_id' => '9','name' => 'PRE - EST 1000% New','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '48','offre_commercial_id' => '9','name' => 'PRE - offre 40','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '49','offre_commercial_id' => '9','name' => 'PRE - Oulidha 1000%','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '50','offre_commercial_id' => '9','name' => 'PRE - Pass Etudiant','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '51','offre_commercial_id' => '9','name' => 'PRE - Po9','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '52','offre_commercial_id' => '9','name' => 'PRE - TM 35mil/min','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '53','offre_commercial_id' => '9','name' => 'PRE - Touriste SIM','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '54','offre_commercial_id' => '9','name' => 'PRE - Trankil ELISSA','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '55','offre_commercial_id' => '9','name' => 'PRE - Trankil TT','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '56','offre_commercial_id' => '9','name' => 'PRE - TT 1000%','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '57','offre_commercial_id' => '9','name' => 'PRE - TT 300%','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '58','offre_commercial_id' => '9','name' => 'Hayya','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),

            array('id' => '59','offre_commercial_id' => '10','name' => 'Forfait SELECT','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '60','offre_commercial_id' => '10','name' => 'OPTICA','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
            array('id' => '61','offre_commercial_id' => '10','name' => 'Privilège','description' => NULL,'created_at' => '2022-05-13 00:40:58','updated_at' => '2022-05-13 00:40:58'),
        );
        DB::table('sub_commercial_offre')->insert($suboffre_commercial);
    }
}
