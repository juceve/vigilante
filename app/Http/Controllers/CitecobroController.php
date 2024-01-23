<?php

namespace App\Http\Controllers;

use App\Models\Citecobro;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

/**
 * Class CitecobroController
 * @package App\Http\Controllers
 */
class CitecobroController extends Controller
{
    public function previsualizacion($data = NULL)
    {
        $pdf = Pdf::loadView('tempdocs.cobro', compact('data'))
            ->setPaper('letter', 'portrait');

        return $pdf->stream();
    }
}
