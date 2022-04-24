<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            array('id' => '1','name' => 'superadmin','description' => 'superadmin','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','name' => 'Admin','description' => 'admin','created_at' => '2022-04-16 15:28:49','updated_at' => '2022-04-16 15:28:49'),
            array('id' => '3','name' => 'User','description' => 'users','created_at' => '2022-04-16 15:28:49','updated_at' => '2022-04-16 15:28:49'),
        );

        DB::table('roles')->insert($roles);
    }
}
