<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospedaje extends Model
{
    use HasFactory;

    public static function subproyectos()
    {
        $subproyecto = [
            "alojamiento_turistico" => "Establecimiento Alojamiento Turistico (Habitacion)", 
        ];

        return $subproyecto;
    }


    public static function escalas($subproyecto_key)
    {
        $escalas = [
            'alojamiento_turistico' => NULL,
        ];

        return $escalas[$subproyecto_key];

    }
    
    public static function tipoCalculo($subproyecto_key)
    {
        $calculos = [
            "alojamiento_turistico" => "cantidad", 
        ];

        return $calculos[$subproyecto_key];
    }


}
