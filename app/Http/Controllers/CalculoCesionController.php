<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculoCesionController extends Controller
{
    public function index()
    {
        return view('cesion.index');
    }

    public function calculo(Request $request)
    {
        $resultado_do = ($request->carga_ocupacion * 10000) / $request->sup_bruta_terreno;
        $resultado_cesion = ($resultado_do*11) / 2000;
        return view('cesion.resultado')
            ->with('resultado_do',$resultado_do)
            ->with('resultado_cesion',$resultado_cesion);
    }
}
