<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CasasDepartamentos extends Component
{
    public $items = [];

    public function render()
    {
        return view('livewire.casas-departamentos');
    }

    public function add() {
        if(count($this->items) > 3) {
             return;
        } 
        // array_push($this->count, count($this->count)+1);
        $this->items[] = count($this->items);
    }

    public function remove($index) {
        unset($this->items[$index]);
    }
}
