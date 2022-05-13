<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_categories = array(
            array('id' => '1','categories_id' => '2','title' => 'Liste des Utilisateurs','link' => 'users-accounts.list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),

            array('id' => '2','categories_id' => '3','title' => 'Vue Globale','link' => 'technical-global-view','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','categories_id' => '3','title' => 'Gestion offres','link' => 'technical-offres-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),

            array('id' => '4','categories_id' => '4','title' => 'Vue Globale','link' => 'commercial-global-view','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','categories_id' => '4','title' => 'Mobile prepaye brut','link' => 'mobile-prepay-b-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','categories_id' => '4','title' => 'Mobile prepaye net','link' => 'mobile-prepay-n-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','categories_id' => '4','title' => 'Mobile bills','link' => 'mobile-bills-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','categories_id' => '4','title' => 'Cle 3G','link' => 'key-3g-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','categories_id' => '4','title' => 'Netbox','link' => 'Netbox-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','categories_id' => '4','title' => 'M2M','link' => 'm2m-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','categories_id' => '4','title' => 'Waffi ADSL','link' => 'wafi-offres-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','categories_id' => '4','title' => 'Rapido 2020','link' => 'Rapido-2020-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '13','categories_id' => '4','title' => 'Autres THD','link' => 'Autres-thd-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '14','categories_id' => '4','title' => 'Portabilité IN Prépayé','link' => 'portability-prepay-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '15','categories_id' => '4','title' => 'Portabilité IN Mobile à Facture','link' => 'portability-prepay-bills-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),

            array('id' => '16','categories_id' => '5','title' => 'Fixes','link' => 'fixes-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '17','categories_id' => '5','title' => 'Adsl','link' => 'offres-list','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),

            array('id' => '18','categories_id' => '6','title' => 'Rôles et permissions','link' => 'system-role-permission','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '19','categories_id' => '6','title' => 'Attribution Rôle','link' => 'system-assign-role','icon' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '20','categories_id' => '6','title' => 'Dictionnaire','link' => 'system-dictionary','icon' => NULL,'created_at' => NULL,'updated_at' => NULL)
        );

        DB::table('sub_categories')->insert($sub_categories);
    }
}
