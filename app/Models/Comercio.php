<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comercio extends Model
{
    use HasFactory;

    public static function subproyectos()
    {
        $subproyecto = [
            "tienda_por_departamentos" => "Centro Comercial, Tienda por Departamentos", 
            "centro_automotor" => "Centro de Servicio Automotor",
            "estacion_servicio_dispensador" => "Dispensador de Estacion de Servicio",
            "supermercado_local_comercial" => "Supermercado, Local Comercial",
            "restaurant_bar_discoteca" => "Restaurant, Fuente de Soda, Bar, Discoteca",
            "otro_equipamiento" => "Otro Equipamiento de Comercio",
        ];

        return $subproyecto;
    }


    public static function escalas($subproyecto_key)
    {
        $escalas = [
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
            ],
            'centro_automotor' => NULL,
            'estacion_servicio_dispensador' => NULL,
            'restaurant_bar_discoteca' => NULL,
        ];

        return $escalas[$subproyecto_key];

    }
    
    public static function tipoCalculo($subproyecto_key)
    {
        $calculos = [
            "tienda_por_departamentos" => "superficie", 
            "centro_automotor" => "superficie",
            "estacion_servicio_dispensador" => "cantidad",
            "supermercado_local_comercial" => "superficie",
            "restaurant_bar_discoteca" => "superficie",
            "otro_equipamiento" => "superficie",
        ];

        return $calculos[$subproyecto_key];
    }


    public static function labelIngreso($subproyecto_key)
    {
        $labels = [
            "tienda_por_departamentos" => "Superficie Útil Construida (M2)", 
            "centro_automotor" => "Superficie Útil Construida (M2)",
            "estacion_servicio_dispensador" => "Cantidad Dispensadores",
            "supermercado_local_comercial" => "Superficie Útil Construida (M2)",
            "restaurant_bar_discoteca" => "Superficie Útil Construida (M2)",
            "otro_equipamiento" => "Superficie Útil Construida (M2)",
        ];

        return $labels[$subproyecto_key];
    }
}
