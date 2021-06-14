<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Casas;
use App\Models\Departamentos;
use App\Models\HogaresAcogida;
use App\Models\Cientifico;
use App\Models\Comercio;
use App\Models\CultoCultura;
use App\Models\Deporte;
use App\Models\Educacion;
use App\Models\Esparcimiento;
use App\Models\Hospedaje;
use App\Models\Industrial;
use App\Models\Salud;
use App\Models\Servicios;
use App\Models\Social;

class FuncionesCalculos extends Model
{
    
    public static function sum_flujos($flujos){
        $final = array();
        foreach ($flujos as $key1 => $values) {
            if($key1 == 0){
                foreach ($values as $key2 => $val) {    
                    $final[$key2]["viajes_h_por_vivienda"] =  $val["viajes_h_por_vivienda"];
                    $final[$key2]["transporte_privado"] = $val["transporte_privado"]  ;
                    $final[$key2]["transporte_publico"] = $val["transporte_publico"];
                    $final[$key2]["peatones_viajes"] = $val["peatones_viajes"] ;
                    $final[$key2]["ciclos_viajes"] = $val["ciclos_viajes"];  
                }
            }else{
                foreach ($values as $key2 => $val) {    
                    $final[$key2]["viajes_h_por_vivienda"] = $final[$key2]["viajes_h_por_vivienda"] + $val["viajes_h_por_vivienda"];
                    $final[$key2]["transporte_privado"] = $final[$key2]["transporte_privado"] + $val["transporte_privado"]  ;
                    $final[$key2]["transporte_publico"] = $final[$key2]["transporte_publico"] + $val["transporte_publico"];
                    $final[$key2]["peatones_viajes"] = $final[$key2]["peatones_viajes"] + $val["peatones_viajes"] ;
                    $final[$key2]["ciclos_viajes"] = $final[$key2]["ciclos_viajes"] + $val["ciclos_viajes"];  
                }
            }
        }
        return $final;
    }
    
    
    
    public static function superficie_rango($superficie)
    {
        if($superficie <= 50){
            return '1_50';
        }elseif($superficie >= 51 && $superficie <= 60){
            return '51_60';
        }elseif($superficie >= 61 && $superficie <= 140){
            return '61_140';
        }elseif($superficie >= 141 && $superficie <= 280){
            return '141_280';
        }elseif($superficie >= 281){
            return '281_n';
        }
    }
    
    public static function sum_total_flujos($entradas,$salidas)
    {
        $final = array();    
        foreach ($entradas as $key => $val) {
            $final[$key]["viajes_h_por_vivienda"] =  $val["viajes_h_por_vivienda"] + $salidas[$key]["viajes_h_por_vivienda"];
            $final[$key]["transporte_privado"] = $val["transporte_privado"] + $salidas[$key]["transporte_privado"] ;
            $final[$key]["transporte_publico"] = $val["transporte_publico"] + $salidas[$key]["transporte_publico"];
            $final[$key]["peatones_viajes"] = $val["peatones_viajes"] + $salidas[$key]["peatones_viajes"];
            $final[$key]["ciclos_viajes"] = $val["ciclos_viajes"] + $salidas[$key]["ciclos_viajes"];    
        }
        return $final;
    }
    
    public static function sum_total_otros_flujos($entradas,$salidas)
    {
    
        $final = array();
        foreach ($entradas as $key => $val) {
            $final[$key]["transporte_privado"] = $val["transporte_privado"] + $salidas[$key]["transporte_privado"] ;
            $final[$key]["transporte_publico"] = $val["transporte_publico"] + $salidas[$key]["transporte_publico"];
            $final[$key]["peatones_viajes"] = $val["peatones_viajes"] + $salidas[$key]["peatones_viajes"];
             $final[$key]["ciclos_viajes"] = $val["ciclos_viajes"] + $salidas[$key]["ciclos_viajes"];  
        }
        return $final;
    }
    
    public static function buscar_mayor_columna($array,$nombre_columna)
    {
        $mayor = 0;
        foreach ($array as $key => $val) {
            if( $mayor == 0){
                $mayor = $val[$nombre_columna];    
            }elseif($mayor < $val[$nombre_columna]){
                $mayor = $val[$nombre_columna];
            }
        }
        return $mayor;
    }
    
    public static function busca_mayor_otras_columnas($array)
    {
        $mayor_t_publico = FuncionesCalculos::buscar_mayor_columna($array,"transporte_publico");
        $mayor_peatones = FuncionesCalculos::buscar_mayor_columna($array,"peatones_viajes");
        $mayor_ciclos = FuncionesCalculos::buscar_mayor_columna($array,"ciclos_viajes");
        $mayores = array($mayor_t_publico,$mayor_peatones, $mayor_ciclos);   
        return max ($mayores);
    }
    
    public static function categoria_imiv_t_privado($n_viajes)
    {
        if($n_viajes < 20){
            return "No requiere estudio";
        }
        if($n_viajes >= 20 && $n_viajes <= 80){
            return "Básico";
        }
        if($n_viajes > 80 && $n_viajes <= 250){
            return "Intermedio";
        }
        if($n_viajes > 250){
            return "Mayor";
        }
    
    }
    
    public static function categoria_imiv_t_otros($n_viajes)
    {
        if($n_viajes < 40){
            return "No requiere estudio";
        }
        if($n_viajes >= 40 && $n_viajes <= 160){
            return "Básico";
        }
        if($n_viajes > 160 && $n_viajes <= 500){
            return "Intermedio";
        }
        if($n_viajes > 500){
            return "Mayor";
        }
    }

    public static function fullProyectos()
    {
        $proyectos = [
            'casas' => ['label' => 'Casas','modelo' => Casas::class],
            'departamentos' => ['label' => 'Departamentos','modelo' => Departamentos::class],
            'hogares_acogida' => ['label' => 'Hogares de Acogida','modelo' => HogaresAcogida::class],
            'cientifico' => ['label' => 'Cientifico','modelo' => Cientifico::class],
            'comercio' => ['label' => 'Comercio','modelo' => Comercio::class],
            'culto_y_cultura' => ['label' => 'Culto y Cultura','modelo' => CultoCultura::class],
            'deporte' => ['label' => 'Deporte','modelo' => Deporte::class],
            'educacion' => ['label' => 'Educacion','modelo' => Educacion::class],
            'esparcimiento' => ['label' => 'Esparcimiento','modelo' => Esparcimiento::class],
            'hospedaje' => ['label' => 'Hospedaje','modelo' => Hospedaje::class],
            'industrial' => ['label' => 'Industrial','modelo' => Industrial::class],
            'salud' => ['label' => 'Salud','modelo' => Salud::class],
            'servicios' => ['label' => 'Servicios','modelo' => Servicios::class],
            'social' => ['label' => 'Social','modelo' => Social::class],
            ];

        return $proyectos;
    }
}
