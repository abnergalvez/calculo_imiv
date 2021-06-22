<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Session;

class ProyectosMixto extends Component
{
    
    public $proyectos_mixtos = [];
    
    public function render()
    {   
        return view('livewire.proyectos-mixto');
    }

    public function mount()
    {
        $this->proyectos_mixtos = request()->session()->get('calculo_mixto');
    }

    public function remove($key) 
    {

        session()->pull('calculo_mixto.proyectos.'.$key);
        session()->pull('calculo_mixto.datos_calculo.'.$key);
        session()->pull('calculo_mixto.sumatoria.'.$key);
        if(empty(session()->get('calculo_mixto'))){
            session()->forget('calculo_mixto');
        }else{
            $this->proyectos_mixtos = session()->get('calculo_mixto');
        }
        
    }

}
