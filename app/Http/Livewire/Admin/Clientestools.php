<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cliente;
use App\Models\Vwdesignacione;
use App\Models\Vwnovedade;
use Livewire\Component;

class Clientestools extends Component
{
    public $selCliente = NULL, $designaciones = NULL, $panicos = NULL;

    public function render()
    {
        $colores = array("primary", "success", "info", "warning", "danger", "secondary");
        $clientes = Cliente::where('status', 1)->orderBy('oficina_id', 'ASC')->get();
        $pts = "";
        foreach ($clientes as $cliente) {
            $fila = $cliente->nombre . "|" . $cliente->latitud . "|" . $cliente->longitud . "|" . $cliente->direccion . "|" . $cliente->personacontacto . "|" . $cliente->telefonocontacto . "|" . $cliente->id;
            $pts .= $fila . "$";
        }
        $pts = substr($pts, 0, -1);
        return view('livewire.admin.clientestools', compact('clientes', 'colores', 'pts'));
    }

    public function cargarCliente($cliente_id)
    {
        $this->reset('selCliente', 'designaciones');
        $this->selCliente = Cliente::find($cliente_id);
        $hoy = date('Y-m-d');
        $this->designaciones = Vwdesignacione::where([
            ['cliente_id', $this->selCliente->id],
            ['fechaInicio', '<=', $hoy],
            ['fechaFin', '>=', $hoy],
            ['estado', true],
        ])->get();
    }
}
