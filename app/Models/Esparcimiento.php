<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Esparcimiento extends Model
{
    use HasFactory;

    public static function subproyectos()
    {
        $subproyecto = [
            "casino_de_juegos" => "Casino de Juegos", 
            "otro_equipamiento" => "Otro Equipamiento de Esparcimiento",
            "parque_juegos_electronicos" => "Parque Entretenciones, Local Juegos Electronicos/Mecanicos",
        ];

        return $subproyecto;
    }


    public static function escalas($subproyecto_key)
    {
        $escalas = [
            'casino_de_juegos' => NULL,
            'otro_equipamiento' => NULL,
            'parque_juegos_electronicos' => NULL,
        ];

        return $escalas[$subproyecto_key];

    }
    
    public static function tipoCalculo($subproyecto_key)
    {
        $calculos = [
            "casino_de_juegos" => "superficie", 
            "otro_equipamiento" => "superficie",
            "parque_juegos_electronicos" => "superficie",
        ];

        return $calculos[$subproyecto_key];
    }

    public static function labelIngreso($subproyecto_key)
    {
        $labels = [
            "casino_de_juegos" => "Superficie Total (M2)", 
            "otro_equipamiento" => "Superficie Total (M2)",
            "parque_juegos_electronicos" => "Superficie Total (M2)",
        ];

        return $labels[$subproyecto_key];
    }

}
