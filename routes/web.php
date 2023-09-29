<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\RegistroguardiaController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Admin\PuntosControl;
use App\Http\Livewire\Admin\Regactividad;
use App\Http\Livewire\Admin\TurnoCliente;

use App\Http\Livewire\Vigilancia\HombreVivo;
use App\Http\Livewire\Vigilancia\Novedades;
use App\Http\Livewire\Vigilancia\Panico;
use App\Http\Livewire\Vigilancia\Ronda;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('admin/profile',[UserController::class,'profile'])->name('profile');
    Route::get('admin/users',[UserController::class,'index'])->name('users');
    Route::get('vigilancia/panico', Panico::class)->name('vigilancia.panico');
    Route::get('vigilancia/ronda', Ronda::class)->name('vigilancia.ronda');
    Route::get('vigilancia/hombre-vivo', HombreVivo::class)->name('vigilancia.hombre-vivo');
    Route::get('vigilancia/novedades', Novedades::class)->name('vigilancia.novedades');
    Route::get('admin/registro-actividad',Regactividad::class)->name('admin.regactividad');
    Route::get('admin/turnos-cliente/{cliente_id}',TurnoCliente::class)->name('admin.turnos-cliente');
    Route::get('admin/puntos-control/{turno_id}',PuntosControl::class)->name(('puntoscontrol'));

    Route::resource('registroguardias', RegistroguardiaController::class)->names('registroguardias');
    Route::resource('admin/empleados',EmpleadoController::class)->names('empleados');
    Route::resource('admin/areas',AreaController::class)->names('areas');
    Route::resource('admin/oficinas',OficinaController::class)->names('oficinas');
    Route::resource('admin/clientes',ClienteController::class)->names('clientes');
});
