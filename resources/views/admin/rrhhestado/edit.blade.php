@extends('adminlte::page')

@section('template_title')
    {{ __('Update') }} Rrhhestado
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Rrhhestado</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rrhhestados.update', $rrhhestado->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.rrhhestado.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
