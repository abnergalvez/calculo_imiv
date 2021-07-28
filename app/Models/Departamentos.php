<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    
    public static function entradas($PTL_entrada,$items_entrada,$rango,$cantidad)
    {
        $factor_ap = 1.2;  //Auto Privado

        if($rango == '1_50' || $rango == '281_n'){  
            foreach ($items_entrada as $key => $value) {
            
                $resultado_entradas[$key]["viajes_h_por_vivienda"] = $value["viajes_h_por_vivienda"] * $cantidad;
                $resultado_entradas[$key]["transporte_privado"] = $value["transporte_privado"] * $factor_ap * $cantidad;
                $resultado_entradas[$key]["transporte_publico"] = $value["transporte_publico"] * $cantidad;
                $resultado_entradas[$key]["peatones_viajes"] = $value["peatones_viajes"] * $cantidad;
                $resultado_entradas[$key]["ciclos_viajes"] = $value["ciclos_viajes"] * $cantidad;
            }
        }else{
            $viajes_h_por_vivienda = [];
            foreach ($items_entrada as $key => $value) {
                $viajes_h_por_vivienda[$key] = $value["viajes_h_por_vivienda"]*$PTL_entrada;  
            }

            foreach ($items_entrada as $key => $value) {
            
                $resultado_entradas[$key]["viajes_h_por_vivienda"] = $viajes_h_por_vivienda[$key] * $cantidad;
                
                $resultado_entradas[$key]["transporte_privado"] = $value["transporte_privado"] * $viajes_h_por_vivienda[$key] * $factor_ap * $cantidad;
                $resultado_entradas[$key]["transporte_publico"] = $value["transporte_publico"] * $viajes_h_por_vivienda[$key] * $cantidad;
                $resultado_entradas[$key]["peatones_viajes"] = $value["peatones_viajes"] * $viajes_h_por_vivienda[$key] * $cantidad;
                $resultado_entradas[$key]["ciclos_viajes"] = $value["ciclos_viajes"] * $viajes_h_por_vivienda[$key] * $cantidad;
            }
        }
        return $resultado_entradas;
    }




    public static function salidas($PML_salida,$items_salida,$rango,$cantidad)
    {
        
        $factor_ap = 1.2;  //Auto Privado
        if($rango == '1_50' || $rango == '281_n'){  
            foreach ($items_salida as $key => $value) {
            
                $resultado_salidas[$key]["viajes_h_por_vivienda"] = $value["viajes_h_por_vivienda"] * $cantidad;
                $resultado_salidas[$key]["transporte_privado"] = $value["transporte_privado"] * $cantidad;
                $resultado_salidas[$key]["transporte_publico"] = $value["transporte_publico"] * $cantidad;
                $resultado_salidas[$key]["peatones_viajes"] = $value["peatones_viajes"] * $cantidad;
                $resultado_salidas[$key]["ciclos_viajes"] = $value["ciclos_viajes"] * $cantidad;
            }
        }else{
            $viajes_h_por_vivienda = [];
            foreach ($items_salida as $key => $value) {
                $viajes_h_por_vivienda[$key] = $value["viajes_h_por_vivienda"]*$PML_salida;  
            }

            foreach ($items_salida as $key => $value) {
            
                $resultado_salidas[$key]["viajes_h_por_vivienda"] = $viajes_h_por_vivienda[$key] * $cantidad;
                
                $resultado_salidas[$key]["transporte_privado"] = $value["transporte_privado"] * $viajes_h_por_vivienda[$key] * $factor_ap * $cantidad;
                $resultado_salidas[$key]["transporte_publico"] = $value["transporte_publico"] * $viajes_h_por_vivienda[$key] * $cantidad;
                $resultado_salidas[$key]["peatones_viajes"] = $value["peatones_viajes"] * $viajes_h_por_vivienda[$key] * $cantidad;
                $resultado_salidas[$key]["ciclos_viajes"] = $value["ciclos_viajes"] * $viajes_h_por_vivienda[$key] * $cantidad;
            }
        }
        return $resultado_salidas;
    }

}
