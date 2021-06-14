<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HogaresAcogida extends Model
{
    use HasFactory;

    public static function subproyectos()
    {
        $subproyecto = [
            "atencion_ninez_adolecencia" => "Centro Residencial Atencion a la Niñes/Adolescencia", 
            "hogar_estudiantil" => "Hogar Estudiantil",
            "larga_estadia_adultos_mayores" => "Establecimiento larga estadia , Adultos Mayores",
        ];

        return $subproyecto;
    }


    public static function escalas($subproyecto_key)
    {
        $escalas = [
            'atencion_ninez_adolecencia' => NULL,
            'hogar_estudiantil' => NULL,
            'larga_estadia_adultos_mayores' => NULL,
        ];

        return $escalas[$subproyecto_key];

    }
    
    public static function tipoCalculo($subproyecto_key)
    {
        $calculos = [
            "atencion_ninez_adolecencia" => "cantidad", 
            "hogar_estudiantil" => "cantidad",
            "larga_estadia_adultos_mayores" => "cantidad",

        ];

        return $calculos[$subproyecto_key];
    }

    public static function labelIngreso($subproyecto_key)
    {
        $labels = [
            "atencion_ninez_adolecencia" => "Cantidad Total Habitaciones", 
            "hogar_estudiantil" => "Cantidad Total Habitaciones",
            "larga_estadia_adultos_mayores" => "Cantidad Total Habitaciones",
        ];

        return $labels[$subproyecto_key];
    }

}
