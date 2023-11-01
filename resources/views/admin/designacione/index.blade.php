@extends('adminlte::page')

@section('title')
    Designaciones
@endsection
@section('content_header')
    <h4>Designaciones</h4>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Listado de Designaciones
                            </span>

                            <div class="float-right">
                                <a href="{{ route('designaciones.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    Nuevo <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered dataTable">
                                <thead class="table-info">
                                    <tr>
                                        <th>No</th>

                                        <th>EMPLEADO</th>
                                        <th>CLIENTE</th>
                                        <th>TURNO</th>
                                        <th>INICIO</th>
                                        <th>FINAL</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($designaciones as $designacione)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $designacione->empleado->nombres . ' ' . $designacione->empleado->apellidos }}
                                            </td>
                                            <td>{{ $designacione->turno->cliente->nombre }}
                                            <td>{{ $designacione->turno->nombre }}</td>
                                            <td>{{ $designacione->fechaInicio }}</td>
                                            <td>{{ $designacione->fechaFin }}</td>

                                            <td align="right">
                                                <form action="{{ route('designaciones.destroy', $designacione->id) }}"
                                                    method="POST" onsubmit="return false" class="delete">
                                                    <a class="btn btn-sm btn-outline-info"
                                                        href="{{ route('designaciones.show', $designacione->id) }}"
                                                        title="Cumplimiento de Rondas">
                                                        <i class="fas fa-street-view"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-outline-warning"
                                                        href="{{ route('designaciones.edit', $designacione->id) }}"
                                                        title="Editar"><i class="fa fa-fw fa-edit"></i></a>

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                                        title="Eliminar de la DB"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- {!! $designaciones->links() !!} --}}
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('vendor/jquery/scripts.js') }}"></script>
    @include('vendor.mensajes')
@endsection
