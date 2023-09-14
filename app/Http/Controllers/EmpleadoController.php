<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Http\Request;

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
        $empleados = Empleado::paginate();

        return view('admin.empleado.index', compact('empleados'))
            ->with('i', (request()->input('page', 1) - 1) * $empleados->perPage());
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
        return view('admin.empleado.create', compact('empleado', 'areas'));
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
            $usuario = User::create([
                "name" => $empleado->nombres . " " . $empleado->apellidos,
                "email" => $empleado->email,
                "password" => bcrypt($empleado->cedula),
                "template" => "ADMIN",
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

        return view('admin.empleado.edit', compact('empleado', 'areas'));
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
        request()->validate(Empleado::$rules);

        $empleado->update($request->all());
        if ($request->generarusuario == 'on') {
            $usuario = User::create([
                "name" => $empleado->nombres . " " . $empleado->apellidos,
                "email" => $empleado->email,
                "password" => bcrypt($empleado->cedula),
                "template" => "ADMIN",
                "status" => true
            ]);
            $empleado->user_id = $usuario->id;
            $empleado->save();
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
