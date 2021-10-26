<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuncionesCalculos;

use App\Models\Project;




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

    public function detailProject($code)
    {
        $codeDecript = base64_decode(strtr($code, '-_','+/='));
        
        //encript     strtr(base64_encode($p->code), '+/=', '-_'));
        
        return view('detail_project')
            ->with('project', Project::where('code', $codeDecript)->first());
    }

}

