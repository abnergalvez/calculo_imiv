<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salud extends Model
{
    use HasFactory;


    public static function subproyectos()
    {
        $subproyecto = [
            "atencion_primaria_urgencia_familiar" => "Atencion Primaria de Urgencia, Centro Salud Familiar", 
            "cementerio_crematorio" => "Cementerio Crematorio",
            "hospital_clinica" => "Hospital (alta,mediana, baja complejidad), Clinica Privada, otro",
            "rehabilitacion" => "Centro Referencia Salud, Rehabilitacion",
        ];

        return $subproyecto;
    }


    public static function escalas($subproyecto_key)
    {
        $escalas = [
            'atencion_primaria_urgencia_familiar' => NULL,
            'cementerio_crematorio' => NULL,
            'hospital_clinica' => NULL,
            'rehabilitacion' => NULL,
        ];

        return $escalas[$subproyecto_key];

    }
    
    public static function tipoCalculo($subproyecto_key)
    {
        $calculos = [
            "atencion_primaria_urgencia_familiar" => "superficie", 
            "cementerio_crematorio" => "superficie",
            "hospital_clinica" => "superficie",
            "rehabilitacion" => "superficie",
        ];

        return $calculos[$subproyecto_key];
    }

    public static function labelIngreso($subproyecto_key)
    {
        $labels = [
            "atencion_primaria_urgencia_familiar" => "Superficie Total (M2)", 
            "cementerio_crematorio" => "Superficie Total (M2)",
            "hospital_clinica" => "Superficie Total (M2)",
            "rehabilitacion" => "Superficie Total (M2)",
        ];

        return $labels[$subproyecto_key];
    }

}
