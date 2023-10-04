<?php

namespace App\Http\Controllers;

use App\Models\Regronda;
use Illuminate\Http\Request;

/**
 * Class RegrondaController
 * @package App\Http\Controllers
 */
class RegrondaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regrondas = Regronda::paginate();

        return view('regronda.index', compact('regrondas'))
            ->with('i', (request()->input('page', 1) - 1) * $regrondas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regronda = new Regronda();
        return view('regronda.create', compact('regronda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Regronda::$rules);

        $regronda = Regronda::create($request->all());

        return redirect()->route('regrondas.index')
            ->with('success', 'Regronda created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $regronda = Regronda::find($id);

        return view('regronda.show', compact('regronda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regronda = Regronda::find($id);

        return view('regronda.edit', compact('regronda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Regronda $regronda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regronda $regronda)
    {
        request()->validate(Regronda::$rules);

        $regronda->update($request->all());

        return redirect()->route('regrondas.index')
            ->with('success', 'Regronda updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $regronda = Regronda::find($id)->delete();

        return redirect()->route('regrondas.index')
            ->with('success', 'Regronda deleted successfully');
    }
}
