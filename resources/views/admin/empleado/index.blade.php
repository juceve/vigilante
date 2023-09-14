@extends('adminlte::page')

@section('title')
    Empleados
@endsection
@section('content_header')
    <h4>Empleados</h4>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Listado de Empleados
                            </span>

                            <div class="float-right">
                                <a href="{{ route('empleados.create') }}" class="btn btn-info btn-sm float-right"
                                    data-placement="left">
                                    Nuevo <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{--   @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif --}}

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover dataTable">
                                <thead class="thead table-info">
                                    <tr>
                                        <th>No</th>

                                        <th>Nombres</th>
                                        <th>Apellidos</th>

                                        <th>Area</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empleados as $empleado)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $empleado->nombres }}</td>
                                            <td>{{ $empleado->apellidos }}</td>
                                            <td>{{ $empleado->area->nombre }}</td>

                                            <td align="right">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                                        data-toggle="dropdown">Opciones</button>
                                                    {{-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> --}}
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <form
                                                            action="{{ route('empleados.destroy', $empleado->id) }}"method="POST" class="delete"
                                                            onsubmit="return false">
                                                            <a class="dropdown-item"
                                                                href="{{ route('empleados.show', $empleado->id) }}"><i
                                                                    class="fa fa-fw fa-eye text-secondary"></i> Info</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('empleados.edit', $empleado->id) }}"><i
                                                                    class="fa fa-fw fa-edit text-secondary"></i> Editar</a>

                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="fas fa-fw fa-trash text-secondary"></i>
                                                                Eliminar de la DB
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $empleados->links() !!}
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('vendor/jquery/scripts.js') }}"></script>
    @include('vendor.mensajes')
@endsection
