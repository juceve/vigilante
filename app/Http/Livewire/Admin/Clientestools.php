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
        $clientesa = Cliente::where('status', 1)->orderBy('oficina_id', 'ASC')->get();
        $pts = "";
        $clientes = [];
        foreach ($clientesa as $cliente) {
            $alerta = 0;
            $hoy = date('Y-m-d');
            $designaciones = Vwdesignacione::where([
                ['cliente_id', $cliente->id],
                ['fechaInicio', '<=', $hoy],
                ['fechaFin', '>=', $hoy],
                ['estado', true],
            ])->get();

            foreach ($designaciones as $item) {
                if (yaMarque($item->id) == 0) {
                    $alerta = 1;
                    break;
                } else {
                    if (tengoPanicos($item->datosempleado->user_id, $cliente->id) > 0) {
                        $alert = 1;
                        break;
                    }
                }
            }
            $clientes[] = array($cliente->id, $cliente->nombre, $cliente->oficina->nombre, $alerta);
            $fila = $cliente->nombre . "|" . $cliente->latitud . "|" . $cliente->longitud . "|" . $cliente->direccion . "|" . $cliente->personacontacto . "|" . $cliente->telefonocontacto . "|" . $cliente->id . "|" . $alerta;
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
