<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProyectoSubproyectoEscala extends Component
{
    public $proyectos;
    public $subproyectos;
    public $escalas;

    public $modelo;
    public $formulario_normal;
    public $tipo_calculo;
    public $tipo_calculo_label;

    public $selectedProyectos = NULL;
    public $selectedSubproyectos = NULL;
    

    public function mount()
    {
        $this->subproyectos = NULL;
        $this->escalas = NULL;
        $this->modelo = '';
        $this->formulario_normal = false;
        $this->tipo_calculo = '';
        $this->tipo_calculo_label = '';
    }

    public function render()
    {
        return view('livewire.proyecto-subproyecto-escala');
    }

    public function updatedSelectedProyectos($proyecto)
    {
        $this->modelo =  $this->proyectos[$proyecto]['modelo'];
        $this->subproyectos = $this->modelo::subproyectos();
        $this->selectedSubproyectos = NULL;
        $this->formulario_normal = false;
    }

    public function updatedSelectedSubproyectos($subproyecto)
    {
        
        if(!is_null($subproyecto)){
            $this->formulario_normal = true;
            $this->tipo_calculo = $this->modelo::tipoCalculo($subproyecto);
            $this->tipo_calculo_label = $this->modelo::labelIngreso($subproyecto);
            $escalas = $this->modelo::escalas($subproyecto);
            if(!is_null($escalas)){
                $this->escalas = $escalas;
            }else{
                $this->escalas = NULL; 
            }
        }
    }

    public function updatedEscalas($escala)
    {
        
    }
}
