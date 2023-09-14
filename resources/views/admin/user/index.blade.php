@extends('adminlte::page')

@section('title')
    Usuarios
@endsection
@section('content_header')
    <h4>Usuarios</h4>
@endsection
@section('content')
    <div class="container-fluid mb-3">
        <div class="card">
            <div class="card-header bg-info">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                        Listado de Usuarios
                    </span>

                    {{-- <div class="float-right">
                        <a href="{{ route('areas.create') }}" class="btn btn-info btn-sm float-right"
                            data-placement="left">
                            Nuevo <i class="fas fa-plus"></i>
                        </a>
                    </div> --}}
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered dataTable">
                    <thead class="table-info">
                        <tr>
                            <th>
                                No
                            </th>
                            <th>
                                Nombre
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Plantilla
                            </th>
                            <th>
                                Estado
                            </th>
                            <th>

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    {{ $i++ }}
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->template }}
                                </td>
                                <td>
                                    @if ($user->status)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-secondary">Inactivo</span>
                                    @endif
                                </td>
                                <td align="right">
                                    <button class="btn btn-info btn-sm" title="Reset Password">
                                        <i class="fas fa-key"></i>                                        
                                    </button>
                                    <button class="btn btn-warning btn-sm text-white" title="Cambiar Estado">
                                        <i class="fas fa-sync-alt"></i>                                        
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('vendor/jquery/scripts.js')}}"></script>
@endsection