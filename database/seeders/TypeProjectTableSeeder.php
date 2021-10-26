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
                'budget_entry_days_limit' => 30,

                'observation_days_limit' => 45,
                're_entry_days_limit' => 20,
                'final_status_days_limit' => 20,
                
            ],
            [
                'name' => 'IMIV Intermedio',
                'description' => '',
                'budget_entry_days_limit' => 30,

                'observation_days_limit' => 60,
                're_entry_days_limit' => 30,
                'final_status_days_limit' => 30,
                
            ],
            [
                'name' => 'IMIV Mayor',
                'description' => '',
                'budget_entry_days_limit' => 60,

                'observation_days_limit' => 60,
                're_entry_days_limit' => 30,
                'final_status_days_limit' => 30,
                
            ],
            [
                'name' => 'Proyecto Pavimentación',
                'description' => '',
                'budget_entry_days_limit' => 30,

                'observation_days_limit' => 30,
                're_entry_days_limit' => 30,
                'final_status_days_limit' => 30,
            ],
            [
                'name' => 'Proyecto UOCT',
                'description' => '',
                'budget_entry_days_limit' => 30,

                'observation_days_limit' => 30,
                're_entry_days_limit' => 30,
                'final_status_days_limit' => 30,
            ],
            [
                'name' => 'Proyecto de Señalización',
                'description' => '',
                'budget_entry_days_limit' => 30,

                'observation_days_limit' => 30,
                're_entry_days_limit' => 30,
                'final_status_days_limit' => 30,
            ],
            [
                'name' => 'TEP',
                'description' => '',
                'budget_entry_days_limit' => 30,

                'observation_days_limit' => 30,
                're_entry_days_limit' => 30,
                'final_status_days_limit' => 30,
            ],
            [
                'name' => 'Proyecto Paraderos',
                'description' => '',
                'budget_entry_days_limit' => 30,

                'observation_days_limit' => 30,
                're_entry_days_limit' => 30,
                'final_status_days_limit' => 30,
            ],
            [
                'name' => 'Proyecto Iluminación',
                'description' => '',
                'budget_entry_days_limit' => 30,

                'observation_days_limit' => 30,
                're_entry_days_limit' => 30,
                'final_status_days_limit' => 30,
            ],
            [
                'name' => 'Otros',
                'description' => '',
                'budget_entry_days_limit' => 30,
                
                'observation_days_limit' => 30,
                're_entry_days_limit' => 30,
                'final_status_days_limit' => 30,
            ]
            
        ]);
    }
}
