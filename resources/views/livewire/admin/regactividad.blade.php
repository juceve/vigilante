<div>
    @section('title')
        Registro de Pánico
    @endsection
    @section('content_header')
        <h4>Registro de Pánico</h4>
    @endsection

    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary  text-white">
                Listado de Actividad de Operadores
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Inicio</span>
                            </div>
                            <input type="date" class="form-control" wire:model='fechaI'>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Final</span>
                            </div>
                            <input type="date" class="form-control" wire:model='fechaF'>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <button class="btn btn-info btn-block" wire:click='buscar'>Buscar <i
                                class="fas fa-search"></i></button>
                    </div>
                </div>
                <hr>
                <div class="table-responsive" wire.ignore.self>
                    <table class="table table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Prioridad
                                </th>
                                <th>
                                    Operador
                                </th>
                                <th>
                                    Fecha - Hora
                                </th>
                                <th>
                                    Estado
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($actividades as $actividad)
                                <tr>
                                    <td>
                                        {{ $actividad->id }}
                                    </td>
                                    <td>
                                        @switch($actividad->prioridad)
                                            @case('ALTA')
                                                <span class="badge badge-pill badge-danger">{{ $actividad->prioridad }}</span>
                                            @break

                                            @case('NORMAL')
                                                <span class="badge badge-pill badge-primary">{{ $actividad->prioridad }}</span>
                                            @break

                                            @case('BAJA')
                                                <span
                                                    class="badge badge-pill badge-secondary">{{ $actividad->prioridad }}</span>
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                    <td>
                                        {{ $actividad->user->name }}
                                    </td>
                                    <td>
                                        {{ $actividad->fechahora }}
                                    </td>
                                    <td>
                                        @if ($actividad->visto)
                                            <span class="badge badge-pill badge-success">Revisado</span>
                                        @else
                                            <span class="badge badge-pill badge-warning">Sin Revisar</span>
                                        @endif
                                    </td>
                                    <td align="right">
                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#messageView"
                                            wire:click='cargaMensaje({{ $actividad->id }})'><i class="fas fa-eye"></i>
                                            Revisar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="messageView" tabindex="-1" aria-labelledby="messageViewLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageViewLabel">Detalles del Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Prioridad</label>
                                <input type="text" class="form-control bg-white" wire:model='prioridad' readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Fecha y Hora</label>
                                <input type="text" class="form-control bg-white" wire:model='fechahora' readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Operador</label>
                                <input type="text" class="form-control bg-white" wire:model='user' readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Estado</label>
                                <input type="text" class="form-control bg-white" wire:model='visto' readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Detalle</label>
                                <textarea readonly rows="2" class="form-control bg-white" wire:model='detalle'></textarea>
                            </div>
                        </div>
                    </div>

                    <label>Ubicación:</label>
                    <div id="mapa1" style="width: 100%;height: 350px;">
                        @if ($lat && $lng)
                            <iframe src="./ubicacion/{{ $lat }}/{{ $lng }}"
                                style="width: 100%; height: 100%" name="ubicacion"></iframe>
                        @endif

                    </div>

                    @if ($imagenes)
                        <div class="row">
                            @foreach ($imagenes as $item)
                                <div class="col col-12 col-md-3">
                                    <a href="#{{ $item->id }}">
                                        <img src="{{ asset('storage/' . $item->url) }}" style="height: 100px;">
                                    </a>
                                    <article class="light-box" id="{{ $item->id }}">
                                        {{-- <a href="#4" class="light-box-next"><i class="bi bi-arrow-left"></i></a> --}}
                                        <img src="{{ asset('storage/' . $item->url) }}" class="img-fluid">
                                        {{-- <a href="#2" class="light-box-next"><i class="bi bi-arrow-right"></i></a> --}}
                                        <a href="#" class="light-box-close">X</a>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script src="{{ asset('vendor/jquery/scripts.js') }}"></script>
    @include('vendor.mensajes')
@endsection
