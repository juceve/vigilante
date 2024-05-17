@extends('layouts.customers')

@section('page_header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Perfil del Personal</h1>

    <a href="/home" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm"></i> Volver</a>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td>
                            <strong>Nombres:</strong>
                        </td>
                        <td>
                            {{ $empleado->nombres }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Apellidos:</strong>
                        </td>
                        <td>
                            {{ $empleado->apellidos }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Nacionalidad:</strong>
                        </td>
                        <td>
                            {{ $empleado->nacionalidad }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Telefono:</strong>
                        </td>
                        <td>
                            {{ $empleado->telefono }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Area:</strong>
                        </td>
                        <td>
                            {{ $empleado->area->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Cubre Relevos:</strong>
                        </td>
                        <td>
                            @if ($empleado->cubrerelevos)
                            <span class="badge bg-success text-white">SI</span>
                            @else
                            <span class="badge bg-secondary text-white">NO</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-6 text-center">
                <label>Imagen de Perfil</label> <br>
                @if ($empleado->imgperfil)
                <img src="{{asset('storage/'.$empleado->imgperfil)}}" class="img-thumbnail" style="max-height: 260px;">
                @else
                <img src="{{asset('images/no-perfil.jpg')}}" class="img-thumbnail" style="max-height: 260px;">
                @endif
            </div>
        </div>
    </div>
</div>
@endsection