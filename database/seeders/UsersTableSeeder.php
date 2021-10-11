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
                'gender' => 'female',
                'password' => Hash::make('123123'),
                'created_at' => '2021-08-11 10:00:00'
            ],
            [
                'name' => 'Usuario Normal GYS',
                'email' => 'normal@mail.cl',
                'profile' => 'normal',
                'gender' => 'male',
                'password' => Hash::make('123123'),
                'created_at' => '2021-08-11 10:00:00'
            ],
            [
                'name' => 'Cliente GYS',
                'email' => 'cliente@mail.cl',
                'profile' => 'customer',
                'gender' => NULL,
                'password' => Hash::make('123123'),
                'created_at' => '2021-10-10 10:00:00'
            ]

        ]);
    }
}
