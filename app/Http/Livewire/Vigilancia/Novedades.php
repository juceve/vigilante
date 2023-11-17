<?php

namespace App\Http\Livewire\Vigilancia;

use App\Models\Imgnovedade;
use App\Models\Novedade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Novedades extends Component
{
    use WithFileUploads;

    public $files = [], $lat = "", $lng = "";
    public $designacion, $informe="";

    public function mount($designacion){
        $this->designacion = $designacion;
    }

    public function render()
    {        
        return view('livewire.vigilancia.novedades')->extends('layouts.app');
    }
    protected $listeners = ['ubicacionAprox'];

    public function enviar()
    {
        DB::beginTransaction();
        try {
            $registro = Novedade::create([
                "designacione_id" => $this->designacion,
                "fecha" => date('Y-m-d'),
                "hora" => date('H:i'),
                "contenido" => $this->informe,
                "lat" => $this->lat,
                "lng" => $this->lng,
            ]);

            $x = 1;
            foreach ($this->files as $key => $file) {
                $arrF = explode('.', $file->getFilename());
                $name = date('YmdHis') . $x;

                $x++;
                $path = $file->storeAs('images/registros/novedades', $name . '.' . $arrF[1]);

                $imgreg = Imgnovedade::create([
                    "novedade_id" => $registro->id,
                    "url" => $path,
                    "tipo" => $arrF[1],
                ]);
            }
            DB::commit();

            return redirect()->route('home')->with('success', 'Registro guardado correctamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // return redirect()->route('home')->with('error', 'Ha ocurrido un error');
            $this->emit('error', $th->getMessage());
        }
    }

    public function ubicacionAprox($data)
    {
        $this->lat = $data[0];
        $this->lng = $data[1];
        // dd($this->lat);
        // dd($data);
    }
}
