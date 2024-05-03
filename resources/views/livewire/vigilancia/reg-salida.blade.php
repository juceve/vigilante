<div>
    @section('title')
    SALIDAS
    @endsection
    <div class="row mb-3">
        <div class="col-2">
            <a href="{{ route('vigilancia.panelvisitas',$designacion->id) }}" class="text-silver"><i
                    class="fas fa-arrow-circle-left fa-2x"></i></a>
        </div>
        <div class="col-8">
            <h6 class="text-secondary text-center">SALIDAS</h6>
        </div>
        <div class="col-2"></div>
    </div>

    <div class="content mt-3">
        <b>
            <h3 class="text-primary text-center">{{ $designacion->turno->cliente->nombre }}</h3>
        </b>
        <hr>
        <h6 class="text-center">VISITAS EN PROCESO</h6>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
            <input type="search" class="form-control" placeholder="Busqueda..." wire:model.debounce.500ms='search'
                id="search">
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="font-size: 12px; vertical-align: middle">
                <thead>
                    <tr class="table-primary text-center fw-bold">
                        <td>VISITANTE</td>
                        <td>CEDULA</td>
                        <td>INGRESO</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($visitas as $item)
                    <tr>
                        <td>{{$item->visitante}}</td>
                        <td class="text-center">{{$item->docidentidad}}</td>
                        <td class="text-center">{{$item->fechaingreso. " ".$item->horaingreso}}</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalInfo"
                                wire:click='cargarVisita({{$item->id}})' style="font-size: 12px;">
                                Ver <i class="fas fa-eye"></i>
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
                    <h5 class="modal-title" id="modalInfoLabel">Info Visita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='reiniciar'></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr class="table-success">
                            <td><strong>Ingreso:</strong></td>
                            <td>{{$created_at}}</td>
                        </tr>
                        <tr>
                            <td><strong>Visitante:</strong></td>
                            <td>{{$nombrevisitante}}</td>
                        </tr>
                        <tr>
                            <td><strong>Doc. Identidad:</strong></td>
                            <td>{{$docidentidad}}</td>
                        </tr>
                        <tr>
                            <td><strong>Residente:</strong></td>
                            <td>{{$residente}}</td>
                        </tr>
                        <tr>
                            <td><strong>Nro. Vivienda:</strong></td>
                            <td>{{$nrovivienda}}</td>
                        </tr>
                        <tr>
                            <td><strong>Motivo visita:</strong></td>
                            <td>{{$motivo}}</td>
                        </tr>
                        @if ($otros!="")
                        <tr>
                            <td><strong>Otros:</strong></td>
                            <td>{{$otros}}</td>
                        </tr>
                        @endif
                        <tr>
                            <td><strong>Observaciones:</strong></td>
                            <td>
                                <input type="search" class="form-control" wire:model='observaciones' />
                            </td>
                        </tr>
                    </table>
                    @if ($img)
                    <div class="d-flex justify-content-center">
                        <img src="{{asset('storage/'.$img)}}" class="img-fluid" style="max-height: 150px;">
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click='reiniciar'>Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click='marcarSalida'
                        wire:loading.attr="disabled">
                        Marcar Salida
                        <div wire:loading wire:target="marcarSalida">
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
@section('js')
<script>
    document.getElementById('search').focus();
</script>
@endsection