@extends('layouts.app')

@section('template_title')
    {{ $ctrlpunto->name ?? "{{ __('Show') Ctrlpunto" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Ctrlpunto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ctrlpuntos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $ctrlpunto->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Hora:</strong>
                            {{ $ctrlpunto->hora }}
                        </div>
                        <div class="form-group">
                            <strong>Latitud:</strong>
                            {{ $ctrlpunto->latitud }}
                        </div>
                        <div class="form-group">
                            <strong>Longitud:</strong>
                            {{ $ctrlpunto->longitud }}
                        </div>
                        <div class="form-group">
                            <strong>Turno Id:</strong>
                            {{ $ctrlpunto->turno_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
