<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cliente;
use App\Models\Turno;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TurnoCliente extends Component
{
    public $cliente_id = null;
    public $nombre = "", $horainicio = "", $horafin = "";

    public function mount($cliente_id)
    {
        $this->cliente_id = $cliente_id;
    }

    public function render()
    {
        $cliente = Cliente::find($this->cliente_id);
        $turnos = Turno::where('cliente_id', $this->cliente_id)->get();
        return view('livewire.admin.turno-cliente', compact('cliente', 'turnos'))->with('i', 1)->extends('adminlte::page');
    }

    protected $rules = [
        'nombre' => 'required',
        'horainicio' => 'required',
        'horafin' => 'required',
    ];

    protected $listeners = ['delete'];

    public function registrarTurno()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $turno = Turno::create([
                "nombre" => $this->nombre,
                "horainicio" => $this->horainicio,
                "horafin" => $this->horafin,
                "cliente_id" => $this->cliente_id
            ]);

            DB::commit();
            $this->reset(['nombre', 'horainicio', 'horafin']);
            $this->emit('success', 'Turno registrado correctamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('error', 'Ha ocurrido un error.');
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $turno = Turno::find($id)->delete();
            DB::commit();
            $this->emit('success', 'Eliminado correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('error', 'Ha ocurrido un error');
        }
    }
}
