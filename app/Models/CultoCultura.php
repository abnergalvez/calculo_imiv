<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultoCultura extends Model
{
    use HasFactory;

    public static function subproyectos()
    {
        $subproyecto = [
            "centro_cultural" => "Centro Cultural, Establecimiento Actividades Desarrollo", 
            "conciertos_cine_teatro" => "Sala Conciertos, Cine, Teatro",
            "otro_equipamiento" => "Otro Equipamiento de culto y cultura",
            "templo_desarrollo" => "Templo, Establcimiento Actividades Desarrollo",
        ];

        return $subproyecto;
    }


    public static function escalas($subproyecto_key)
    {
        $escalas = [
            'centro_cultural' => NULL,
            'conciertos_cine_teatro' => NULL,
            'otro_equipamiento' => NULL,
            'templo_desarrollo' => NULL,
        ];

        return $escalas[$subproyecto_key];

    }
    
    public static function tipoCalculo($subproyecto_key)
    {
        $calculos = [
            "centro_cultural" => "superficie", 
            "conciertos_cine_teatro" => "superficie",
            "otro_equipamiento" => "superficie",
            "templo_desarrollo" => "superficie",

        ];

        return $calculos[$subproyecto_key];
    }

    public static function labelIngreso($subproyecto_key)
    {
        $labels = [
            "centro_cultural" => "Superficie Útil Construida (M2)", 
            "conciertos_cine_teatro" => "Superficie Útil Construida (M2)",
            "otro_equipamiento" => "Superficie Útil Construida (M2)",
            "templo_desarrollo" => "Superficie Útil Construida (M2)",
        ];

        return $labels[$subproyecto_key];
    }

}
