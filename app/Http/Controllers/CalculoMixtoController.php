<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\FuncionesCalculos;

class CalculoMixtoController extends Controller
{
    public function guardar(Request $request)
    {
        $mixto = [];
        
        $proyecto = $request->proyecto;
        $datos_calculo = $request->datos_calculo;
        $sumatoria = json_decode($request->sumatoria);

        Session::push('calculo_mixto.proyectos', $proyecto);
        Session::push('calculo_mixto.datos_calculo', $datos_calculo);
        Session::push('calculo_mixto.sumatoria', $sumatoria);

        return redirect()->route('inicio');
    }

    public function calcular()
    {
        $sumatoria_final = FuncionesCalculos::sum_flujos_mixto(Session::get('calculo_mixto.sumatoria'));
        $maximo_t_privado = FuncionesCalculos::buscar_mayor_columna($sumatoria_final,"transporte_privado");
        $maximo_t_otros = FuncionesCalculos::busca_mayor_otras_columnas($sumatoria_final); 
        $suma_otros = FuncionesCalculos::sumar_columnas_otros($sumatoria_final);

        return view('mixto.index')
             ->with('suma_otros', $suma_otros)
            ->with('sumatoria', $sumatoria_final)
            ->with('proyectos', Session::get('calculo_mixto.proyectos'))
            ->with('datos', Session::get('calculo_mixto.datos_calculo'))
            ->with('max_t_privado', $maximo_t_privado)
            ->with('max_t_otros', $maximo_t_otros)
            ->with('imiv_t_privado', FuncionesCalculos::categoria_imiv_t_privado($maximo_t_privado))
            ->with('imiv_t_otros', FuncionesCalculos::categoria_imiv_t_otros($maximo_t_otros));
    }

    public function borrar()
    {
        Session::forget('calculo_mixto.proyectos');
        Session::forget('calculo_mixto.datos_calculo');
        Session::forget('calculo_mixto.sumatoria');

        return redirect()->route('inicio');
    }


    
}
