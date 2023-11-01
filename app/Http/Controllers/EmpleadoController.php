<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\Oficina;
use App\Models\Tipodocumento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Class EmpleadoController
 * @package App\Http\Controllers
 */
class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::all();

        return view('admin.empleado.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleado = new Empleado();
        $areas = Area::all()->pluck('nombre', 'id');
        $tipodocs = Tipodocumento::all()->pluck('name', 'id');
        $oficinas = Oficina::all()->pluck('nombre', 'id');
        return view('admin.empleado.create', compact('empleado', 'areas','tipodocs','oficinas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Empleado::$rules);

        $empleado = Empleado::create($request->all());

        if ($request->generarusuario == 'on') {
            $area = Area::find($request->area_id);
            $usuario = User::create([
                "name" => $empleado->nombres . " " . $empleado->apellidos,
                "email" => $empleado->email,
                "password" => bcrypt($empleado->cedula),
                "template" => $area->template,
                "status" => true
            ]);
            $empleado->user_id = $usuario->id;
            $empleado->save();
        }


        return redirect()->route('empleados.index')
            ->with('success', 'Empleado creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);

        return view('admin.empleado.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::find($id);
        $areas = Area::all()->pluck('nombre', 'id');
        $tipodocs = Tipodocumento::all()->pluck('name', 'id');
        $oficinas = Oficina::all()->pluck('nombre', 'id');
        return view('admin.empleado.edit', compact('empleado', 'areas', 'tipodocs','oficinas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        request()->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'cedula' => 'required|min:3',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => ['required', Rule::unique('empleados')->ignore($empleado)],
        ]);
        $area = Area::find($request->area_id);
        $empleado->update($request->all());
        if ($request->generarusuario == 'on') {

            $usuario = User::create([
                "name" => $empleado->nombres . " " . $empleado->apellidos,
                "email" => $empleado->email,
                "password" => bcrypt($empleado->cedula),
                "template" => $area->template,
                "status" => true
            ]);
            $empleado->user_id = $usuario->id;
            $empleado->save();
        }
        else {
            if ($empleado->user_id) {
                $user = User::find($empleado->user_id);
                $user->template = $area->template;
                $user->save();
            }
        }

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado editado correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        if ($empleado->user_id) {
            $usuario = User::find($empleado->user_id)->delete();
        }
        $empleado->delete();


        return redirect()->route('empleados.index')
            ->with('success', 'Empleado eliminado correctamente');
    }
}
