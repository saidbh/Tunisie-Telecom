<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_roles = array(
            array('id' => '1','users_id' => '1','roles_id' => '1'),
            array('id' => '2','users_id' => '2','roles_id' => '2'),
            array('id' => '3','users_id' => '3','roles_id' => '3'),
        );
        DB::table('users_roles')->insert($users_roles);
    }
}
