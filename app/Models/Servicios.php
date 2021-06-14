<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory;

    public static function subproyectos()
    {
        $subproyecto = [
            "centros_medicos_o_dentales" => "Centros Médicos o Dentales", 
            "edificios_playas_estacionamiento" => "Edificios o playas de estacionamiento",
            "oficina_servicios" => "Oficina de servicios, públicos o privados",
            "servicios_artesanales_y_reparacion" => "Servicios artesanales y de reparacion de objetos diversos",
        ];

        return $subproyecto;
    }


    public static function escalas($subproyecto_key)
    {
        $escalas = [
            "centros_medicos_o_dentales" => NULL, 
            "edificios_playas_estacionamiento" => NULL,
            "oficina_servicios" => NULL,
            "servicios_artesanales_y_reparacion" => NULL,
        ];
        return $escalas[$subproyecto_key];
    }
    
    public static function tipoCalculo($subproyecto_key)
    {
        $calculos = [
            "centros_medicos_o_dentales" => "superficie", 
            "edificios_playas_estacionamiento" => "cantidad",
            "oficina_servicios" => "superficie",
            "servicios_artesanales_y_reparacion" => "superficie",
        ];

        return $calculos[$subproyecto_key];
    }

    public static function labelIngreso($subproyecto_key)
    {
        $labels = [
            "centros_medicos_o_dentales" => "Superficie Total (M2)", 
            "edificios_playas_estacionamiento" => "Numero Total Estacionamientos",
            "oficina_servicios" => "Superficie Total (M2)",
            "servicios_artesanales_y_reparacion" => "Superficie Total (M2)",
        ];

        return $labels[$subproyecto_key];
    }
}
