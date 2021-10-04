<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuncionesCalculos;




class HomeController extends Controller
{
    public function index()
    {
        if(\Auth::user()){
            
            if(\Auth::user()->profile == "admin"){
            
                return redirect()->route('admin.index');
            }
            
            if(\Auth::user()->profile == "normal"){
    
                return redirect()->route('normal.index');
                
            }
        }else{
            return view('inicio');
        }

    }

}

