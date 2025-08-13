<?php

namespace App\Http\Controllers;

use App\Models\Rrhhsueldo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SueldoController extends Controller
{
    public function previsualizacion($id)
    {
       $rrhhsueldo = Rrhhsueldo::find($id);
        $sueldos = $rrhhsueldo->rrhhsueldoempleados;
        $pdf = Pdf::loadView('tempdocs.sueldos-resumen', compact('rrhhsueldo', 'sueldos'))
            ->setPaper('letter', 'landscape');

        return $pdf->stream();
    }
}
