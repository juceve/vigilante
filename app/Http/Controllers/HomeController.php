<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Designacione;
use App\Models\Marcacione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->template == "OPER") {
            $empleado_id = Auth::user()->empleados[0]->id;
            $designaciones = null;
            if($empleado_id){
                $designaciones = Designacione::where('fechaFin','>=',date('Y-m-d'))->where('empleado_id',$empleado_id)->orderBy('fechaInicio','ASC')->first();
            }  

            return view('operativo',compact('designaciones'));
        }
        if (Auth::user()->template == "ADMIN") {
            $colores = array("primary","success", "info", "warning", "danger","secondary");
                $clientes = Cliente::where('status',1)->orderBy('oficina_id','ASC')->get();
                $pts = "";
                foreach ($clientes as $cliente) {
                    $fila = $cliente->nombre."|".$cliente->latitud."|".$cliente->longitud."|".$cliente->direccion."|".$cliente->personacontacto."|".$cliente->telefonocontacto."|".$cliente->id;
                    $pts.=$fila."$";
                }
                $pts = substr($pts, 0, -1);
            return view('admin.home',compact('clientes','colores','pts'));
        }
    }


}
