<div>
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
                @error('selID')
                    <small class="text-danger">Debe seleccionar un Cliente</small>
                @enderror
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
                <input type="text" class="form-control" placeholder="Descripción" aria-label="causal"
                    aria-describedby="button-addon2" wire:model='i_causal'>
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button" id="button-addon2"
                        wire:click='i_agregarCausal'>Agregar <i class="fas fa-plus"></i></button>
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
                                            class="btn btn-sm btn-outline-danger" title="Eliminar"
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
            <button class="btn btn-primary btn-block" wire:click='generarInforme'>Generar Informe <i
                    class="fas fa-file-import"></i></button>
        </div>
    </div>
</div>
