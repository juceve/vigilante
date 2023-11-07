<?php

namespace App\Http\Livewire\Admin;

use App\Models\Designacione;
use App\Models\Marcacione;
use Livewire\Component;

class Marcaciones extends Component
{
    public $designacione_id, $fecha = "", $hora = "", $lat = "", $lng = "";
    public $marcado = null;

    public function render()
    {
        $designacione = Designacione::find($this->designacione_id);
        $marcaciones = tablaMarcaciones($designacione->id);
        // dd($marcaciones);
        return view('livewire.admin.marcaciones', compact('designacione', 'marcaciones'));
    }

    public function cargar($marcacione_id)
    {
        $this->reset(['marcado', 'lat', 'fecha', 'hora', 'lng']);
        $this->marcado = Marcacione::find($marcacione_id);
        $this->fecha = $this->marcado->fecha;
        $this->hora = $this->marcado->hora;
        $this->lat = $this->marcado->lat;
        $this->lng = $this->marcado->lng;
      
    }
}
