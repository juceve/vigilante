<?php

namespace App\Http\Controllers;

use App\Models\Citeinforme;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class CiteinformeController extends Controller
{    
    public function previsualizacion($data=NULL){
        $pdf = Pdf::loadView('tempdocs.informe', compact('data'))
        ->setPaper('letter', 'portrait');

        return $pdf->stream();
    }
}
