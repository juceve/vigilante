<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Rrhhcontrato;
use App\Models\Empleado;
use App\Models\Rrhhsueldo;
use App\Models\Rrhhadelanto;
use App\Models\Rrhhbono;
use App\Models\Rrhhasistencia;
use App\Models\Rrhhestado;
use Carbon\Carbon;

class ProcesarSueldo extends Component
{
    public $contratosVigentes = null, $alertasSolapamiento;
    public $rrhhsueldo;
    public $searchEmpleado = '';
    public $procesado = false;
    public $calcularHastaHoy = false;

    public function mount($rrhhsueldo_id)
    {
        $this->rrhhsueldo = Rrhhsueldo::findOrFail($rrhhsueldo_id);

        $gestion = $this->rrhhsueldo->gestion;
        $mes = $this->rrhhsueldo->mes;

        $inicioMes = Carbon::create($gestion, $mes, 1)->startOfDay();
        $finMes = Carbon::create($gestion, $mes, 1)->endOfMonth()->endOfDay();

        // Detectar empleados con contratos solapados en el rango
        $contratosSolapados = RrhhContrato::select('empleado_id')
            ->where('activo', true)
            ->whereDate('fecha_inicio', '<=', $finMes)
            ->where(function ($q) use ($inicioMes) {
                $q->whereNull('fecha_fin')
                    ->orWhereDate('fecha_fin', '>=', $inicioMes);
            })
            ->groupBy('empleado_id')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('empleado_id')
            ->toArray();

        if (count($contratosSolapados) > 0) {
            $this->alertasSolapamiento = Empleado::whereIn('id', $contratosSolapados)->get();
        }

        // Traer solo el contrato vigente correcto por empleado
        $this->contratosVigentes = RrhhContrato::with(['empleado', 'rrhhtipocontrato', 'rrhhcargo'])
            ->where('activo', true)
            ->whereDate('fecha_inicio', '<=', $finMes)
            ->where(function ($q) use ($inicioMes) {
                $q->whereNull('fecha_fin')
                    ->orWhereDate('fecha_fin', '>=', $inicioMes);
            })
            ->whereIn('id', function ($query) use ($finMes, $inicioMes) {
                $query->select('id')
                    ->from('rrhhcontratos as c2')
                    ->where('activo', true)
                    ->whereDate('fecha_inicio', '<=', $finMes)
                    ->where(function ($q) use ($inicioMes) {
                        $q->whereNull('fecha_fin')
                            ->orWhereDate('fecha_fin', '>=', $inicioMes);
                    })
                    ->whereRaw('c2.id = (
                    SELECT cc.id
                    FROM rrhhcontratos cc
                    WHERE cc.empleado_id = c2.empleado_id
                      AND cc.activo = 1
                      AND cc.fecha_inicio <= ?
                      AND (cc.fecha_fin IS NULL OR cc.fecha_fin >= ?)
                    ORDER BY cc.fecha_inicio ASC, cc.id ASC
                    LIMIT 1
                )', [$finMes, $inicioMes]);
            })
            ->get()
            ->map(function ($contrato) {
                $fechaInicio = $contrato->fecha_inicio instanceof Carbon
                    ? $contrato->fecha_inicio
                    : Carbon::parse($contrato->fecha_inicio);

                $gestionContrato = $fechaInicio->year;
                $mesContrato = $fechaInicio->month;

                if (
                    $gestionContrato == $this->rrhhsueldo->gestion &&
                    $mesContrato == $this->rrhhsueldo->mes
                ) {
                    $contrato->inicio_mes = ($fechaInicio->day == 1)
                        ? 'MES COMPLETO'
                        : 'INICIO PARCIAL';
                } else {
                    $contrato->inicio_mes = 'MES COMPLETO';
                }
                // Inicializa totales en 0
                $contrato->total_adelantos = 0;
                $contrato->total_bonos = 0;
                $contrato->total_ctrl_asist = 0;
                $contrato->total_liquido_pagable = $contrato->salario_basico;
                return $contrato;
            });
    }

    public function procesarSueldos()
    {
        // Simula un pequeño retardo para mostrar el loading (opcional)
        usleep(500000); // 0.5 segundos

        $gestion = (int) $this->rrhhsueldo->gestion;
        $mes = (int) $this->rrhhsueldo->mes;
        $diasEnMes = Carbon::create($gestion, $mes, 1)->daysInMonth;

        $fechaInicioMes = Carbon::create($gestion, $mes, 1);
        // Si el checkbox está activo, el cálculo es hasta hoy (pero no más allá del fin de mes)
        $fechaFinMes = $this->calcularHastaHoy
            ? min(Carbon::today(), Carbon::create($gestion, $mes, 1)->endOfMonth())
            : Carbon::create($gestion, $mes, 1)->endOfMonth();

        $this->contratosVigentes = $this->contratosVigentes->map(function ($contrato) use ($gestion, $mes, $diasEnMes, $fechaInicioMes, $fechaFinMes) {
            $cantidadDiasContrato = $contrato->rrhhtipocontrato->cantidad_dias ?? 0;
            $fechaInicioContrato = Carbon::parse($contrato->fecha_inicio);

            $diaInicio = 1;
            if (
                $fechaInicioContrato->year == $gestion &&
                $fechaInicioContrato->month == $mes &&
                $fechaInicioContrato->day > 1
            ) {
                $diaInicio = $fechaInicioContrato->day;
            }

            // Valor del día trabajado (según tipo de contrato)
            $valorDia = $cantidadDiasContrato > 0
                ? $contrato->salario_basico / $cantidadDiasContrato
                : 0;

            // Días realmente trabajados en el periodo seleccionado
            $diasTrabajadosMes = $fechaFinMes->day - $diaInicio + 1;

            // Salario básico proporcional solo si es hasta hoy, si no, es el salario completo
            if ($this->calcularHastaHoy) {
                $salarioBasicoProporcional = $cantidadDiasContrato > 0
                    ? round($contrato->salario_basico * ($diasTrabajadosMes / $cantidadDiasContrato), 2)
                    : 0;
            } else {
                $salarioBasicoProporcional = $contrato->salario_basico;
            }

            // Cálculo de asistencia
            $diferenciaTotal = 0;
            for ($dia = $diaInicio; $dia <= $fechaFinMes->day; $dia++) {
                $fechaActual = Carbon::create($gestion, $mes, $dia)->format('Y-m-d');

                $asistencia = Rrhhasistencia::where('empleado_id', $contrato->empleado_id)
                    ->whereDate('fecha', $fechaActual)
                    ->first();

                if ($asistencia) {
                    $estado = Rrhhestado::find($asistencia->rrhhestado_id);
                    $factor = $estado ? $estado->factor : 1;
                } else {
                    $factor = 1;
                }

                $diferenciaTotal += $valorDia * ($factor - 1);
            }

            // Salario ajustado por asistencia y proporcionalidad
            $contrato->salario_asistencia = round($salarioBasicoProporcional + $diferenciaTotal, 2);
            $contrato->total_ctrl_asist = round(-$diferenciaTotal, 2);

            // Adelantos
            $fechaInicio = $fechaInicioMes->format('Y-m-d');
            $fechaFin = $fechaFinMes->format('Y-m-d');
            $adelantos = Rrhhadelanto::where('empleado_id', $contrato->empleado_id)
                ->whereDate('fecha', '>=', $fechaInicio)
                ->whereDate('fecha', '<=', $fechaFin)
                ->sum('monto');

            // Bonos (cantidad * monto)
            $bonos = Rrhhbono::where('empleado_id', $contrato->empleado_id)
                ->whereDate('fecha', '>=', $fechaInicio)
                ->whereDate('fecha', '<=', $fechaFin)
                ->get()
                ->sum(function($bono) {
                    return $bono->cantidad * $bono->monto;
                });

            $contrato->total_adelantos = $adelantos;
            $contrato->total_bonos = $bonos;

            // Líquido pagable
            $contrato->total_liquido_pagable = $contrato->salario_asistencia - $adelantos + $bonos;

            return $contrato;
        });

        $this->procesado = true;
    }

    public function getContratosFiltradosProperty()
    {
        if (empty($this->searchEmpleado)) {
            return $this->contratosVigentes;
        }
        $busqueda = mb_strtolower($this->searchEmpleado);
        return $this->contratosVigentes->filter(function ($contrato) use ($busqueda) {
            $nombre = mb_strtolower($contrato->empleado->nombres ?? '');
            $apellidos = mb_strtolower($contrato->empleado->apellidos ?? '');
            return strpos($nombre, $busqueda) !== false || strpos($apellidos, $busqueda) !== false;
        });
    }

    public function render()
    {
        return view('livewire.admin.procesar-sueldo', [
            'alertasSolapamiento' => $this->alertasSolapamiento,
            'rrhhsueldo' => $this->rrhhsueldo,
        ])->extends('adminlte::page');
    }
}
