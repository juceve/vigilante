<?php

namespace App\Http\Controllers;

use App\Models\Citememorandum;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

/**
 * Class CitememorandumController
 * @package App\Http\Controllers
 */
class CitememorandumController extends Controller
{
    public function previsualizacion($data = NULL)
    {
        $pdf = Pdf::loadView('tempdocs.memorandum', compact('data'))
            ->setPaper('letter', 'portrait');

        return $pdf->stream();
    }
}
