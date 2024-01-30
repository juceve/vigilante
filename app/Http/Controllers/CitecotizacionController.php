<?php

namespace App\Http\Controllers;

use App\Models\Citecotizacion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

/**
 * Class CitecotizacionController
 * @package App\Http\Controllers
 */
class CitecotizacionController extends Controller
{
    public function previsualizacion($data = NULL)
    {
        $pdf = Pdf::loadView('tempdocs.cotizacion', compact('data'))
            ->setPaper('letter', 'portrait');

        return $pdf->stream();
    }
}
