<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cientifico extends Model
{
    use HasFactory;

    public static function subproyectos()
    {
        $subproyecto = [
            "centro_investigacion" => "Centro Investigación Cientifica, Desarrollo y transferencia, Innovacion Técnica", 
        ];

        return $subproyecto;
    }


    public static function escalas($subproyecto_key)
    {
        $escalas = [
            'centro_investigacion' => NULL,
        ];

        return $escalas[$subproyecto_key];
    }
    
    public static function tipoCalculo($subproyecto_key)
    {
        $calculos = [
            "centro_investigacion" => "superficie",
        ];

        return $calculos[$subproyecto_key];
    }

}
