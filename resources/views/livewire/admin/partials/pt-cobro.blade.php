<div>
    <div class="row">
        
        <div class="col-12 col-md-6 mb-3">
            <label>Fecha carta:</label>
            <input type="date" class="form-control" wire:model.defer='c_fecha'>
        </div>

        <div class="col-12 col-md-3 mb-3">
            <label>Mes cobro:</label>
            <select name="mescobro" id="mescobro" class="form-control" wire:model='c_mescobro'>
                <option value="">Seleccione un Mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            @error('c_mescobro')
                <small class="text-danger">Debe seleccionar un mes</small>
            @enderror
        </div>

        <div class="col-12 col-md-3 mb-3">
            <label>Gestión:</label>
            <select name="gestion" id="gestion" class="form-control" wire:model='c_gestion'>
                <option value="">Seleccione una Gestión</option>
                <option value="{{date('Y')}}">{{date('Y')}}</option>
                <option value="{{date('Y')-1}}">{{date('Y')-1}}</option>
                <option value="{{date('Y')-2}}">{{date('Y')-2}}</option>
                <option value="{{date('Y')-3}}">{{date('Y')-3}}</option>        
            </select>
            @error('c_gestion')
                <small class="text-danger">Debe seleccionar una gestión</small>
            @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label>Nro. Factura:</label>
            <input type="text" class="form-control" wire:model.defer='c_factura'>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label>Monto Bs.:</label>
            <input type="text" class="form-control" wire:model.defer='c_monto'>
        </div>

        <div class="col-12 col-md-6 mb-3">
            {!! Form::label('selID', 'Cliente:') !!}
            {!! Form::select('selID', $clientes, null, [
                'id' => 'selID',
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Seleccione un Cliente',
                'wire:model' => 'selID',
            ]) !!}
            @error('selID')
                <small class="text-danger">Debe seleccionar un cliente</small>
            @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label>Representante:</label>
            <input type="text" class="form-control" wire:model='c_representante'>
        </div>

        <div class="col-12 col-md-6">
            <button class="btn btn-primary btn-block" wire:click='generarInforme'>Generar Cobro <i
                    class="fas fa-file-import"></i></button>
        </div>
    </div>
</div>
