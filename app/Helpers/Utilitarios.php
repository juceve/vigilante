<?php

use App\Models\Designaciondia;
use App\Models\Designacione;
use App\Models\Regronda;

function tablaRondas($designacione_id)
{
    $designacione = Designacione::find($designacione_id);
    $diaslaborables = Designaciondia::where('designacione_id', $designacione_id)
        ->select('lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo')
        ->first();
    $diaslaborables = $diaslaborables->toArray();
    $ctrlpuntos = $designacione->turno->ctrlpuntos;
    $diasL = array(
        "",
        $diaslaborables['lunes'], $diaslaborables['martes'], $diaslaborables['miercoles'],
        $diaslaborables['jueves'], $diaslaborables['viernes'],
        $diaslaborables['sabado'], $diaslaborables['domingo']
    );
    $rondas = [];
    $actual = new DateTime($designacione->fechaInicio);
    $final = new DateTime($designacione->fechaFin);

    while ($actual <= $final) {
        $numeral = date('N', strtotime($actual->format('Y-m-d')));
        if ($diasL[$numeral]) {
            $fecha = $actual->format('Y-m-d');
            $rondaA = [];
            $rondaA[] = array($fecha, 0);
            foreach ($ctrlpuntos as $punto) {
                $ronda = Regronda::where([
                    ['designacione_id', $designacione_id],
                    ['fecha', $fecha],
                    ['ctrlpunto_id', $punto->id]
                ])->first();

                if ($ronda) {
                    if (hayRetraso($ronda->hora, $punto->hora)) {
                        $rondaA[] = array($ronda->hora, 2, $ronda->id);
                    } else {
                        $rondaA[] = array($ronda->hora, 0, $ronda->id);
                    }
                } else {
                    if ($fecha <= date('Y-m-d')) {
                        $rondaA[] = array('X', 1, "");
                    } else {
                        $rondaA[] = array('--', 0, "");
                    }
                }
            }
            $rondas[] = $rondaA;
        }
        $actual->modify('+1 day');
    }
    return $rondas;
}

function hayRetraso($hora_marcado, $hora_programada)
{
    $horaInicio = $hora_programada;
    $horaLlegada = $hora_marcado;

    $inicio = new DateTime($horaInicio);
    $llegada = new DateTime($horaLlegada);
    // $inicio->modify('-5 minutes');
    $interval = $inicio->diff($llegada);
    $retrasoMinutos = $interval->format('%i');

    if ($llegada > $inicio) {
        return true;
    } else {
        return false;
    }
}
