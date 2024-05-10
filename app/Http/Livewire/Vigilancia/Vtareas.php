<?php

namespace App\Http\Livewire\Vigilancia;

use App\Models\Designacione;
use App\Models\Tarea;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Vtareas extends Component
{
    public  $designacion, $tareas, $search = '', $tarea;
    public $empleado;

    public function mount($designacion)
    {
        $this->designacion = Designacione::find($designacion);
        $this->empleado = $this->designacion->empleado;
        $this->tareas = Tarea::where([
            ["cliente_id", $this->designacion->turno->cliente_id],
            ["empleado_id", $this->designacion->empleado_id],
            ["fecha", date('Y-m-d')],
            ["estado", 1],
        ])->get();
    }

    public function render()
    {
        return view('livewire.vigilancia.vtareas')->extends('layouts.app');
    }

    public function cargarTarea($id)
    {
        $this->tarea = Tarea::find($id);
    }

    public function procesar()
    {
        DB::beginTransaction();

        try {
            $this->tarea->estado = false;
            $this->tarea->save();

            DB::commit();
            return redirect()->route('vigilancia.tareas', $this->designacion->id)->with('success', 'Tarea finalizada correctamentE.');
        } catch (\Throwable $th) {
            $this->emit('error', 'Ha ocurrido un error.');
        }
    }
}
