<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
    use HasFactory;

    public static function subproyectos()
    {
        $subproyecto = [
            "club_deportivo" => "Centro o Club Deportivo", 
            "estadio" => "Estadio",
            "gimnasio" => "Gimnasio",
            "multicancha" => "Multicancha",
            "otro_equipamiento" => "Otro Equipamiento destinado al deporte y actividad fisica",
        ];

        return $subproyecto;
    }


    public static function escalas($subproyecto_key)
    {
        $escalas = [
            'club_deportivo' => NULL,
            'estadio' => NULL,
            'gimnasio' => NULL,
            'multicancha' => NULL,
            'otro_equipamiento' => NULL,
        ];

        return $escalas[$subproyecto_key];

    }
    
    public static function tipoCalculo($subproyecto_key)
    {
        $calculos = [
            "club_deportivo" => "superficie", 
            "estadio" => "superficie",
            "gimnasio" => "superficie",
            "multicancha" => "superficie",
            "otro_equipamiento" => "superficie",
        ];

        return $calculos[$subproyecto_key];
    }

    public static function labelIngreso($subproyecto_key)
    {
        $labels = [
            "club_deportivo" => "Superficie Útil Construida (M2)", 
            "estadio" => "Superficie Útil Construida (M2)",
            "gimnasio" => "Superficie Útil Construida (M2)",
            "multicancha" => "Superficie Útil Construida (M2)",
            "otro_equipamiento" => "Superficie Útil Construida (M2)",
        ];

        return $labels[$subproyecto_key];
    }


}
