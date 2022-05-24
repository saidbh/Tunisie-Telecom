<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersRolesSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(SubCategoriesSeeder::class);
        $this->call(AccessSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(departementSeeder::class);
        $this->call(objectifsSeeder::class);
        $this->call(technicOffresSeeder::class);
        $this->call(OffreCommercialSeeder::class);
    }
}
