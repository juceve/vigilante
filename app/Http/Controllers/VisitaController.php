<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;

/**
 * Class VisitaController
 * @package App\Http\Controllers
 */
class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitas = Visita::paginate();

        return view('visita.index', compact('visitas'))
            ->with('i', (request()->input('page', 1) - 1) * $visitas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $visita = new Visita();
        return view('visita.create', compact('visita'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Visita::$rules);

        $visita = Visita::create($request->all());

        return redirect()->route('visitas.index')
            ->with('success', 'Visita created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visita = Visita::find($id);

        return view('visita.show', compact('visita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visita = Visita::find($id);

        return view('visita.edit', compact('visita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Visita $visita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visita $visita)
    {
        request()->validate(Visita::$rules);

        $visita->update($request->all());

        return redirect()->route('visitas.index')
            ->with('success', 'Visita updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $visita = Visita::find($id)->delete();

        return redirect()->route('visitas.index')
            ->with('success', 'Visita deleted successfully');
    }
}
