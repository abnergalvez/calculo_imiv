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
                'rut' => '777.777.777-7'            
            ],
            [
                'name' => 'Cliente2',
                'rut' => '222.222.222-2'            
            ]
            
        ]);
    }
}
