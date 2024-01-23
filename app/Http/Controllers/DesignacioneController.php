<?php

namespace App\Http\Controllers;

use App\Models\Designaciondia;
use App\Models\Designacione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Class DesignacioneController
 * @package App\Http\Controllers
 */
class DesignacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designaciones = Designacione::all();

        return view('admin.designacione.index', compact('designaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designacione = new Designacione();
        return view('admin.designacione.create', compact('designacione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Designacione::$rules);

        $designacione = Designacione::create($request->all());

        return redirect()->route('designaciones.index')
            ->with('success', 'Designacione created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $designacione = Designacione::find($id);
        // $rondas = tablaRondas($designacione->id);
        // dd($rondas);
        return view('admin.designacione.show', compact('designacione'));
    }

    public function marcaciones($id)
    {
        $designacione = Designacione::find($id);
        return view('admin.designacione.marcaciones', compact('designacione'));
    }

    public function pdfRondas($id)
    {
        $designacione = Designacione::find($id);
        $rondas = tablaRondas($id);
        // return view('admin.designacione.pdfRonda', compact('designacione','rondas'));
        $pdf = Pdf::loadView('admin.designacione.pdfRonda', compact('designacione', 'rondas'));
        return $pdf->stream();
    }
    public function pdfMarcaciones($id)
    {
        $designacione = Designacione::find($id);
        $marcaciones = tablaMarcaciones($id);
        // return view('admin.designacione.pdfRonda', compact('designacione','rondas'));
        $pdf = Pdf::loadView('admin.designacione.pdfMarcaciones', compact('designacione', 'marcaciones'));
        return $pdf->stream();
    }
    public function pdfNovedades($id)
    {
        $designacione = Designacione::find($id);
        $novedades = $designacione->novedades;
        // return view('admin.designacione.pdfRonda', compact('designacione','rondas'));
        $pdf = Pdf::loadView('admin.designacione.pdfNovedades', compact('designacione', 'novedades'));
        return $pdf->stream();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $designacione = Designacione::find($id);
        $designaciondia = Designaciondia::where('designacione_id', $id)->first();
        // dd($designaciondia);
        return view('admin.designacione.edit', compact('designacione', 'designaciondia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Designacione $designacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designacione $designacione)
    {
        request()->validate([
            "fechaInicio" => "required",
            "fechaFin" => "required",
        ]);
        DB::beginTransaction();
        try {
            $designacione->update([
                "fechaInicio" => $request->fechaInicio,
                "fechaFin" => $request->fechaFin,
                "intervalo_hv" => $request->intervalo_hv,
            ]);

            $designaciondia = Designaciondia::where('designacione_id', $designacione->id)->first();
            $designaciondia->update([
                "lunes" => $request->lunes == "on" ? 1 : 0,
                "martes" => $request->martes == "on" ? 1 : 0,
                "miercoles" => $request->miercoles == "on" ? 1 : 0,
                "jueves" => $request->jueves == "on" ? 1 : 0,
                "viernes" => $request->viernes == "on" ? 1 : 0,
                "sabado" => $request->sabado == "on" ? 1 : 0,
                "domingo" => $request->domingo == "on" ? 1 : 0,
            ]);

            DB::commit();
            return redirect()->route('designaciones.index')
                ->with('success', 'Designación editada correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('designaciones.index')
                ->with('error', 'Ha ocurrido un error');
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $designaciondia = Designaciondia::where('designacione_id', $id)->delete();
            $designacione = Designacione::find($id)->delete();
            DB::commit();
            return redirect()->route('designaciones.index')
                ->with('success', 'Designación eliminada correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('designaciones.index')
                ->with('error', 'Ha ocurrido un error');
        }
    }
}
