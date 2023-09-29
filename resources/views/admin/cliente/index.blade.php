@extends('adminlte::page')

@section('title')
    Clientes
@endsection
@section('content_header')
    <h4>Clientes</h4>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Listado de Clientes
                            </span>

                            <div class="float-right">
                                <a href="{{ route('clientes.create') }}" class="btn btn-info btn-sm float-right"
                                    data-placement="left">
                                    Nuevo <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover dataTable">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th>Oficina</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $cliente->nombre }}</td>
                                            <td>{{ $cliente->direccion }}</td>
                                            <td>{{ $cliente->oficina->nombre }}</td>
                                            <td>
                                                @if ($cliente->status)
                                                    <span class="badge badge-pill badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-pill badge-secondary">Inactivo</span>
                                                @endif
                                            </td>
                                            <td align="right">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                                        data-toggle="dropdown">Opciones</button>
                                                    {{-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> --}}
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <form
                                                            action="{{ route('clientes.destroy', $cliente->id) }}"method="POST"
                                                            class="delete" onsubmit="return false">
                                                            <a class="dropdown-item"
                                                                href="{{ route('clientes.show', $cliente->id) }}"><i
                                                                    class="fa fa-fw fa-eye text-secondary"></i> Info</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('clientes.edit', $cliente->id) }}"><i
                                                                    class="fa fa-fw fa-edit text-secondary"></i> Editar</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.turnos-cliente', $cliente->id) }}"><i class="fas fa-clock text-secondary"></i> Turnos</a>
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
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('vendor/jquery/scripts.js') }}"></script>
    @include('vendor.mensajes')
@endsection
