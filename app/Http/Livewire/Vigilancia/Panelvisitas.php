<?php

namespace App\Http\Livewire\Vigilancia;

use App\Models\Designacione;
use App\Models\Visita;
use Livewire\Component;

class Panelvisitas extends Component
{
    public $designacion, $cliente, $visitas;
    public function mount($designacion)
    {
        $this->designacion = Designacione::find($designacion);
        $this->cliente = $this->designacion->turno->cliente;
        $this->visitas = Visita::whereDate('created_at', date('Y-m-d'))->get();
    }

    public function render()
    {
        return view('livewire.vigilancia.panelvisitas')->extends('layouts.app');
    }
}
