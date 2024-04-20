<div>
    @section('title')
    Registro de Visistas
    @endsection
    @section('content_header')
    <h4>Registro de Visitas</h4>
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
                            <span class="input-group-text" id="basic-addon1">Desde</span>
                            <input type="date" class="form-control" wire:model='inicio' aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Hasta</span>
                            <input type="date" class="form-control" wire:model='final' aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        {!! Form::select('estado', [''=>'Todos','1'=>'En proceso','0'=>'Finalizado'],
                        null, ['class'=>'form-control','wire:model'=>'estado']) !!}
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    @if (!is_null($resultados))
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="Busqueda..." aria-label="Busqueda..."
                            aria-describedby="basic-addon1" wire:model.debounce.500ms='search'>
                    </div>
                    @endif
                    <table class="table table-bordered table-striped" style="vertical-align: middle">
                        <thead>
                            <tr class="table-info">
                                <th>VISITANTE</th>
                                <th>DOC. IDENTIDAD</th>
                                <th>RESIDENTE</th>
                                <th>FECHA - HORA</th>
                                <th>ESTADO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!is_null($resultados))
                            @forelse ($resultados as $item)
                            <tr>
                                <td>{{$item->visitante}}</td>
                                <td>{{$item->docidentidad}}</td>
                                <td>{{$item->residente}}</td>
                                <td>{{$item->fechaingreso.' '.$item->horaingreso}}</td>
                                <td>
                                    @if ($item->estado)
                                    <span class="badge badge-pill badge-success">En proceso</span>
                                    @else
                                    <span class="badge badge-pill badge-secondary">Finalizado</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" title="Ver info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="6">No se econtraron resultados.</td>
                            </tr>
                            @endforelse
                            @else
                            <tr>
                                <td class="text-center" colspan="6">No se econtraron resultados.</td>
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
</div>