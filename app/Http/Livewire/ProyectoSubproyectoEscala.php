<?php

namespace App\Http\Livewire;

use App\Models\FuncionesCalculos;
use Livewire\Component;

class ProyectoSubproyectoEscala extends Component
{
    public $proyectos = [];
    public $subproyectos = [];
    public $escalas = [];
    

    public $modelo = '' ;
    public $formulario_normal = false;
    public $tipo_calculo = '';
    public $tipo_calculo_label = '';

    public $proyecto_seleccionado = '';
    public $subproyecto_seleccionado = '';
    public $escala_seleccionada = '';
    public $casasDeptos = '';
    

    public function mount()
    {
        $this->proyectos = FuncionesCalculos::fullProyectos();
    }

    public function render()
    {
        return view('livewire.proyecto-subproyecto-escala');
    }

    public function updatedProyectoSeleccionado($proyecto)
    {
        if (empty($proyecto)) {
            $this->resetProyects();
        } else {
            if( $proyecto == "casas" || $proyecto == "departamentos" ){
                $this->emitTo('casas-departamentos', 'CasasDepartamentos');
                $this->casasDeptos = $proyecto;
                $this->subproyectos = NULL;
                $this->escalas = NULL;
                $this->formulario_normal = false;
                $this->modelo =  $this->proyectos[$proyecto]['modelo'];
            }else{
                $this->modelo =  $this->proyectos[$proyecto]['modelo'];
                $this->subproyectos = $this->modelo::subproyectos();
                //$this->selectedSubproyectos = NULL;
                $this->casasDeptos = '';
                $this->formulario_normal = false;
            }
        }
    }

    public function updatedSubproyectoSeleccionado($subproyecto)
    {
        if(empty($subproyecto)){
            $this->resetSubProyects();
        }else{
            $this->formulario_normal = true;
            $this->tipo_calculo = $this->modelo::tipoCalculo($subproyecto);
            $this->tipo_calculo_label = $this->modelo::labelIngreso($subproyecto);
            $escalas = $this->modelo::escalas($subproyecto);
            
            if(is_null($escalas)){
                $this->escalas = [];
            } else {
                $this->escalas = $escalas;
            }
        }
    }

    private function resetProyects() {
        $this->subproyectos = [];
        $this->escalas = [];

        $this->modelo = '';
        $this->formulario_normal = false;
        $this->tipo_calculo = '';
        $this->tipo_calculo_label = '';
        
        $this->subproyecto_seleccionado = '';
        $this->casasDeptos = '';
    }
    
    private function resetSubProyects() {
        $this->escalas = [];

        $this->formulario_normal = false;
        $this->tipo_calculo = '';
        $this->tipo_calculo_label = '';
        
        $this->casasDeptos = '';
    }
}
