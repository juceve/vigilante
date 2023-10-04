<?php

namespace App\Http\Livewire\Vigilancia;

use App\Models\Ctrlpunto;
use App\Models\Designacione;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Ronda extends Component
{
    public function render()
    {
        $empleado_id = Auth::user()->empleados[0]->id;
        $designacion = null;
        $puntos = null;
        $proxpunto = null;
        $cliente = null;
        if ($empleado_id) {
            $designacion = Designacione::where('fechaFin', '>=', date('Y-m-d'))->where('empleado_id', $empleado_id)->orderBy('fechaInicio', 'ASC')->first();
            if ($designacion) {
                $puntos = Ctrlpunto::where('turno_id', $designacion->turno_id)->orderBy('hora', 'ASC')->get();


                foreach ($puntos as $punto) {
                    if ($punto->hora >= date('H:i')) {
                        $proxpunto = $punto;
                        break;
                    }
                }
                $cliente = $designacion->turno->cliente;
            }
            
        }
        return view('livewire.vigilancia.ronda', compact('designacion', 'proxpunto', 'cliente'))->extends('layouts.app');
    }
}
