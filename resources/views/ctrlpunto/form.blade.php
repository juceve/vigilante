<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $ctrlpunto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('hora') }}
            {{ Form::text('hora', $ctrlpunto->hora, ['class' => 'form-control' . ($errors->has('hora') ? ' is-invalid' : ''), 'placeholder' => 'Hora']) }}
            {!! $errors->first('hora', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('latitud') }}
            {{ Form::text('latitud', $ctrlpunto->latitud, ['class' => 'form-control' . ($errors->has('latitud') ? ' is-invalid' : ''), 'placeholder' => 'Latitud']) }}
            {!! $errors->first('latitud', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('longitud') }}
            {{ Form::text('longitud', $ctrlpunto->longitud, ['class' => 'form-control' . ($errors->has('longitud') ? ' is-invalid' : ''), 'placeholder' => 'Longitud']) }}
            {!! $errors->first('longitud', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('turno_id') }}
            {{ Form::text('turno_id', $ctrlpunto->turno_id, ['class' => 'form-control' . ($errors->has('turno_id') ? ' is-invalid' : ''), 'placeholder' => 'Turno Id']) }}
            {!! $errors->first('turno_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>