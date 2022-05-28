<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $access = array(
            array('id' => '1','categories_id' => '1','roles_id' => '1','able' => '1'),
            array('id' => '2','categories_id' => '2','roles_id' => '1','able' => '1'),
            array('id' => '3','categories_id' => '3','roles_id' => '1','able' => '1'),
            array('id' => '4','categories_id' => '4','roles_id' => '1','able' => '1'),
            array('id' => '5','categories_id' => '5','roles_id' => '1','able' => '1'),
            array('id' => '6','categories_id' => '6','roles_id' => '1','able' => '1'),
            array('id' => '7','categories_id' => '7','roles_id' => '1','able' => '1'),
        );

        DB::table('access')->insert($access);
    }
}
