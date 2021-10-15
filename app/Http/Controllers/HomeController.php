<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuncionesCalculos;




class HomeController extends Controller
{
    public function index()
    {
        return view('inicio');
    }

    public function home()
    {
        if(\Auth::user()){
            
            if(\Auth::user()->profile == "admin"){
            
                return redirect()->route('admin.home');
            }
            
            if(\Auth::user()->profile == "normal"){
    
                return redirect()->route('normal.home');
                
            }
        }else{
            return view('inicio');
        }
    }

}

