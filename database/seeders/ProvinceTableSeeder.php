<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('provinces')->insert([
            ['id' => 1, 'label' => 'Arica', 'tag' => 'arica', 'short' => 'Arica', 'region_id' => 1],
            ['id' => 2, 'label' => 'Parinacota', 'tag' => 'parinacota', 'short' => 'Parinacota', 'region_id' => 1],
            ['id' => 3, 'label' => 'Iquique', 'tag' => 'iquique', 'short' => 'Iquique', 'region_id' => 2],
            ['id' => 4, 'label' => 'El Tamarugal', 'tag' => 'tamarugal', 'short' => 'Tamarugal', 'region_id' => 2],
            ['id' => 5, 'label' => 'Antofagasta', 'tag' => 'antofagasta', 'short' => 'Antofagasta', 'region_id' => 3],
            ['id' => 6, 'label' => 'El Loa', 'tag' => 'loa', 'short' => 'Loa', 'region_id' => 3],
            ['id' => 7, 'label' => 'Tocopilla', 'tag' => 'tocopilla', 'short' => 'Tocopilla', 'region_id' => 3],
            ['id' => 8, 'label' => 'Chañaral', 'tag' => 'chanaral', 'short' => 'Chañaral', 'region_id' => 4],
            ['id' => 9, 'label' => 'Copiapó', 'tag' => 'copiapo', 'short' => 'Copiapó', 'region_id' => 4],
            ['id' => 10, 'label' => 'Huasco', 'tag' => 'huasco', 'short' => 'Huasco', 'region_id' => 4],
            ['id' => 11, 'label' => 'Choapa', 'tag' => 'choapa', 'short' => 'Choapa', 'region_id' => 5],
            ['id' => 12, 'label' => 'Elqui', 'tag' => 'elqui', 'short' => 'Elqui', 'region_id' => 5],
            ['id' => 13, 'label' => 'Limarí', 'tag' => 'limari', 'short' => 'Limarí', 'region_id' => 5],
            ['id' => 14, 'label' => 'Isla de Pascua', 'tag' => 'isla_pascua', 'short' => 'Pascua', 'region_id' => 6],
            ['id' => 15, 'label' => 'Los Andes', 'tag' => 'andes', 'short' => 'Andes', 'region_id' => 6],
            ['id' => 16, 'label' => 'Petorca', 'tag' => 'petorca', 'short' => 'Petorca', 'region_id' => 6],
            ['id' => 17, 'label' => 'Quillota', 'tag' => 'quillota', 'short' => 'Quillota', 'region_id' => 6],
            ['id' => 18, 'label' => 'San Antonio', 'tag' => 'san_antonio', 'short' => 'San Antonio', 'region_id' => 6],
            ['id' => 19, 'label' => 'San Felipe de Aconcagua', 'tag' => 'san_felipe', 'short' => 'San Felipe', 'region_id' => 6],
            ['id' => 20, 'label' => 'Valparaiso', 'tag' => 'valparaiso', 'short' => 'Valparaiso', 'region_id' => 6],
            ['id' => 21, 'label' => 'Chacabuco', 'tag' => 'chacabuco', 'short' => 'Chacabuco', 'region_id' => 7],
            ['id' => 22, 'label' => 'Cordillera', 'tag' => 'cordillera', 'short' => 'Cordillera', 'region_id' => 7],
            ['id' => 23, 'label' => 'Maipo', 'tag' => 'maipo', 'short' => 'Maipo', 'region_id' => 7],
            ['id' => 24, 'label' => 'Melipilla', 'tag' => 'melipilla', 'short' => 'Melipilla', 'region_id' => 7],
            ['id' => 25, 'label' => 'Santiago', 'tag' => 'santiago', 'short' => 'Santiago', 'region_id' => 7],
            ['id' => 26, 'label' => 'Talagante', 'tag' => 'talagante', 'short' => 'Talagante', 'region_id' => 7],
            ['id' => 27, 'label' => 'Cachapoal', 'tag' => 'cachapoal', 'short' => 'Cachapoal', 'region_id' => 8],
            ['id' => 28, 'label' => 'Cardenal Caro', 'tag' => 'cardenal_caro', 'short' => 'Cardenal Caro', 'region_id' => 8],
            ['id' => 29, 'label' => 'Colchagua', 'tag' => 'colchagua', 'short' => 'Colchagua', 'region_id' => 8],
            ['id' => 30, 'label' => 'Cauquenes', 'tag' => 'cauquenes', 'short' => 'Cauquenes', 'region_id' => 9],
            ['id' => 31, 'label' => 'Curicó', 'tag' => 'curico', 'short' => 'Curicó', 'region_id' => 9],
            ['id' => 32, 'label' => 'Linares', 'tag' => 'linares', 'short' => 'Linares', 'region_id' => 9],
            ['id' => 33, 'label' => 'Talca', 'tag' => 'talca', 'short' => 'Talca', 'region_id' => 9],
            ['id' => 34, 'label' => 'Arauco', 'tag' => 'arauco', 'short' => 'Arauco', 'region_id' => 10],
            ['id' => 35, 'label' => 'Bio Bío', 'tag' => 'biobio', 'short' => 'Bio Bío', 'region_id' => 10],
            ['id' => 36, 'label' => 'Concepción', 'tag' => 'concepcion', 'short' => 'Concepción', 'region_id' => 10],
            ['id' => 37, 'label' => 'Itata', 'tag' => 'itata', 'short' => 'Itata', 'region_id' => 16],
            ['id' => 38, 'label' => 'Cautín', 'tag' => 'cautin', 'short' => 'Cautín', 'region_id' => 11],
            ['id' => 39, 'label' => 'Malleco', 'tag' => 'malleco', 'short' => 'Malleco', 'region_id' => 11],
            ['id' => 40, 'label' => 'Valdivia', 'tag' => 'valdivia', 'short' => 'Valdivia', 'region_id' => 12],
            ['id' => 41, 'label' => 'Ranco', 'tag' => 'ranco', 'short' => 'Ranco', 'region_id' => 12],
            ['id' => 42, 'label' => 'Chiloé', 'tag' => 'chiloe', 'short' => 'Chiloé', 'region_id' => 13],
            ['id' => 43, 'label' => 'Llanquihue', 'tag' => 'llanquihue', 'short' => 'Llanquihue', 'region_id' => 13],
            ['id' => 44, 'label' => 'Osorno', 'tag' => 'osorno', 'short' => 'Osorno', 'region_id' => 13],
            ['id' => 45, 'label' => 'Palena', 'tag' => 'palena', 'short' => 'Palena', 'region_id' => 13],
            ['id' => 46, 'label' => 'Aysén', 'tag' => 'aysen', 'short' => 'Aysén', 'region_id' => 14],
            ['id' => 47, 'label' => 'Capitán Prat', 'tag' => 'capitan_prat', 'short' => 'Prat', 'region_id' => 14],
            ['id' => 48, 'label' => 'Coyhaique', 'tag' => 'coyhaique', 'short' => 'Coyhaique', 'region_id' => 14],
            ['id' => 49, 'label' => 'General Carrera', 'tag' => 'general_carrera', 'short' => 'Carrera', 'region_id' => 14],
            ['id' => 50, 'label' => 'Antártica Chilena', 'tag' => 'antartica', 'short' => 'Antártica', 'region_id' => 15],
            ['id' => 51, 'label' => 'Magallanes', 'tag' => 'magallanes', 'short' => 'Magallanes', 'region_id' => 15],
            ['id' => 52, 'label' => 'Tierra del Fuego', 'tag' => 'tierra_fuego', 'short' => 'Tierra del Fuego', 'region_id' => 15],
            ['id' => 53, 'label' => 'Última Esperanza', 'tag' => 'ultima_esperanza', 'short' => 'Última Esperanza', 'region_id' => 15],
            ['id' => 54, 'label' => 'Marga Marga', 'tag' => 'marga_marga', 'short' => 'Marga Marga', 'region_id' => 6],
            ['id' => 55, 'label' => 'Diguillín', 'tag' => 'diguillin', 'short' => 'Diguillín', 'region_id' => 16],
            ['id' => 56, 'label' => 'Punilla', 'tag' => 'punilla', 'short' => 'Punilla', 'region_id' => 16]
        ]);
    }
}
