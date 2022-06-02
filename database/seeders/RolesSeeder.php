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
        );
        DB::table('roles')->insert($roles);
    }
}
