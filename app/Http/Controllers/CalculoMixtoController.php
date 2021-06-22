<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

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
}
