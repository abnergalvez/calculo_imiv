<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('regions')->insert([

            ['id' => 1, 'label' => 'Arica y Parinacota', 'tag' => 'arica_parinacota', 'short' => 'Arica'],
            ['id' => 2, 'label' => 'Tarapacá', 'tag' => 'tarapaca', 'short' => 'Tarapacá'],
            ['id' => 3, 'label' => 'Antofagasta', 'tag' => 'antofagasta', 'short' => 'Antofagasta'],
            ['id' => 4, 'label' => 'Atacama', 'tag' => 'atacama', 'short' => 'Atacama'],
            ['id' => 5, 'label' => 'Coquimbo', 'tag' => 'coquimbo', 'short' => 'Coquimbo'],
            ['id' => 6, 'label' => 'Valparaiso', 'tag' => 'valparaiso', 'short' => 'Valparaiso'],
            ['id' => 7, 'label' => 'Metropolitana de Santiago', 'tag' => 'metropolitana', 'short' => 'Metropolitana'],
            ['id' => 8, 'label' => 'Libertador General Bernardo O\'Higgins', 'tag' => 'ohiggins', 'short' => 'O\'Higgins'],
            ['id' => 9, 'label' => 'Maule', 'tag' => 'maule', 'short' => 'Maule'],
            ['id' => 10, 'label' => 'Biobío', 'tag' => 'biobio', 'short' => 'Biobío'],
            ['id' => 11, 'label' => 'La Araucanía', 'tag' => 'araucania', 'short' => 'Araucanía'],
            ['id' => 12, 'label' => 'Los Ríos', 'tag' => 'rios', 'short' => 'Ríos'],
            ['id' => 13, 'label' => 'Los Lagos', 'tag' => 'lagos', 'short' => 'Lagos'],
            ['id' => 14, 'label' => 'Aysén del General Carlos Ibáñez del Campo', 'tag' => 'aysen', 'short' => 'Aysén'],
            ['id' => 15, 'label' => 'Magallanes y de la Antártica Chilena', 'tag' => 'magallanes', 'short' => 'Magallanes'],
            ['id' => 16, 'label' => 'Ñuble', 'tag' => 'nuble', 'short' => 'Ñuble'],
            ['id' => 17, 'label' => 'Nacional', 'tag' => 'nacional', 'short' => 'Nacional'],

        ]);
    }
}
