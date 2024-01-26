<?php

namespace App\Http\Controllers;

use App\Models\Citerecibo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

/**
 * Class CitereciboController
 * @package App\Http\Controllers
 */
class CitereciboController extends Controller
{
    public function previsualizacion($data = NULL)
    {
        $pdf = Pdf::loadView('tempdocs.recibo', compact('data'))
            ->setPaper('letter', 'portrait');

        return $pdf->stream();
    }
}
