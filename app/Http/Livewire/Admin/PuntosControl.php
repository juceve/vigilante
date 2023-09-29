<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ctrlpunto;
use App\Models\Turno;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PuntosControl extends Component
{
    public $turno_id;
    public $nombre = "", $hora = "", $latitud = "", $longitud = "", $pnts="";

    public function mount($turno_id)
    {
        $this->turno_id = $turno_id;
    }

    protected $rules = [
        "nombre" => "required",
        "hora" => "required",
        "latitud" => "required",
        "longitud" => "required",
    ];

    protected $listeners = ['registrarPunto', 'delete'];

    public function render()
    {
        $puntos = Ctrlpunto::where('turno_id', $this->turno_id)->get();
        $turno = Turno::find($this->turno_id);
        $cliente = $turno->cliente;
        foreach ($puntos as $punto) {
            $fila = $punto->nombre."|".$punto->latitud."|".$punto->longitud;
            $this->pnts.=$fila."$";
        }
        $this->pnts = substr($this->pnts, 0, -1);
        
        return view('livewire.admin.puntos-control', compact('puntos', 'turno', 'cliente'))->with('i', 1)->extends('adminlte::page');
    }

    public function registrarPunto($data)
    {
        DB::beginTransaction();
        try {
            $punto = Ctrlpunto::create([
                "nombre" => $data[0],
                "hora" => $data[1],
                "latitud" => $data[2],
                "longitud" => $data[3],
                "turno_id" => $this->turno_id
            ]);

            DB::commit();
            $this->emit('success', 'Punto registrado correctamente');
        } catch (\Throwable $th) {

            DB::rollBack();
            $this->emit('error', 'Ha ocurrido un error');
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $punto = Ctrlpunto::find($id)->delete();
            DB::commit();
            redirect()->route('puntoscontrol',$this->turno_id)->with('success','Punto eliminado correctamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('error', 'Ha ocurrido un error');
        }
    }
}
