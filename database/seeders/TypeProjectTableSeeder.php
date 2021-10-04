<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TypeProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('type_projects')->insert([

            [
                'name' => 'IMIV Básico',
                'description' => '',
                're_entry_days_limit' => 65
            ],
            [
                'name' => 'IMIV Intermedio - Mayor',
                'description' => '',
                're_entry_days_limit' => 90
            ],
            [
                'name' => 'Proyecto Pavimentación',
                'description' => '',
                're_entry_days_limit' => 90
            ],
            [
                'name' => 'Proyecto UOCT',
                'description' => '',
                're_entry_days_limit' => 45
            ],
            [
                'name' => 'Proyecto de Señalización',
                'description' => '',
                're_entry_days_limit' => 45
            ],
            [
                'name' => 'TEP',
                'description' => '',
                're_entry_days_limit' => 45
            ],
            [
                'name' => 'Proyecto Paraderos',
                'description' => '',
                're_entry_days_limit' => 45
            ],
            [
                'name' => 'Proyecto Iluminación',
                'description' => '',
                're_entry_days_limit' => 45
            ],
            [
                'name' => 'Otros',
                'description' => '',
                're_entry_days_limit' => 45
            ]
            
        ]);
    }
}
