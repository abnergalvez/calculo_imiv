<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuncionesCalculos;
use App\Models\Casas;



class CalculoCasasController extends Controller
{
    public function calculo(Request $request)
    {
        $entrada_resultado = [];
        $salida_resultado = [];
    
        foreach ($request->superficies as $key => $value) {
            
            $value = $value/$request->cantidades[$key];
            $rango = FuncionesCalculos::superficie_rango($value);
            
            switch ($rango) {
                case '1_50':
                    $PTL_entrada = 1;
                    $PML_salida = 1;
                    $items_entrada = json_decode( stripslashes(file_get_contents("tasas/casas/entrada/0-50.json")) , true);
                    $items_salida = json_decode( stripslashes(file_get_contents("tasas/casas/salida/0-50.json")) , true);
                    break;

                case '51_60':
                    $PTL_entrada = 1+(0.02*($value-50));
                    $PML_salida = 1+(0.02*($value-50));
                    $items_entrada = json_decode( stripslashes(file_get_contents("tasas/casas/entrada/50-60.json")) , true);
                    $items_salida = json_decode( stripslashes(file_get_contents("tasas/casas/salida/50-60.json")) , true);
                    break;

                case '61_140':
                    $PTL_entrada = 1.2+(0.01*($value-60));
                    $PML_salida = 1.2+(0.01*($value-60));
                    $items_entrada = json_decode( stripslashes(file_get_contents("tasas/casas/entrada/60-140.json")) , true);
                    $items_salida = json_decode( stripslashes(file_get_contents("tasas/casas/salida/60-140.json")) , true);
                    break;

                case '141_280':
                    $PTL_entrada = 2+(0.005*($value-140));
                    $PML_salida = 2+(0.005*($value-140));
                    $items_entrada = json_decode( stripslashes(file_get_contents("tasas/casas/entrada/140-280.json")) , true);
                    $items_salida = json_decode( stripslashes(file_get_contents("tasas/casas/salida/140-280.json")) , true);
                    break;

                case '281_n':
                    $PTL_entrada = 1;
                    $PML_salida = 1;
                    $items_entrada = json_decode( stripslashes(file_get_contents("tasas/casas/entrada/280-n.json")) , true);
                    $items_salida = json_decode( stripslashes(file_get_contents("tasas/casas/salida/280-n.json")) , true);
                    break;
            }
            
            $entrada_resultado[$key] = Casas::entradas($PTL_entrada,$items_entrada,$rango,$request->cantidades[$key]);
            $salida_resultado[$key] = Casas::salidas($PML_salida,$items_salida,$rango,$request->cantidades[$key]);
    
        }
        // datos en texto calculo        
        $text1 = '';
        foreach($request->superficies as $key => $value){
            $text1 = $text1.' '.$request->cantidades[$key].'(Cantidad) , Total de '.$value.'M2  (Sup.) '; 
        }
        $datos_text = ' '.$text1;
        // datos en texto calculo 

        $sum_entradas = FuncionesCalculos::sum_flujos($entrada_resultado);
        $sum_salidas = FuncionesCalculos::sum_flujos($salida_resultado);
        $sumatoria = FuncionesCalculos::sum_total_flujos($sum_entradas,$sum_salidas);
        $maximo_t_privado = floor(FuncionesCalculos::buscar_mayor_columna($sumatoria,"transporte_privado"));
        $maximo_t_otros = floor(FuncionesCalculos::busca_mayor_otras_columnas($sumatoria)); 
        $suma_otros = FuncionesCalculos::sumar_columnas_otros($sumatoria);
        $imiv_t_privado= FuncionesCalculos::categoria_imiv_t_privado($maximo_t_privado);
        $imiv_t_otros = FuncionesCalculos::categoria_imiv_t_otros($maximo_t_otros);
        $datos_comparacion = FuncionesCalculos::comparaIMIVCruces($imiv_t_privado, $imiv_t_otros);
        

        return view('casas_y_departamentos.index')
            ->with('datos_comparacion', $datos_comparacion)
            ->with('datos_calculo', $datos_text)
            ->with('resultado_entradas',$sum_entradas)
            ->with('resultado_salidas',$sum_salidas)
            ->with('sumatoria', $sumatoria)
            ->with('proyecto', $request->proyecto)
            ->with('cantidades', $request->cantidades)
            ->with('superficies', $request->superficies)
            ->with('max_t_privado', $maximo_t_privado)
            ->with('max_t_otros', $maximo_t_otros)
            ->with('suma_otros', $suma_otros)
            ->with('imiv_t_privado', $imiv_t_privado)
            ->with('imiv_t_otros', $imiv_t_otros)
            ->with('tipo', 'casas');
    }
    
}
