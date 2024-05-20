<?php

namespace App\Http\Livewire\Admin;

use App\Models\Empleado;
use Livewire\Component;
use Livewire\WithPagination;

class ListadoEmpleados extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $busqueda = "", $filas = 10;

    public function render()
    {
        $empleados = Empleado::join('areas', 'areas.id', '=', 'empleados.area_id')
            ->select('empleados.*', 'areas.nombre')
            ->where('empleados.nombres', 'LIKE', '%' . $this->busqueda . '%')
            ->orWhere('empleados.apellidos', 'LIKE', '%' . $this->busqueda . '%')
            ->orWhere('areas.nombre', 'LIKE', '%' . $this->busqueda . '%')
            ->paginate($this->filas);

        return view('livewire.admin.listado-empleados', compact('empleados'));
    }

    public function updatedBusqueda()
    {
        $this->resetPage();
    }
    public function updatedFilas()
    {
        $this->resetPage();
    }
}
