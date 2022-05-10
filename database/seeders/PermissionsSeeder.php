<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
            array('id' => '1','roles_id' => '1','sub_categories_id' => '1','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '2','roles_id' => '1','sub_categories_id' => '2','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '3','roles_id' => '1','sub_categories_id' => '3','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '4','roles_id' => '1','sub_categories_id' => '4','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),

            array('id' => '5','roles_id' => '1','sub_categories_id' => '5','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '6','roles_id' => '1','sub_categories_id' => '6','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '7','roles_id' => '1','sub_categories_id' => '7','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '8','roles_id' => '1','sub_categories_id' => '8','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '9','roles_id' => '1','sub_categories_id' => '9','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '10','roles_id' => '1','sub_categories_id' => '10','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '11','roles_id' => '1','sub_categories_id' => '11','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '12','roles_id' => '1','sub_categories_id' => '12','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '13','roles_id' => '1','sub_categories_id' => '13','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '14','roles_id' => '1','sub_categories_id' => '14','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '15','roles_id' => '1','sub_categories_id' => '15','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '16','roles_id' => '1','sub_categories_id' => '16','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '17','roles_id' => '1','sub_categories_id' => '17','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '18','roles_id' => '1','sub_categories_id' => '18','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '19','roles_id' => '1','sub_categories_id' => '19','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '20','roles_id' => '1','sub_categories_id' => '20','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '21','roles_id' => '1','sub_categories_id' => '21','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '22','roles_id' => '1','sub_categories_id' => '22','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
            array('id' => '23','roles_id' => '1','sub_categories_id' => '23','can_read' => '1','can_create' => '1','can_update' => '1','can_delete' => '1','access' => '1'),
        );

        DB::table('permissions')->insert($permissions);
    }
}
