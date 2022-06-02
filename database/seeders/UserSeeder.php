<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array('id' => '1','agencies_id' => NULL,'email' => 'superadmin@gmail.com','phone' => '00000000','password' => '$2y$10$iUS2iaoK3VBhUgPZlh10texQsxNCIFa01r7klZZXvKOBiWc2alpbq','api_token' => 'uIy5HrlgQoNI2LvwXNCy55FSHO0yzosmCE4YYynpi5JtdaKL9ySWqe6sK2Qd','remember_token' => NULL,'email_verified_at' => NULL,'archived' => '0','activated' => '1','blocked' => '0','created_at' => NULL,'updated_at' => NULL),
        );

        DB::table('users')->insert($users);
    }
}
