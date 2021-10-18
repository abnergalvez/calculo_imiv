<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuncionesCalculos;

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

class CalculoController extends Controller
{
    //MIXTO
    //CASAS DEPARTAMENTOS
    //OTROS PROYECTOS


    public function calculo(Request $request)
    {

        if($request->proyecto == "departamentos" || $request->proyecto == "casas"){
           
            

        }else{

        
            $dir_escala = $request->proyecto."/".$request->subproyecto."/".$request->escala;
            $dir_subproyecto = $request->proyecto."/".$request->subproyecto;
            $tipoCalculo = $request->modelo::tipoCalculo($request->subproyecto);

            if($request->escala){
                $items_entrada = json_decode( stripslashes(file_get_contents("tasas/".$dir_escala."/entradas.json")) , true);
                $items_salida = json_decode( stripslashes(file_get_contents("tasas/".$dir_escala."/salidas.json")) , true);
            }else{
                $items_entrada = json_decode( stripslashes(file_get_contents("tasas/".$dir_subproyecto."/entradas.json")) , true);
                $items_salida = json_decode( stripslashes(file_get_contents("tasas/".$dir_subproyecto."/salidas.json")) , true);
            }

            if($tipoCalculo == 'superficie')
            {
                $entrada_resultado = $this->calcular_cada100($items_entrada,$request->superficie);
                $salida_resultado = $this->calcular_cada100($items_salida,$request->superficie);
            
            }

            if($tipoCalculo == 'cantidad')
            {
                $entrada_resultado = $this->calcular_unitario($items_entrada,$request->cantidad);
                $salida_resultado = $this->calcular_unitario($items_salida,$request->cantidad);
            }
            $sumatoria = FuncionesCalculos::sum_total_otros_flujos($entrada_resultado,$salida_resultado);
            $maximo_t_privado = floor(FuncionesCalculos::buscar_mayor_columna($sumatoria,"transporte_privado"));
            $maximo_t_otros = floor(FuncionesCalculos::busca_mayor_otras_columnas($sumatoria)); 

            // datos en texto calculo 
            $escala_text = $request->escala ? ' - Escala: '.$request->escala : '';
            $tex1 = substr($request->modelo::subproyectos()[$request->subproyecto],0,35).''.$escala_text;
            
            if($request->superficie){
                $text2 = ' calculo total con '.$request->superficie.' M2 de superficie';
            }else{
                $text2 = ' calculo para '.$request->cantidad.' de '.$request->modelo::labelIngreso($request->subproyecto);
            }
            $datos_text = $tex1.' |'.$text2;
            // datos en texto calculo 
            $suma_otros = FuncionesCalculos::sumar_columnas_otros($sumatoria);
            $imiv_t_privado =  FuncionesCalculos::categoria_imiv_t_privado($maximo_t_privado);
            $imiv_t_otros =  FuncionesCalculos::categoria_imiv_t_otros($maximo_t_otros);
            $datos_comparacion = FuncionesCalculos::comparaIMIVCruces($imiv_t_privado, $imiv_t_otros);
            
            return view('otros_proyectos.index')
                ->with('datos_comparacion', $datos_comparacion)
                ->with('suma_otros', $suma_otros)
                ->with('datos_calculo', $datos_text)
                ->with('sumatoria', $sumatoria)
                ->with('calculo', $tipoCalculo)
                ->with('resultado_entradas', $entrada_resultado)
                ->with('resultado_salidas', $salida_resultado)
                ->with('superficie', $tipoCalculo == 'superficie' ? $request->superficie : 0 )
                ->with('cantidad', $tipoCalculo == 'cantidad' ? $request->cantidad : 0 )
                ->with('max_t_privado',$maximo_t_privado)
                ->with('max_t_otros', $maximo_t_otros)
                ->with('imiv_t_privado',$imiv_t_privado)
                ->with('imiv_t_otros',$imiv_t_otros)
                ->with('proyecto',$request->proyecto)
                ->with('modelo', FuncionesCalculos::fullProyectos()[$request->proyecto]['modelo'] )
                ->with('subproyecto_key', $request->subproyecto)
                ->with('subproyecto', $request->modelo::subproyectos()[$request->subproyecto])
                ->with('escala', $request->escala ? $request->modelo::escalas($request->subproyecto)[$request->escala] : '' )
                ->with('tipo', 'otros');
        }
    }



    public function calcular_unitario($items,$cantidad)
    {
        foreach ($items as $key => $value) {
            
            $resultado[$key]["transporte_privado"] = $value["transporte_privado"]  * $cantidad;
            $resultado[$key]["transporte_publico"] = $value["transporte_publico"] * $cantidad;
            $resultado[$key]["peatones_viajes"] = $value["peatones_viajes"] * $cantidad;
            $resultado[$key]["ciclos_viajes"] = $value["ciclos_viajes"]  * $cantidad;
        }    
        return $resultado;
    }


    public  function calcular_cada100($items,$superficie)
    {
        $indice_sup = $superficie/100;
        foreach ($items as $key => $value) {
            
            $resultado[$key]["transporte_privado"] = $value["transporte_privado"]  * $indice_sup;
            $resultado[$key]["transporte_publico"] = $value["transporte_publico"] * $indice_sup;
            $resultado[$key]["peatones_viajes"] = $value["peatones_viajes"] * $indice_sup;
            $resultado[$key]["ciclos_viajes"] = $value["ciclos_viajes"]  * $indice_sup;
        }   
        return $resultado;
    }
}
