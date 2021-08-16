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
    
    public static function sum_flujos($flujos)
    {
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

    public static function sum_flujos_mixto($flujos)
    {
        $final = array();
        foreach ($flujos as $key1 => $values) {
            if($key1 == 0){
                foreach ($values as $key2 => $val) {    
                    $final[$key2]["transporte_privado"] = $val->transporte_privado;
                    $final[$key2]["transporte_publico"] = $val->transporte_publico;
                    $final[$key2]["peatones_viajes"] = $val->peatones_viajes;
                    $final[$key2]["ciclos_viajes"] = $val->ciclos_viajes;  
                }
            }else{
                foreach ($values as $key2 => $val) {    
                    $final[$key2]["transporte_privado"] = $final[$key2]["transporte_privado"] + $val->transporte_privado;
                    $final[$key2]["transporte_publico"] = $final[$key2]["transporte_publico"] + $val->transporte_publico;
                    $final[$key2]["peatones_viajes"] = $final[$key2]["peatones_viajes"] + $val->peatones_viajes;
                    $final[$key2]["ciclos_viajes"] = $final[$key2]["ciclos_viajes"] + $val->ciclos_viajes;  
                }
            }
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
        $sumas = FuncionesCalculos::sumar_columnas_otros($array);
        //$mayor_t_publico = FuncionesCalculos::buscar_mayor_columna($array,"transporte_publico");
        //$mayor_peatones = FuncionesCalculos::buscar_mayor_columna($array,"peatones_viajes");
        //$mayor_ciclos = FuncionesCalculos::buscar_mayor_columna($array,"ciclos_viajes");
        //$mayores = array($mayor_t_publico,$mayor_peatones, $mayor_ciclos);   
        return max ($sumas);
    }

    public static function sumar_columnas_otros($array)
    {
        $result_sum = array();
        foreach ($array as $key => $value) {
            array_push($result_sum, $value["transporte_publico"]+$value["peatones_viajes"]+$value["ciclos_viajes"]);
        }
        return $result_sum;
    }
    
    public static function categoria_imiv_t_privado($n_viajes)
    {
        if($n_viajes < 20){
            return [
                "imiv" => "No requiere estudio",
                "cruces" => "2 en total",
                "n_cruces" => "2t"
            ];
        }
        if($n_viajes >= 20 && $n_viajes <= 80){
            return [
                "imiv" => "Básico",
                "cruces" => "2 en total",
                "n_cruces" => "2t"
            ];
        }
        if($n_viajes > 80 && $n_viajes <= 120){
            return [
                "imiv" => "Intermedio",
                "cruces" => "2 por ruta",
                "n_cruces" => 2
            ];
        }
        if($n_viajes > 120 && $n_viajes <= 180){
            return [
                "imiv" => "Intermedio",
                "cruces" => "3 por ruta",
                "n_cruces" => 3
            ];
        }
        if($n_viajes > 180 && $n_viajes <= 250){
            return [
                "imiv" => "Intermedio",
                "cruces" => "4 por ruta",
                "n_cruces" => 4
            ];
        }
        if($n_viajes > 250 && $n_viajes <= 400){
            return [
                "imiv" => "Mayor",
                "cruces" => "5 por ruta",
                "n_cruces" => 5
            ];
        }
        if($n_viajes > 400 && $n_viajes <= 550){
            return [
                "imiv" => "Mayor",
                "cruces" => "6 por ruta",
                "n_cruces" => 6
            ];
        }
        if($n_viajes > 550 && $n_viajes <= 750){
            return [
                "imiv" => "Mayor",
                "cruces" => "7 por ruta",
                "n_cruces" => 7
            ];
        }
        if($n_viajes > 750 && $n_viajes <= 1000){
            return [
                "imiv" => "Mayor",
                "cruces" => "8 por ruta",
                "n_cruces" => 8
            ];
        }
        if($n_viajes > 1000){
            return [
                "imiv" => "Mayor",
                "cruces" => "Consultar a info@gysingenieria.cl (administrador)",
                "n_cruces" => "n"
            ];
        }
    
    }
    
    public static function categoria_imiv_t_otros($n_viajes)
    {
        if($n_viajes < 40){
            return [
                "imiv" => "No requiere estudio",
                "cruces" => "2 en total",
                "n_cruces" => "2t"
            ];
        }
        if($n_viajes >= 40 && $n_viajes <= 160){
            return [
                "imiv" => "Básico",
                "cruces" => "2 en total",
                "n_cruces" => "2t"
            ];
        }
        if($n_viajes > 160 && $n_viajes <= 500){
            return [
                "imiv" => "Intermedio",
                "cruces" => "3 por ruta",
                "n_cruces" => 3
            ];
        }
        if($n_viajes > 500 && $n_viajes <= 2000){
            return [
                "imiv" => "Mayor",
                "cruces" => "6 por ruta",
                "n_cruces" => 6
            ];
        }
        if($n_viajes > 2000){
            return [
                "imiv" => "Mayor",
                "cruces" => "8 por ruta",
                "n_cruces" => 8
            ];
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

    public static function cargaOcupacion($sup_util_vivienda)
    {
        if ($sup_util_vivienda <= 60) {
            return 15;
        }elseif($sup_util_vivienda > 60 && $sup_util_vivienda <= 140){
            return 20;
        }elseif($sup_util_vivienda > 140){
            return 30;
        }
    }
    
    public static function comparaIMIVCruces($imiv_t_privado, $imiv_t_otros)
    {
        switch ($imiv_t_privado['imiv']) {
            case 'No requiere estudio':
                if($imiv_t_otros['imiv'] == "Intermedio" || $imiv_t_otros['imiv'] == "Mayor" ){
                    return $imiv_t_otros;
                }
                if($imiv_t_otros['imiv'] == "No requiere estudio" ){
                    return $imiv_t_privado;
                }
                if($imiv_t_otros['imiv'] == "Básico" ){
                    return $imiv_t_otros;
                }
                break;
            case 'Básico':
                if($imiv_t_otros['imiv'] == "Intermedio" || $imiv_t_otros['imiv'] == "Mayor" ){
                    return $imiv_t_otros;
                }
                if($imiv_t_otros['imiv'] == "No requiere estudio" ){
                    return $imiv_t_privado;
                }
                if($imiv_t_otros['imiv'] == "Básico" ){
                    return $imiv_t_privado;
                }
                break;
            case 'Intermedio':
                if($imiv_t_otros['imiv'] == "No requiere estudio" || $imiv_t_otros['imiv'] == "Básico" ){
                    return $imiv_t_privado;
                }
                if($imiv_t_otros['imiv'] == "Intermedio" ){
                    if($imiv_t_otros['n_cruces'] > $imiv_t_privado['n_cruces'] ){
                        return $imiv_t_otros;
                    }else{
                        return $imiv_t_privado;
                    }
                }
                if($imiv_t_otros['imiv'] == "Mayor" ){
                    return $imiv_t_otros;
                }
                break;
            case 'Mayor':
                if($imiv_t_otros['imiv'] == "No requiere estudio" || $imiv_t_otros['imiv'] == "Básico" ){
                    return $imiv_t_privado;
                }
                if($imiv_t_otros['imiv'] == "Mayor" ){
                    if($imiv_t_privado['n_cruces'] == 'n'){
                        return $imiv_t_privado;
                    }
                    if($imiv_t_otros['n_cruces'] > $imiv_t_privado['n_cruces'] ){
                        return $imiv_t_otros;
                    }else{
                        return $imiv_t_privado;
                    }
                }
                if($imiv_t_otros['imiv'] == "Intermedio" ){
                    return $imiv_t_privado;
                }
                break;
            
            default:
                return $imiv_t_privado;
                break;
        }
    }
}
