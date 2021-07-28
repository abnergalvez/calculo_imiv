<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\FuncionesCalculos;

class EmailController extends Controller
{
    public function enviarResultados(Request $request)
    {
        $sumatoria = json_decode($request->sumatoria);
        dd($request->proyecto);
    }
}
