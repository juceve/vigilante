<?php

namespace App\Http\Livewire\Admin;

use App\Models\Citecotizacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class ListadoCiteCotizacion extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $destinatario = "", $cargo = "", $monto = "", $fecha = "", $updCiteId = "";

    public $busqueda = "", $filas = 5, $gestion;
    public function render()
    {
        $citecotizacions = Citecotizacion::where([['cite', 'like', "%$this->busqueda%"], ['gestion', $this->gestion]])
            ->orWhere([["destinatario", "like", "%$this->busqueda%"], ['gestion', $this->gestion]])
            ->orWhere([["fecha", "like", "%$this->busqueda%"], ['gestion', $this->gestion]])
            ->orderBy('correlativo', 'DESC')
            ->paginate($this->filas);
        return view('livewire.admin.listado-cite-cotizacion', compact('citecotizacions'))->extends('adminlte::page');
    }

    protected $listeners = ['anular'];

    public function mount()
    {
        $this->gestion = date('Y');
    }

    public function updatedBusqueda()
    {
        $this->resetPage();
    }
    public function updatedGestion()
    {
        $this->resetPage();
    }

    public function resetAll()
    {
        $this->reset(
            'fecha',
            'destinatario',
            'cargo',
            'monto',

        );
    }

    public function previa()
    {
        $data = [];
        $data[] = 0;

        $datos = '0^0|' . fechaEs($this->fecha) . '|' . $this->destinatario . '|' .  $this->cargo . '|' . $this->monto;

        $datos = codGet($datos);
        Session::put('data-citecotizacion', $datos);

        $this->emit('renderizarpdf');
    }

    public function registrar()
    {
        DB::beginTransaction();
        try {
            $last = Citecotizacion::where('gestion', date('Y'))->orderBy('correlativo', 'DESC')->first();

            if ($last) {
                $last = $last->correlativo;
                $last++;
            } else {
                $last = 1;
            }

            $citecotizacion = Citecotizacion::create([
                'correlativo' => $last,
                'gestion' => date('Y'),
                'cite' => "COT-"   . str_pad($last, 3, "0", STR_PAD_LEFT) . "/" . date('Y'),
                'fecha' => $this->fecha,
                'fechaliteral' => fechaEs($this->fecha),
                'destinatario' => $this->destinatario,
                'cargo' => $this->cargo,
                'monto' => $this->monto,

            ]);

            DB::commit();

            $this->resetAll();
            $datos = $citecotizacion->id;
            $this->emit('renderizarpdf', $datos);
            $this->emit('success', 'Cotización registrado correctamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('error', $th->getMessage());
        }
    }

    public function editar($citecotizacion_id)
    {

        $citecotizacion = Citecotizacion::find($citecotizacion_id);

        $this->updCiteId = $citecotizacion_id;
        $this->destinatario = $citecotizacion->destinatario;
        $this->cargo = $citecotizacion->cargo;
        $this->monto = $citecotizacion->monto;
        $this->fecha = $citecotizacion->fecha;
    }

    public function actualizar()
    {
        DB::beginTransaction();
        try {

            $citecotizacion = Citecotizacion::find($this->updCiteId)->update([

                'fecha' => $this->fecha,
                'fechaliteral' => fechaEs($this->fecha),
                'destinatario' => $this->destinatario,
                'cargo' => $this->cargo,
                'monto' => $this->monto,

            ]);

            DB::commit();

            $this->resetAll();
            $this->emit('success', 'Cotización actualizado correctamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('error', $th->getMessage());
        }
    }

    public function anular($citecotizacion_id)
    {
        DB::beginTransaction();
        try {
            $citecotizacion = Citecotizacion::find($citecotizacion_id)->update([
                'estado' => false,
            ]);
            DB::commit();
            $this->emit('success', 'Cite anulado correctamente.');
        } catch (\Throwable $th) {

            DB::rollBack();
            $this->emit('error', $th->getMessage());
        }
    }
}
