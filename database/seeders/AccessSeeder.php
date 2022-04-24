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
            array('id' => '8','categories_id' => '8','roles_id' => '1','able' => '1'),
            array('id' => '9','categories_id' => '9','roles_id' => '1','able' => '1'),
            array('id' => '10','categories_id' => '10','roles_id' => '1','able' => '1'),
            array('id' => '11','categories_id' => '11','roles_id' => '1','able' => '1'),
            array('id' => '12','categories_id' => '12','roles_id' => '1','able' => '1'),
            array('id' => '13','categories_id' => '13','roles_id' => '1','able' => '1'),
            array('id' => '14','categories_id' => '14','roles_id' => '1','able' => '1'),
            array('id' => '15','categories_id' => '15','roles_id' => '1','able' => '1'),
            array('id' => '16','categories_id' => '16','roles_id' => '1','able' => '1'),
            array('id' => '17','categories_id' => '17','roles_id' => '1','able' => '1'),
            array('id' => '18','categories_id' => '18','roles_id' => '1','able' => '1'),
        );

        DB::table('access')->insert($access);
    }
}
