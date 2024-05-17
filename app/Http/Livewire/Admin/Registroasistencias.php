<?php

namespace App\Http\Livewire\Admin;

use App\Models\Asistencia;
use App\Models\Cliente;
use App\Models\Vwasistencia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Registroasistencias extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $clientes, $cliente_id = "",  $inicio, $final, $search = "",  $empleado_id = "", $auxcliente = "";
    public $asistencia = null;

    public function mount()
    {
        $this->inicio = date('Y-m-d');
        $this->final = date('Y-m-d');
        $this->clientes = Cliente::all()->pluck('nombre', 'id');
        $this->asistencia = new Asistencia();
    }

    public function render()
    {
        $resultados = NULL;
        $empleados = [];
        $sql = "";
        if ($this->cliente_id != "") {
            $empleados = DB::select("SELECT DISTINCT(empleado_id) id,empleado nombre FROM vwasistencias");
            if ($this->auxcliente != $this->cliente_id) {
                $this->auxcliente = $this->cliente_id;
                $this->empleado_id = "";
            }

            if ($this->empleado_id == "") {
                $resultados = Vwasistencia::where([
                    ["fecha", ">=", $this->inicio],
                    ["fecha", "<=", $this->final],
                    ["cliente_id", $this->cliente_id],
                    ['empleado', 'LIKE', '%' . $this->search . '%']
                ])->orWhere(
                    [
                        ["fecha", ">=", $this->inicio],
                        ["fecha", "<=", $this->final],
                        ["cliente_id", $this->cliente_id],
                        ['turno', 'LIKE', '%' . $this->search . '%']
                    ]
                )
                    ->orderBy('fecha', 'DESC')
                    ->paginate(10);
                $this->empleado_id = "";
            } else {
                $resultados = Vwasistencia::where([
                    ["fecha", ">=", $this->inicio],
                    ["fecha", "<=", $this->final],
                    ["cliente_id", $this->cliente_id],
                    ['empleado_id', $this->empleado_id]
                ])->orWhere(
                    [
                        ["fecha", ">=", $this->inicio],
                        ["fecha", "<=", $this->final],
                        ["cliente_id", $this->cliente_id],
                        ['turno', 'LIKE', '%' . $this->search . '%'],
                        ['empleado_id', $this->empleado_id]
                    ]
                )
                    ->orderBy('fecha', 'DESC')
                    ->paginate(10);
            }
        }

        return view('livewire.admin.registroasistencias', compact('resultados', 'empleados'))->extends('adminlte::page');
    }

    public function verInfo($id)
    {
        $this->asistencia = Vwasistencia::find($id);
    }

    public function exporExcel()
    {
        // $cliente = Cliente::find($this->cliente_id);
        // return Excel::download(new NovedadesExport(), 'Novedades_' . $cliente->nombre . '_' . date('His') . '.xlsx');
    }

    public function updatedCliente_id()
    {
        $this->resetPage();
    }
    public function updatedEmpleado_id()
    {
        $this->resetPage();
    }
    public function updatedInicio()
    {
        $this->resetPage();
    }
    public function updatedFinal()
    {
        $this->resetPage();
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
}
