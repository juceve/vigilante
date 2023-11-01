<?php

namespace App\Http\Livewire\Admin;

use App\Models\Registroguardia;
use Livewire\Component;

class Regactividad extends Component
{
    public $prioridad = "", $fechahora = "", $user = "", $visto = "", $detalle = "", $imagenes = null;

    public $fechaI = "", $fechaF = "", $actividades = null;

    public function mount()
    {
        $this->fechaI = date('Y-m-d');
        $this->fechaF = date('Y-m-d');
        $this->buscar();
    }

    public function render()
    {

        $this->emit('dataTableRender');
        return view('livewire.admin.regactividad')->extends('adminlte::page');
    }

    public function buscar(){
        $this->actividades = Registroguardia::whereDate('fechahora', '>=', $this->fechaI)
            ->whereDate('fechahora', '<=', $this->fechaF)
            ->get();
    }

    public function cargaMensaje($id)
    {
        $registro = Registroguardia::find($id);
        $this->reset('imagenes');
        $this->imagenes = $registro->imgregistros;
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
