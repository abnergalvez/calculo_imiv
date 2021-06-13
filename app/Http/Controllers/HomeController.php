<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuncionesCalculos;




class HomeController extends Controller
{
    public function index()
    {
        
        return view('inicio')
            ->with('proyectos', FuncionesCalculos::fullProyectos());
    }

}

