<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comercio extends Model
{
    use HasFactory;

    public static function proyectos()
    {
        $proyecto = [
            "tienda_por_departamentos" => "Centro Comercial, Tienda por Departamentos", 
            "centro_automotor" => "Centro de Servicio Automotor",
            "estacion_servicio_dispensador" => "Dispensador de Estacion de Servicio",
            "supermercado_local_comercial" => "Supermercado, Local Comercial",
            "restaurant_bar_discoteca" => "Restaurant, Fuente de Soda, Bar, Discoteca",
            "otro_equipamiento" => "Otro Equipamiento de Comercio",
        ];

        return $proyecto;
    }


    public static function escalas($proyecto_key)
    {
        $escala = [
            'tienda_por_departamentos' => [ 
                'mayor' => 'Mayor' , 
                'mediano' =>'Mediano'
            ],
            'supermercado_local_comercial' => [ 
                'mayor' => 'Mayor' , 
                'mediano' =>'Mediano',
                'menor' =>'Menor o Básico',
            ],
            'otro_equipamiento' => [ 
                'mayor' => 'Mayor' , 
                'mediano' =>'Mediano',
                'menor' =>'Menor',
                'menor' =>'Básico',
            ]
        ];

        return $escala[$proyecto_key];

    }
    
    public static function tipoCalculo($proyecto_key)
    {
        $proyecto = [
            "tienda_por_departamentos" => "superficie", 
            "centro_automotor" => "superficie",
            "estacion_servicio_dispensador" => "cantidad",
            "supermercado_local_comercial" => "superficie",
            "restaurant_bar_discoteca" => "superficie",
            "otro_equipamiento" => "superficie",
        ];

        return $proyecto[$proyecto_key];
    }
}
