<?php

namespace App\Http\Livewire\Vigilancia;

use App\Models\Designacione;
use App\Models\Marcacione;
use Livewire\Component;

class MarcaIngreso extends Component
{
    public $lat = "", $lng = "", $designacione_id = "", $designacione=null;


    public function render()
    {
        $this->designacione = Designacione::find($this->designacione_id);
        return view('livewire.vigilancia.marca-ingreso');
    }

    protected $listeners = ['cargaPosicion'];

    public function marcar()
    {
        $marcado = Marcacione::create([
            'designacione_id' => $this->designacione_id,
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i'),
            'marcacion' => date('Y-m-d H:i:s'),
            'lat' => $this->lat,
            'lng' => $this->lng,
        ]);
        
        return redirect()->route('home');        
    }

    public function cargaPosicion($data)
    {
        $this->lat = $data[0];
        $this->lng = $data[1];
    }
}
