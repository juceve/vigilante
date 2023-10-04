@extends('layouts.app')

@section('template_title')
    {{ $designacione->name ?? "{{ __('Show') Designacione" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Designacione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('designaciones.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Empleado Id:</strong>
                            {{ $designacione->empleado_id }}
                        </div>
                        <div class="form-group">
                            <strong>Turno Id:</strong>
                            {{ $designacione->turno_id }}
                        </div>
                        <div class="form-group">
                            <strong>Fechainicio:</strong>
                            {{ $designacione->fechaInicio }}
                        </div>
                        <div class="form-group">
                            <strong>Fechafin:</strong>
                            {{ $designacione->fechaFin }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $designacione->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
