<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cliente;
use App\Models\Designaciondia;
use App\Models\Designacione;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NuevaDesignacion extends Component
{
    public $designacione = null;
    public $empleadoid = "", $empleado = null, $nombres = "", $clientes = null, $clienteid = "", $clienteSeleccionado = null;
    public $turnoid = "", $fechaInicio = "", $fechaFin = "";
    public $lunes = false, $martes = false, $miercoles = false, $jueves = false, $viernes = false, $sabado = false, $domingo = false;

    protected $rules = [
        'empleadoid' => 'required',
        'clienteid' => 'required',
        'turnoid' => 'required',
        'fechaInicio' => 'required',
        'fechaFin' => 'required',
    ];

    public function mount($designacione)
    {
        $this->designacione = $designacione;
        // $this->empleado = new Empleado();
    }

    public function updatedEmpleadoid()
    {
        $this->empleado = Empleado::find($this->empleadoid);
        // dd($this->empleado);
        $this->nombres = $this->empleado->nombres . " " . $this->empleado->apellidos;
        $this->clientes = Cliente::where('oficina_id', $this->empleado->oficina_id)->get();
        $this->clientes->pluck('nombre', 'id');
    }

    public function updatedClienteid()
    {
        $this->clienteSeleccionado = Cliente::find($this->clienteid);
    }

    public function render()
    {
        $empleados = DB::table('empleados')
            ->join('areas', 'areas.id', '=', 'empleados.area_id')
            ->join('oficinas','oficinas.id','=','empleados.oficina_id')
            ->where('areas.template', '=', 'OPER')
            ->select('empleados.*','oficinas.nombre as oficina')->get();

        return view('livewire.admin.nueva-designacion', compact('empleados'));
    }

    public function registrar()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $designacion = Designacione::create([
                "empleado_id" => $this->empleadoid,
                "turno_id" => $this->turnoid,
                "fechaInicio" => $this->fechaInicio,
                "fechaFin" => $this->fechaFin,
            ]);

            $dias = Designaciondia::create([
                "designacione_id" => $designacion->id,
                "lunes" => $this->lunes,
                "martes" => $this->martes,
                "miercoles" => $this->miercoles,
                "jueves" => $this->jueves,
                "viernes" => $this->viernes,
                "sabado" => $this->sabado,
                "domingo" => $this->domingo,
            ]);

            DB::commit();
            redirect()->route('designaciones.index')->with('success', 'Designación registrada correctamente.');
        } catch (\Throwable $th) {
            $this->emit('error', 'Ha ocurrido un error');
            DB::rollBack();
        }
    }
}
