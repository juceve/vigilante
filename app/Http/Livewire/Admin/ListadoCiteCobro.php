<?php

namespace App\Http\Livewire\Admin;

use App\Models\Citecobro;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListadoCiteCobro extends Component
{
    public  $selID = "", $cliente = null, $updCiteId;
    public $c_cite = "", $c_mescobro = "", $c_gestion = "", $c_fecha = "", $c_factura = "", $c_monto = "", $c_representante = "";

    public function render()
    {
        $citecobros = Citecobro::all();
        $clientes = Cliente::all()->pluck('nombre', 'id');
        $this->emit('dataTableRender');
        return view('livewire.admin.listado-cite-cobro', compact('citecobros', 'clientes'))->extends('adminlte::page');
    }

    public function mount()
    {
        $this->c_fecha = date('Y-m-d');
    }

    public function resetAll()
    {
        $this->reset(
            'selID',
            'cliente',
            'updCiteId',
            'c_cite',
            'c_mescobro',
            'c_gestion',
            'c_fecha',
            'c_factura',
            'c_monto',
            'c_representante'
        );
    }

    protected $listeners = ['anular'];

    public function updatedSelID()
    {
        $this->cliente = Cliente::find($this->selID);
        if ($this->cliente) {
            $this->c_representante = $this->cliente->personacontacto;
        } else {
            $this->c_representante = "";
        }
    }

    public function previa()
    {
        $data = [];
        $data[] = 0;

        $datos = '0^0|' . fechaEs($this->c_fecha) . '|' . $this->cliente->nombre . '|' .  $this->c_representante . '|' . $this->c_mescobro . '-' . $this->c_gestion . '|' . $this->c_factura . '|' . $this->c_monto;
        // $datos .= $puntos;
        $datos = codGet($datos);
        $this->emit('renderizarpdf', $datos);
    }

    public function registrar()
    {
        DB::beginTransaction();
        try {
            $last = Citecobro::where('gestion', date('Y'))->orderBy('correlativo', 'DESC')->first();

            if ($last) {
                $last = $last->correlativo;
                $last++;
            } else {
                $last = 1;
            }

            $citecobro = Citecobro::create([
                'correlativo' => $last,
                'gestion' => date('Y'),
                'cite' => "COB-"   . str_pad($last, 3, "0", STR_PAD_LEFT) . "/" . date('Y'),
                'fecha' => $this->c_fecha,
                'fechaliteral' => fechaEs($this->c_fecha),
                'cliente' => $this->cliente->nombre,
                'cliente_id' => $this->cliente->id,
                'representante' => $this->c_representante,
                'mescobro' => $this->c_mescobro . '-' . $this->c_gestion,
                'factura' => $this->c_factura,
                'monto' => $this->c_monto,

            ]);

            DB::commit();

            $this->resetAll();
            $datos = $citecobro->id;
            $this->emit('renderizarpdf', $datos);
            $this->emit('success', 'Cobro registrado correctamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('error', $th->getMessage());
        }
    }

    public function editar($citecobro_id)
    {
        // $c_cite = "", $c_mescobro = "", $c_gestion = "", $c_fecha = "", $c_factura = "", $c_monto = "", $c_representante = "";
        $citecobro = Citecobro::find($citecobro_id);
        $datocobro = explode('-', $citecobro->mescobro);

        $this->updCiteId = $citecobro_id;
        // $this->cliente = $citecobro->cliente_data;
        $this->c_representante = $citecobro->representante;
        $this->c_mescobro = $datocobro[0];
        $this->c_gestion = $datocobro[1];
        $this->c_fecha = $citecobro->fecha;
        $this->c_factura = $citecobro->factura;
        $this->c_monto = $citecobro->monto;

        $this->cliente = $citecobro->cliente_data;

        $this->selID = $citecobro->cliente_id;
    }

    public function actualizar()
    {

        DB::beginTransaction();
        try {

            $citecobro = Citecobro::find($this->updCiteId)->update([
                'fecha' => $this->c_fecha,
                'fechaliteral' => fechaEs($this->c_fecha),
                'cliente' => $this->cliente->nombre,
                'cliente_id' => $this->cliente->id,
                'representante' => $this->c_representante,
                'mescobro' => $this->c_mescobro . '-' . $this->c_gestion,
                'factura' => $this->c_factura,
                'monto' => $this->c_monto,
            ]);

            DB::commit();

            $this->resetAll();

            $this->emit('success', 'Informe actualizado correctamente.');
        } catch (\Throwable $th) {

            DB::rollBack();
            $this->emit('error', $th->getMessage());
        }
    }

    public function anular($citecobro_id)
    {
        DB::beginTransaction();
        try {
            $citecobro = Citecobro::find($citecobro_id)->update([
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
