<?php

namespace App\Http\Livewire\Admin;

use App\Exports\NovedadesExport;
use App\Models\Cliente;
use App\Models\Novedade;
use App\Models\Vwnovedade;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Registrosnovedades extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $clientes, $cliente_id = "",  $inicio, $final, $search = "";
    public $novedade = null;

    public function mount()
    {
        $this->inicio = date('Y-m-d');
        $this->final = date('Y-m-d');
        $this->clientes = Cliente::all()->pluck('nombre', 'id');
        $this->novedade = new Novedade();
    }
    public function render()
    {
        $resultados = NULL;
        $sql = "";
        if ($this->cliente_id != "") {

            $resultados = Vwnovedade::where([
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


            $parametros = array($this->cliente_id, $this->inicio, $this->final, $this->search);
            Session::put('param-novedades', $parametros);
        }

        return view('livewire.admin.registrosnovedades', compact('resultados'))->extends('adminlte::page');
    }

    public function verInfo($id)
    {
        $this->novedade = Vwnovedade::find($id);
    }

    public function exporExcel()
    {
        $cliente = Cliente::find($this->cliente_id);
        return Excel::download(new NovedadesExport(), 'Novedades_' . $cliente->nombre . '_' . date('His') . '.xlsx');
    }

    public function updatedCliente_id()
    {
        $this->resetPage();
    }
    public function updatedEstado()
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
