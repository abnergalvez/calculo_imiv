<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('customers')->insert([

            [
                'name' => 'Cliente1',
                'rut' => '77777777-7',
                'created_at' => '2021-08-11 10:00:00'            
            ],
            [
                'name' => 'Cliente2',
                'rut' => '22222222-2',
                'created_at' => '2021-10-10 10:00:00'            
            ]
            
        ]);
    }
}
