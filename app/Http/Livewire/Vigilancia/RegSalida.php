<?php

namespace App\Http\Livewire\Vigilancia;

use App\Models\Designacione;
use App\Models\Visita;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RegSalida extends Component
{
    public  $designacion, $visitas, $search = '', $visita;
    public $docidentidad = '', $nombrevisitante = '', $residente = '', $nrovivienda = '', $motivo = '', $otros = '', $observaciones = '', $created_at = '', $img = '';

    public function mount($designacion)
    {
        $this->designacion = Designacione::find($designacion);
        $this->visitas = Visita::where('estado', 1)->where('designacione_id', $this->designacion->id)->orderBy('id', 'DESC')->get();
    }

    public function updatedSearch()
    {
        $this->visitas = Visita::where([
            ['estado', 1],
            ['designacione_id', $this->designacion->id],
            ['nombre', 'LIKE', '%' . $this->search . '%'],
        ])
            ->orWhere([
                ['estado', 1],
                ['designacione_id', $this->designacion->id],
                ['docidentidad', 'LIKE', '%' . $this->search . '%'],

            ])
            ->orderBy('id', 'DESC')->get();
    }

    public function render()
    {
        return view('livewire.vigilancia.reg-salida')->extends('layouts.app');
    }

    public function cargarVisita($id)
    {
        $this->visita = Visita::find($id);
        $this->created_at = $this->visita->created_at;
        $this->docidentidad = $this->visita->docidentidad;
        $this->nombrevisitante = $this->visita->nombre;
        $this->residente = $this->visita->residente;
        $this->nrovivienda = $this->visita->nrovivienda;
        $this->motivo = $this->visita->motivo->nombre;
        $this->otros = $this->visita->otros;
        $this->img = $this->visita->imgs;
        $this->observaciones = $this->visita->observaciones;
    }

    public function reiniciar()
    {
        $this->reset([
            'docidentidad',
            'nombrevisitante',
            'residente',
            'nrovivienda',
            'motivo',
            'otros',
            'created_at',
            'img',
            'observaciones'
        ]);
    }

    public function marcarSalida()
    {
        DB::beginTransaction();
        try {
            $this->visita->observaciones = $this->observaciones;
            $this->visita->estado = 0;
            $this->visita->save();

            DB::commit();
            return redirect()->route('vigilancia.regsalida', $this->designacion->id)->with('success', 'Registro de Salida exitoso!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('vigilancia.regsalida', $this->designacion->id)->with('error', 'Ha ocurrido un error');
        }
    }
}
