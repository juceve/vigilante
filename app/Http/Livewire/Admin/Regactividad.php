<?php

namespace App\Http\Livewire\Admin;

use App\Models\Registroguardia;
use Livewire\Component;

class Regactividad extends Component
{
    public $prioridad = "", $fechahora = "", $user = "", $visto = "", $detalle = "";

    public function render()
    {
        $actividades = Registroguardia::all();
        $this->emit('dataTableRender');
        return view('livewire.admin.regactividad', compact('actividades'))->extends('adminlte::page');
    }

    public function cargaMensaje($id)
    {
        $registro = Registroguardia::find($id);
        $this->prioridad = $registro->prioridad;
        $this->fechahora = $registro->fechahora;
        $this->user = $registro->user->name;
        if ($registro->visto) {
            $this->visto = 'Revisado';
        } else {
            $this->visto = 'Sin Revisar';
        
        }
        $this->detalle = $registro->detalle;
        $this->prioridad = $registro->prioridad;
        $registro->visto = true;
        $registro->save();

    }
}
