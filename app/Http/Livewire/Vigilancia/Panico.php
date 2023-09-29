<?php

namespace App\Http\Livewire\Vigilancia;

use App\Models\Imgregistro;
use App\Models\Registroguardia;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Image;

class Panico extends Component
{
    use WithFileUploads;
    public $files = [], $informe = "", $conUbicacion = true;

    public function render()
    {
        return view('livewire.vigilancia.panico')->extends('layouts.app');
    }

    protected $listeners = ['guardarRegistro', 'registroPanico'];

    public function guardarRegistro($data)
    {
        if ($data) {
            DB::beginTransaction();
            try {
                $registro = Registroguardia::create([
                    "fechahora" => date('Y-m-d H:i:s'),
                    "prioridad" => $data[2],
                    "user_id" => Auth::user()->id,
                    "detalle" => $data[3],
                    "latitud" => $data[0],
                    "longitud" => $data[1],
                    "visto" => true
                ]);
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                dd($th->getMessage());
            }
        }
    }


    public function registroPanico($coord)
    {        
        if ($coord) {
            DB::beginTransaction();
            try {
                $registro = Registroguardia::create([
                    "fechahora" => date('Y-m-d H:i:s'),
                    "prioridad" => 'ALTA',
                    "user_id" => Auth::user()->id,
                    "detalle" => $this->informe,
                    "latitud" => $coord[0],
                    "longitud" => $coord[1],
                ]);

                $x = 1;
                foreach ($this->files as $key => $file) {
                    $arrF = explode('.', $file->getFilename());
                    $name = date('YmdHis') . $x;

                    $x++;
                    $path = $file->storeAs('images/registros/panico', $name . '.' . $arrF[1]);

                    $imgreg = Imgregistro::create([
                        "registroguardia_id" => $registro->id,
                        "url" => $path,
                        "tipo" => $arrF[1],
                    ]);
                }
                DB::commit();

                return redirect()->route('home')->with('success', 'Registro de Pánico guardado correctamente.');
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect()->route('home')->with('error', 'Ha ocurrido un error');
            }
        }
    }
}
