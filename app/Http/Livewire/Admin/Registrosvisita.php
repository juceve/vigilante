<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cliente;
use App\Models\Visita;
use App\Models\Vwvisita;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Registrosvisita extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $clientes, $cliente_id = "", $estado = "", $inicio, $final, $search = "";

    public function mount()
    {
        $this->inicio = date('Y-m-d');
        $this->final = date('Y-m-d');
        $this->clientes = Cliente::all()->pluck('nombre', 'id');
    }

    public function render()
    {
        DB::enableQueryLog();
        $resultados = NULL;
        $sql = "";
        if ($this->cliente_id != "") {
            if ($this->estado == "") {
                $resultados = Vwvisita::where([
                    ["fechaingreso", ">=", $this->inicio],
                    ["fechaingreso", "<=", $this->final],
                    ["cliente_id", ">=", $this->cliente_id],
                    ['visitante', 'LIKE', '%' . $this->search . '%']
                ])->orWhere(
                    [
                        ["fechaingreso", ">=", $this->inicio],
                        ["fechaingreso", "<=", $this->final],
                        ["cliente_id", ">=", $this->cliente_id],
                        ['residente', 'LIKE', '%' . $this->search . '%']
                    ]
                )->orWhere([
                    ["fechaingreso", ">=", $this->inicio],
                    ["fechaingreso", "<=", $this->final],
                    ["cliente_id", ">=", $this->cliente_id],
                    ['docidentidad', 'LIKE', '%' . $this->search . '%']
                ])->paginate(10);
            } else {
                $resultados = Vwvisita::where([
                    ["fechaingreso", ">=", $this->inicio],
                    ["fechaingreso", "<=", $this->final],
                    ["cliente_id", ">=", $this->cliente_id],
                    ['visitante', 'LIKE', '%' . $this->search . '%'],
                    ["estado", $this->estado],
                ])
                    ->orWhere([
                        ["fechaingreso", ">=", $this->inicio],
                        ["fechaingreso", "<=", $this->final],
                        ["cliente_id", ">=", $this->cliente_id],
                        ['residente', 'LIKE', '%' . $this->search . '%'],
                        ["estado", $this->estado],
                    ])
                    ->orWhere([
                        ["fechaingreso", ">=", $this->inicio],
                        ["fechaingreso", "<=", $this->final],
                        ["cliente_id", ">=", $this->cliente_id],
                        ['docidentidad', 'LIKE', '%' . $this->search . '%'],
                        ["estado", $this->estado],
                    ])->paginate(10);
            }
        }


        return view('livewire.admin.registrosvisita', compact('resultados'))->extends('adminlte::page');
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
