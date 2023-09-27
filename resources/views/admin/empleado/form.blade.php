<div class="box box-info padding-1">
    <div class="box-body">

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('nombres') }}
                    {{ Form::text('nombres', $empleado->nombres, ['class' => 'form-control' . ($errors->has('nombres') ? ' is-invalid' : ''), 'placeholder' => 'Nombres']) }}
                    {!! $errors->first('nombres', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('apellidos') }}
                    {{ Form::text('apellidos', $empleado->apellidos, ['class' => 'form-control' . ($errors->has('apellidos') ? ' is-invalid' : ''), 'placeholder' => 'Apellidos']) }}
                    {!! $errors->first('apellidos', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group{{ $errors->has('tipodocumento_id') ? ' has-error' : '' }}">
                <label for="">Tipo Documento</label>
                {!! Form::select('tipodocumento_id', $tipodocs, $empleado->tipodocumento_id, ['id' => 'tipodocumento_id', 'class' => 'form-control', 'required' => 'required','placeholder'=>'Seleccione una opción']) !!}
                <small class="text-danger">{{ $errors->first('tipodocumento_id') }}</small>
                </div>
                {{-- <div class="form-group">
                    {{ Form::label('Tipo Documento') }}
                    {{ Form::text('tipodocumento_id', $empleado->tipodocumento_id, ['class' => 'form-control' . ($errors->has('tipodocumento_id') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Documento']) }}
                    {!! $errors->first('tipodocumento_id', '<div class="invalid-feedback">:message</div>') !!}
                </div> --}}
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('Nro. Documento') }}
                    {{ Form::text('cedula', $empleado->cedula, ['class' => 'form-control' . ($errors->has('cedula') ? ' is-invalid' : ''), 'placeholder' => 'Nro. Documento']) }}
                    {!! $errors->first('cedula', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('nacionalidad') }}
                    {{ Form::text('nacionalidad', $empleado->nacionalidad, ['class' => 'form-control' . ($errors->has('nacionalidad') ? ' is-invalid' : ''), 'placeholder' => 'Nacionalidad']) }}
                    {!! $errors->first('nacionalidad', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('direccion') }}
                    {{ Form::text('direccion', $empleado->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
                    {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('telefono') }}
                    {{ Form::text('telefono', $empleado->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
                    {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('email') }}
                    {{ Form::text('email', $empleado->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Correo']) }}
                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('area') }}
                    {{-- {{ Form::text('area_id', $empleado->area_id, ['class' => 'form-control' . ($errors->has('area_id') ? ' is-invalid' : ''), 'placeholder' => 'Area Id']) }} --}}

                    {!! Form::select('area_id', $areas, $empleado->area_id, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Seleccione una opción']) !!}

                    {!! $errors->first('area_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-12 col-md-6 ">
                <div class="form-group">
                    <label for="">Usuario</label>
                    @if ($empleado->user_id)
                        <div class="form-group">
                            <span class="badge bg-success">Generado</span>
                        </div>
                    @else
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="generarusuario">
                            <label class="form-check-label">Generar usuario</label> <br><small
                                class="text-info">(Tomando datos del correo
                                y Nro. Documento)</small>
                        </div>
                    @endif
                </div>

                <div class="form-group d-none">
                    {{ Form::label('user_id') }}
                    {{ Form::text('user_id', $empleado->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
                    {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

        </div>
        <div class="">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
        </div>

    </div>
</div>
