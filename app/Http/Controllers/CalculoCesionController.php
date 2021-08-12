<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuncionesCalculos;
class CalculoCesionController extends Controller
{
    public function index()
    {
        return view('cesion.index');
    }

    public function calculo(Request $request)
    {
        //$sup_vivienda = $request->sup_vivienda;
        $sup_bruta = $request->sup_bruta_terreno;
        //$ocupantes = $sup_vivienda / FuncionesCalculos::cargaOcupacion($sup_vivienda);

        $resultado_do = ($request->carga_ocupacion * 10000)/$sup_bruta;
        $p_cesion = ($resultado_do *11)/2000;

        $cesion_m2 = "-";
        $aporte_cesion_clp = "-";
        $sup_neta_terreno = "-";
        $avaluo_terreno_propio = "-";

        if($request->avaluo_terreno_propio){
            
            $aporte_cesion_clp = $request->avaluo_terreno_propio * ($p_cesion/100);
            $avaluo_terreno_propio = $request->avaluo_terreno_propio;
        }
        
        if($request->sup_neta_terreno){
            $cesion_m2 = $request->sup_neta_terreno * ($p_cesion/100);
            $sup_neta_terreno = $request->sup_neta_terreno;
        }

        return view('cesion.resultado')
            ->with('carga_ocupacion',$request->carga_ocupacion)
            ->with('sup_neta_terreno',$sup_neta_terreno)    
            ->with('sup_bruta_terreno',$sup_bruta)
            ->with('avaluo_terreno_propio',$avaluo_terreno_propio)
            ->with('cesion_m2',$cesion_m2)
            ->with('aporte_cesion_clp',$aporte_cesion_clp)    
            ->with('resultado_do',$resultado_do)
            ->with('resultado_cesion',$p_cesion);
    }
}
