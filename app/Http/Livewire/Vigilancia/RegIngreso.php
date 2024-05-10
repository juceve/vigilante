<?php

namespace App\Http\Livewire\Vigilancia;

use App\Models\Designacione;
use App\Models\Motivo;
use App\Models\Visita;
use App\Models\Vwvisita;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Intervention\Image\ImageManagerStatic as Image;

class RegIngreso extends Component
{
    public $designacion, $motivos, $motivo;
    public $docidentidad, $nombrevisitante, $residente, $nrovivienda, $motivoid, $otros, $observaciones;
    public $photo, $filename;

    public function mount($designacion)
    {
        $this->motivo = new Motivo();
        $this->designacion = Designacione::find($designacion);
        $this->motivos = Motivo::all()->pluck('nombre', 'id');
    }

    public function render()
    {
        return view('livewire.vigilancia.reg-ingreso')->extends('layouts.app');
    }

    public function buscar()
    {
        $resultado = Vwvisita::where([
            ['docidentidad', $this->docidentidad],
            ['cliente_id', $this->designacion->turno->cliente_id],
        ])->orderBy('id', 'DESC')->first();
        if ($resultado) {
            $this->docidentidad = $resultado->docidentidad;
            $this->nombrevisitante = $resultado->visitante;
            $this->residente = $resultado->residente;
            $this->nrovivienda = $resultado->nrovivienda;
        } else {
            $this->nombrevisitante = "";
            $this->residente = "";
            $this->nrovivienda = "";
        }
    }

    public function updatedMotivoid()
    {
        $this->motivo = Motivo::find($this->motivoid);
        $this->otros = "";
    }

    protected $rules = [
        "docidentidad" => "required",
        "nombrevisitante" => "required",
        "motivoid" => "required",
    ];

    public function registrar()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $visita = Visita::create([
                "nombre" => $this->nombrevisitante,
                "docidentidad" => $this->docidentidad,
                "residente" => $this->residente,
                "nrovivienda" => $this->nrovivienda,
                "motivo_id" => $this->motivoid,
                "otros" => $this->otros,
                "observaciones" => $this->observaciones,
                "designacione_id" => $this->designacion->id,
                "estado" => true,
            ]);

            if ($this->filename) {

                if (Storage::disk('public')->exists("livewire-tmp/" . $this->filename)) {
                    Storage::disk('public')->move("livewire-tmp/" . $this->filename, "images/visitas/" . $visita->id . ".png");
                }

                $visita->imgs = "images/visitas/" . $visita->id . ".png";
                $visita->save();
            }
            DB::commit();
            return redirect()->route('vigilancia.regingreso', $this->designacion->id)->with('success', 'Visita registra con exito!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('vigilancia.regingreso', $this->designacion->id)->with('error', 'Ha ocurrido un error');
        }
    }

    public function cargaImagenBase64($imagebase64)
    {
        $imageData = explode(';base64,', $imagebase64);
        if (count($imageData) == 2) {
            $image = base64_decode($imageData[1]);
            $filename = uniqid() . date('Hms') . '.png';
            $this->filename = $filename;
            $path = storage_path('app/public/livewire-tmp/' . $filename);

            $img = Image::make($image)->save($path);
        }
    }
}
