<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('projects')->insert([

            [
                'name' => 'Proyecto X1',
                'code' => '1234565',
                'entry_number' => '35233',
                'description' => 'Proyecto X1 de descripcion',
                'address' => 'Calle X , villa 2',
                'commune_id' => 6,
                'entry_date' => '2021-10-08',
                'limit_observation_date' => '2021-11-22',
                'status' => 'registered_for_observation',
                'customer_id' => '1',
                'type_project_id' => '1',
            ],
            [
                'name' => 'Proyecto X2',
                'code' => '123452342',
                'entry_number' => '35233',
                'description' => 'Proyecto X2 de descripcion',
                'address' => 'Calle X , villa 3',
                'commune_id' => 18,
                'entry_date' => '2021-10-08',
                'limit_observation_date' => '2022-01-06',
                'status' => 'registered_for_observation',
                'customer_id' => '2',
                'type_project_id' => '3',
            ],
            [
                'name' => 'Proyecto X3',
                'code' => '152342',
                'entry_number' => '36233',
                'description' => 'Proyecto X3 de descripcion',
                'address' => 'Calle X3 , villa 3',
                'commune_id' => 40,
                'entry_date' => '2021-10-10',
                'limit_observation_date' => '2022-01-08',
                'status' => 'accepted',
                'customer_id' => '1',
                'type_project_id' => '5',
            ],
            [
                'name' => 'Proyecto X6',
                'code' => '1542',
                'entry_number' => '3633',
                'description' => 'Proyecto X6 de descripcion',
                'address' => 'Calle X3 , villa 3',
                'commune_id' => 40,
                'entry_date' => '2021-10-10',
                'limit_observation_date' => '2022-01-08',
                'status' => null,
                'customer_id' => '2',
                'type_project_id' => '6',
            ]


        ]);
    }
}
