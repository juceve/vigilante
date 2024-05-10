<div>
    @section('title')
    TAREAS
    @endsection
    <div class="row mb-3">
        <div class="col-2">
            <a href="{{ route('home') }}" class="text-silver"><i class="fas fa-arrow-circle-left fa-2x"></i></a>
        </div>
        <div class="col-8">
            <h6 class="text-secondary text-center">TAREAS</h6>
        </div>
        <div class="col-2"></div>
    </div>

    <div class="content mt-3">
        <b>
            <h3 class="text-primary text-center">{{ $designacion->turno->cliente->nombre }}</h3>
        </b>
        <hr>
        <h6 class="text-center mb-3">TAREAS PENDIENTES</h6>
        {{-- <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
            <input type="search" class="form-control" placeholder="Busqueda..." wire:model.debounce.500ms='search'
                id="search">
        </div> --}}

        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="font-size: 12px; vertical-align: middle">
                <thead>
                    <tr class="table-primary text-center fw-bold">
                        <td style="width: 88px;">FECHA</td>
                        {{-- <td>OPERADOR</td> --}}
                        <td>DESCRIPCIÓN</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tareas as $item)
                    <tr>
                        <td class="text-center">{{$item->fecha}}</td>
                        {{-- <td class="text-center">{{$empleado->nombres." ".$empleado->apellidos}}</td> --}}
                        <td>{{$item->contenido}}</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalInfo"
                                wire:click='cargarTarea({{$item->id}})' style="font-size: 12px;" title="Procesar">
                                <i class="fas fa-check-double"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center"><i>No se encontraron resultados.</i></td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalInfoLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInfoLabel">Info Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        @if ($tarea)
                        <tr class="table-success">
                            <td><strong>Fecha:</strong></td>
                            <td>{{$tarea->fecha}}</td>
                        </tr>
                        <tr>
                            <td><strong>Cliente:</strong></td>
                            <td>{{$tarea->cliente->nombre}}</td>
                        </tr>
                        <tr>
                            <td><strong>Operador:</strong></td>
                            <td>{{$tarea->empleado->nombres}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <strong>Descripción:</strong><br>
                                {{$tarea->contenido}}
                            </td>
                        </tr>
                        @endif


                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-ban"></i>
                        Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click='procesar' wire:loading.attr="disabled">
                        Finalizar Tarea <i class="fas fa-check-double"></i>
                        <div wire:loading wire:target="procesar">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>