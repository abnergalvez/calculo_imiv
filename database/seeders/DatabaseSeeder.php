<?php

namespace Database\Seeders;

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
        $this->call([
            RegionTableSeeder::class,
            ProvinceTableSeeder::class,
            CommuneTableSeeder::class,

            UsersTableSeeder::class,
            TypeProjectTableSeeder::class,
            CustomerTableSeeder::class,
            ProjectTableSeeder::class,
        ]);
    }
}
