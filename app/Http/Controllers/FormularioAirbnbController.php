<?php

namespace App\Http\Controllers;

use App\Models\Airbnbcompanion;
use App\Models\Airbnblink;
use App\Models\Airbnbtraveler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FormularioAirbnbController extends Controller
{
    public function index($link_id)
    {

        $airbnblink = Airbnblink::find($link_id);
        if ($airbnblink->vigencia >= now()) {
            return view('customer.formulario_airbnb', compact('link_id'));
        } else {
            return view('customer.formulario_expirado', compact('link_id'));
        }
    }

    public function regsuccess($registro_id)
    {
        $traveler = Airbnbtraveler::find($registro_id);
        $companions = $traveler->airbnbcompanions;
        $link = $traveler->airbnblink;

        $contenido = $link->id . '|' . $traveler->id . '|' . $companions->count();
        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($contenido) . '&size=200x200';
        return view('customer.registroexitoso', compact('traveler', 'companions', 'link', 'qrUrl','contenido'));
    }

    public function descargarQr($contenido)
    {
        
       // Sanitizar y codificar el contenido
       $encodedContent = urlencode($contenido);
       $data = explode(",", $contenido);

       // URL de la API para generar el QR
       $qrApiUrl = "https://api.qrserver.com/v1/create-qr-code/?data={$encodedContent}&size=200x200";

       // Descargar el QR como un archivo binario
       $response = Http::get($qrApiUrl);

       // Verificar que la respuesta sea válida
       if ($response->ok()) {
           // Descargar la imagen
           return response($response->body(), 200)
               ->header('Content-Type', 'image/png')
               ->header('Content-Disposition', 'attachment; filename="QR_CONTROL.png"');
       }

       // Manejar errores en la generación del QR
       return response()->json([
           'message' => 'No se pudo generar el código QR. Intente nuevamente.',
       ], 500);
    }
}
