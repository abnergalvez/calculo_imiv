<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industrial extends Model
{
    use HasFactory;

    public static function subproyectos()
    {
        $subproyecto = [
            "grandes_depositos_bodegas" => "Grandes Depositos, Bodegas Industriales", 
            "industrias" => "Industrias",
            "planta_revision_tecnica" => "Linea de Revisión - Planta Revision Técnica",
            "talleres" => "Talleres",
        ];

        return $subproyecto;
    }


    public static function escalas($subproyecto_key)
    {
        $escalas = [
            'grandes_depositos_bodegas' => NULL,
            'industrias' => NULL,
            'planta_revision_tecnica' => NULL,
            'talleres' => NULL,
        ];

        return $escalas[$subproyecto_key];

    }
    
    public static function tipoCalculo($subproyecto_key)
    {
        $calculos = [
            "grandes_depositos_bodegas" => "superficie",
            "industrias" => "superficie",
            "planta_revision_tecnica" => "cantidad",
            "talleres" => "superficie",
        ];

        return $calculos[$subproyecto_key];
    }

    public static function labelIngreso($subproyecto_key)
    {
        $labels = [
            "grandes_depositos_bodegas" => "Superficie Total (M2)",
            "industrias" => "Superficie Total (M2)",
            "planta_revision_tecnica" => "Cantidad Lineas Revisión",
            "talleres" => "Superficie Total (M2)",
        ];

        return $labels[$subproyecto_key];
    }

}
