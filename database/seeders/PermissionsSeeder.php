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
        );

        DB::table('permissions')->insert($permissions);
    }
}
