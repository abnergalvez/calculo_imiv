<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    public static function subproyectos()
    {
        $subproyecto = [
            "junta_vecinal_club_social_otros" => "Sede Junta Vecinal, Club Social, Otro Equipamiento Act. Comunitarias", 
        ];

        return $subproyecto;
    }


    public static function escalas($subproyecto_key)
    {
        $escalas = [
            'junta_vecinal_club_social_otros' => NULL,
        ];

        return $escalas[$subproyecto_key];

    }
    
    public static function tipoCalculo($subproyecto_key)
    {
        $calculos = [
            "junta_vecinal_club_social_otros" => "superficie", 
        ];

        return $calculos[$subproyecto_key];
    }

}
