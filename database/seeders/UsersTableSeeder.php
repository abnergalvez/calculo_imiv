<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([

            [
                'name' => 'Admin GYS',
                'email' => 'admin@mail.cl',
                'profile' => 'admin',
                'password' => Hash::make('123123')
            ],
            [
                'name' => 'Usuario Normal GYS',
                'email' => 'normal@mail.cl',
                'profile' => 'normal',
                'password' => Hash::make('123123')
            ],
            [
                'name' => 'Cliente GYS',
                'email' => 'cliente@mail.cl',
                'profile' => 'customer',
                'password' => Hash::make('123123')
            ]

        ]);
    }
}
