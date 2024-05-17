<div>
    @section('title')
    Registro de Asistencias
    @endsection
    @section('content_header')
    <div class="container-fluid">
        <h4>Registro de Asistencias</h4>
    </div>
    @endsection

    <div class="container-fluid">
        <div class="card">

            <div class="card-body">
                <label for="">Filtrar:</label>
                <div class="row">
                    <div class="col-12 col-md-3 mb-3">
                        {!! Form::select('cliente_id', $clientes, null,
                        ['class'=>'form-control','placeholder'=>'Seleccione un cliente','wire:model'=>'cliente_id']) !!}
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Desde</span>
                            </div>
                            <input type="date" class="form-control" wire:model='inicio' aria-label="inicio"
                                aria-describedby="basic-addon1">
                        </div>

                    </div>
                    <div class="col-12 col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Hasta</span>
                            </div>
                            <input type="date" class="form-control" wire:model='final' aria-label="final"
                                aria-describedby="basic-addon1">
                        </div>

                    </div>
                    <div class="col-12 col-md-3">
                        <select name="empleado_id" class="form-control" wire:model='empleado_id'>
                            <option value="">Todos</option>
                            @foreach ($empleados as $item)
                            <option value="{{$item->id}}">{{$item->nombre}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    @if (!is_null($resultados))
                    <div class="row w-100">
                        <div class="col-12 col-md-8 mb-3">
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-search"></i></span>
                                </div>
                                <input type="search" class="form-control" placeholder="Busqueda..."
                                    aria-label="Busqueda..." aria-describedby="basic-addon1"
                                    wire:model.debounce.500ms='search'>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mb-3">
                            <button class="btn btn-success btn-block" wire:click='exporExcel'><i
                                    class="fas fa-file-excel"></i>
                                Exportar</button>
                        </div>
                        <div class="col-12 col-md-2 mb-3">
                            <a href="{{route('pdf.asistencias')}}" class="btn btn-danger btn-block" target="_blank"><i
                                    class="fas fa-file-pdf"></i> Exportar</a>
                        </div>
                    </div>

                </div>

                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="vertical-align: middle">
                        <thead>
                            <tr class="table-info">
                                <th>ID</th>
                                <th>CLIENTE</th>
                                <th>GUARDIA</th>
                                <th>TURNO</th>
                                <th class="text-center">FECHA</th>
                                <th class="text-center">INGRESO</th>
                                <th class="text-center">SALIDA</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!is_null($resultados))
                            @forelse ($resultados as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->cliente}}</td>
                                <td>{{$item->empleado}}</td>
                                <td>{{$item->turno}}</td>
                                <td class="text-center">{{$item->fecha}}</td>
                                <td class="text-center">{{$item->ingreso}}</td>
                                <td class="text-center">{{$item->salida}}</td>

                                <td>
                                    <button class="btn btn-info btn-sm" title="Ver info"
                                        wire:click='verInfo({{$item->id}})' data-toggle='modal'
                                        data-target='#modalInfo'>
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="8">No se econtraron resultados.</td>
                            </tr>
                            @endforelse
                            @else
                            <tr>
                                <td class="text-center" colspan="8">No se econtraron resultados.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    @if (!is_null($resultados))
                    {{ $resultados->links() }}
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalInfoLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInfoLabel"><strong>INFO ASISTENCIA - ID:
                            {{$asistencia->id}}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div wire:loading>

                        <div class="spinner-border text-success" role="status">
                            <span class="sr-only">Cargando...</span>
                        </div>

                    </div>
                    <div wire:loading.remove>
                        <div class="row">
                            <div class="col-12 col-md-12">

                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <td><strong>CLIENTE:</strong></td>
                                        <td>{{$asistencia->cliente}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>GUARDIA:</strong></td>
                                        <td>{{$asistencia->empleado}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>TURNO:</strong></td>
                                        <td>{{$asistencia->turno}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>FECHA:</strong></td>
                                        <td>{{$asistencia->fecha}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>INGRESO:</strong></td>
                                        <td>{{$asistencia->ingreso}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>SALIDA:</strong></td>
                                        <td>{{$asistencia->salida}}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td><strong>CONTENIDO:</strong></td>
                                        <td>{{$novedade->contenido}}</td>
                                    </tr> --}}


                                </table>
                            </div>
                            {{-- <div class="col-12 col-md-6">
                                @if ($novedade->imgnovedades->count()>0)
                                <h6>CAPTURA:</h6>
                                @foreach ($novedade->imgnovedades as $item)
                                <img src="{{asset('storage/'.$item->url)}}" class="img-fluid img-thumbnail">
                                @endforeach

                                @else
                                <img src="{{asset('images/sinimagen.jpg')}}" class="img-fluid img-thumbnail"
                                    style="max-height: 400px;">
                                @endif
                            </div> --}}
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
</div>