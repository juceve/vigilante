@extends('layouts.app')

@section('template_title')
    {{ $imgronda->name ?? "{{ __('Show') Imgronda" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Imgronda</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('imgrondas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Regronda Id:</strong>
                            {{ $imgronda->regronda_id }}
                        </div>
                        <div class="form-group">
                            <strong>Url:</strong>
                            {{ $imgronda->url }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $imgronda->tipo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
