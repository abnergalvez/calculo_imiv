<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educacion extends Model
{
    use HasFactory;

    public static function subproyectos()
    {
        $subproyecto = [
            "basica_media_especial" => "Establecimiento Básica, Media, Especial o Técnico-Profesional", 
            "otro_equipamiento" => "Otro equipamiento educacional",
            "parvularia" => "Establecimiento Parvularia, Prebásica",
            "superior" => "Supermercado, Local Comercial",
        ];

        return $subproyecto;
    }


    public static function escalas($subproyecto_key)
    {
        $escalas = [
            'basica_media_especial' => NULL,
            'otro_equipamiento' => NULL,
            'parvularia' => NULL,
            'superior' => NULL,
        ];

        return $escalas[$subproyecto_key];

    }
    
    public static function tipoCalculo($subproyecto_key)
    {
        $calculos = [
            "basica_media_especial" => "cantidad", 
            "otro_equipamiento" => "cantidad",
            "parvularia" => "cantidad",
            "superior" => "cantidad",
        ];

        return $calculos[$subproyecto_key];
    }

}
