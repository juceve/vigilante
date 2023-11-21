<div>
    @section('title')
        Generador de Documentos
    @endsection
    @section('content_header')
        <h4>Generador de Documentos</h4>
    @endsection

    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-info">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                        <strong>Seleccione un Modelo</strong>
                    </span>

                    <div class="float-right">
                        <a href="javascript:history.back()" class="btn btn-info btn-sm float-right" data-placement="left">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="informe-tab" data-toggle="pill" href="#informe"
                                    role="tab" aria-controls="informe" aria-selected="true">INFORME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="memorandum-tab" data-toggle="pill" href="#memorandum"
                                    role="tab" aria-controls="memorandum" aria-selected="false">MEMORANDUM</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="cotizacion-tab" data-toggle="pill" href="#cotizacion"
                                    role="tab" aria-controls="cotizacion" aria-selected="false">COTIZACIÓN</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="recibo-tab" data-toggle="pill" href="#recibo" role="tab"
                                    aria-controls="recibo" aria-selected="false">RECIBO</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="informe" role="tabpanel"
                                aria-labelledby="informe-tab">

                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label>Cite:</label>
                                        <input type="text" class="form-control" wire:model.defer='i_cite'>
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-group{{ $errors->has('selID') ? ' has-error' : '' }}">
                                            {!! Form::label('selID', 'Cliente:') !!}
                                            {!! Form::select('selID', $clientes, null, [
                                                'id' => 'selID',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'placeholder' => 'Seleccione un Cliente',
                                                'wire:model' => 'selID',
                                            ]) !!}
                                            <small class="text-danger">{{ $errors->first('selID') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <label>Representante:</label>
                                        <input type="text" class="form-control" wire:model='i_representante'>
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <label>Objeto:</label>
                                        <input type="text" class="form-control" wire:model.defer='i_objeto'>
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <label>Fecha:</label>
                                        <input type="date" class="form-control" wire:model.defer='i_fecha'>
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <label>Referencia:</label>
                                        <input type="text" class="form-control" wire:model.defer='i_referencia'>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label>Punto:</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Descripción"
                                                aria-label="causal" aria-describedby="button-addon2"
                                                wire:model='i_causal'>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="button"
                                                    id="button-addon2" wire:click='i_agregarCausal'>Agregar <i
                                                        class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($causales)
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm" style="font-size: 14px;">
                                                    <thead class="table-info">
                                                        <tr>
                                                            <td align="center">DETALLES</td>
                                                            <td></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $i = 0;
                                                        @endphp
                                                        @foreach ($causales as $item)
                                                            <tr>
                                                                <td>{{ $item }}</td>
                                                                <td align="right" style="width: 15px;"><button
                                                                        class="btn btn-sm btn-outline-danger"
                                                                        title="Eliminar"
                                                                        wire:click='delICausal({{ $i }})'><i
                                                                            class="fas fa-trash"></i></button></td>
                                                            </tr>
                                                            @php
                                                                $i++;
                                                            @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-12 col-md-6">
                                        <button class="btn btn-primary btn-block" wire:click='generarInforme'>Generar Informe <i class="fas fa-file-import"></i></button>
                                    </div>
                                </div>





                            </div>
                            <div class="tab-pane fade" id="memorandum" role="tabpanel"
                                aria-labelledby="memorandum-tab">
                                Memorandum
                            </div>
                            <div class="tab-pane fade" id="cotizacion" role="tabpanel"
                                aria-labelledby="cotizacion-tab">
                                Cotizacion
                            </div>
                            <div class="tab-pane fade" id="recibo" role="tabpanel" aria-labelledby="recibo-tab">
                                Recibo
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                {{-- <div class="row">
                    
                    <div class="col-12 col-md-3">
                        <button class="btn btn-outline-success py-3 btn-block">Informe</button>
                    </div>
                    <div class="col-12 col-md-3">
                        <button class="btn btn-outline-success py-3 btn-block">Memorandum</button>
                    </div>
                    <div class="col-12 col-md-3">
                        <button class="btn btn-outline-success py-3 btn-block">Cotización</button>
                    </div>
                    <div class="col-12 col-md-3">
                        <button class="btn btn-outline-success py-3 btn-block">Recibo</button>
                    </div>
                </div> --}}
            </div>

        </div>
    </div>
</div>
