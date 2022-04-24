<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            array('id' => '1','title' => 'Tableau de bord','link' => 'admin.dashboard','icon' => 'ri-dashboard-line','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','title' => 'Utilisateur','link' => 'users','icon' => 'ri-contacts-book-line','created_at' => NULL,'updated_at' => NULL),

            array('id' => '3','title' => 'ADSL','link' => 'adsl','icon' => 'ri-base-station-line','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','title' => 'Fixes','link' => 'fixes','icon' => 'ri-phone-fill','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','title' => 'FO internet','link' => 'fo-internet','icon' => 'ri-cloud-fill','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','title' => 'Taux de penetration','link' => 't-penetration','icon' => 'ri-pie-chart-line','created_at' => NULL,'updated_at' => NULL),

            array('id' => '7','title' => 'Mobile prépayé Brut','link' => 'mobile-prepaid-b','icon' => 'ri-smartphone-fill','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','title' => 'Mobile prépayé Net','link' => 'mobile-prepaid-n','icon' => 'ri-smartphone-line','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','title' => 'Mobile a facture','link' => 'mobile-bills','icon' => 'ri-bill-line','created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','title' => 'Cle 3G','link' => '3Gkey','icon' => 'ri-cellphone-fill','created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','title' => 'Netbox','link' => 'netbox','icon' => 'ri-rss-line','created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','title' => 'M2M','link' => 'm2m','icon' => 'ri-scan-fill','created_at' => NULL,'updated_at' => NULL),
            array('id' => '13','title' => 'Waffi VDSL','link' => 'waffi','icon' => 'ri-signal-tower-line','created_at' => NULL,'updated_at' => NULL),
            array('id' => '14','title' => 'Rapido 2020','link' => 'rapido2020','icon' => 'ri-device-fill','created_at' => NULL,'updated_at' => NULL),
            array('id' => '15','title' => 'Autres THD','link' => 'other-th','icon' => 'ri-file-list-line','created_at' => NULL,'updated_at' => NULL),
            array('id' => '16','title' => 'Portabilité IN Prépayé','link' => 'portability-IN-prepaid','icon' => 'ri-money-dollar-box-line','created_at' => NULL,'updated_at' => NULL),
            array('id' => '17','title' => 'Portabilité IN Mobile Facture','link' => 'portability-IN-mobile-bill','icon' => 'ri-money-dollar-box-fill','created_at' => NULL,'updated_at' => NULL),

            array('id' => '18','title' => 'System','link' => 'system','icon' => 'ri-settings-line','created_at' => NULL,'updated_at' => NULL)
        );
        DB::table('categories')->insert($categories);
    }
}
