@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="container text-center " style="margin-top: 110px;">
        <h4 class="text-secondary">Bienvenido!</h4>
        <h1 style="color: #1abc9c"><strong>{{ Auth::user()->name }}</strong></h1>
    </div>
    <div class="container">
        @if ($designaciones)
            <div class="row">
                <div class="col-6">
                    <small>Empresa: <b><span
                                class="text-info">{{ $designaciones->turno->cliente->nombre }}</span></b></small>
                </div>
                <div class="col-6 text-end">
                    <small>Turno: <b><span class="text-info">{{ $designaciones->turno->nombre }}</span></b></small>
                </div>
            </div>
        @endif
        <div class="container text-center mb-3">

        </div>
    </div>
    <hr>

    @if ($designaciones)
        @if (esDiaLibre($designaciones->id))
            <div class="alert alert-success text-center" role="alert">
                HOY ES SU DIA LIBRE
            </div>
        @else
            @if (yaMarque($designaciones->id))
                @if (yaMarque($designaciones->id) > 1)
                    <section class="page-section portfolio p-0" id="portfolio">
                        <div class="container">
                            <!-- Portfolio Grid Items-->
                            <div class="row justify-content-center">
                                <!-- Portfolio Items -->
                                <div class="col col-6 col-md-6 col-lg-4 mb-5">
                                    <div class="portfolio-item mx-auto border list-group-item-pink text-center">
                                        <a href="{{ route('vigilancia.panico') }}">
                                            <img class="w-50 py-4" src="{{ asset('web/assets/img/home/boton-rojo.png') }}"
                                                alt="..." />
                                            <h6 class="text-pink">PANICO</h6>
                                        </a>
                                    </div>
                                </div>
                                <div class="col col-6 col-md-6 col-lg-4 mb-5">
                                    <div class="portfolio-item mx-auto border list-group-item-warning text-center">
                                        <a href="{{ route('vigilancia.ronda') }}">
                                            <img class="w-50 py-4" src="{{ asset('web/assets/img/home/guardia.png') }}"
                                                alt="..." />
                                            <h6 class="text-warning">RONDA</h6>
                                        </a>
                                    </div>
                                </div>
                                <div class="col col-6 col-md-6 col-lg-4 mb-5">
                                    <div class="portfolio-item mx-auto border list-group-item-success text-center">
                                        <a href="{{ route('vigilancia.hombre-vivo') }}">
                                            <img class="w-50 py-4" src="{{ asset('web/assets/img/home/hombre-vivo.png') }}"
                                                alt="..." />
                                            <h6 class="text-success">HOMBRE VIVO</h6>
                                        </a>
                                    </div>
                                </div>
                                <div class="col col-6 col-md-6 col-lg-4 mb-5">
                                    <div class="portfolio-item mx-auto border list-group-item-blue text-center">
                                        <a href="{{ route('vigilancia.novedades') }}">
                                            <img class="w-50 py-4" src="{{ asset('web/assets/img/home/news.png') }}"
                                                alt="..." />
                                            <h6 class="text-blue">NOVEDADES</h6>
                                        </a>
                                    </div>
                                </div>
                                {{-- End Portfolio Items --}}
                            </div>
                        </div>
                    </section>
                @else
                    <div class="alert alert-warning text-center" role="alert">
                        YA REGISTRÓ SU SALIDA.
                    </div>
                @endif
            @else
                @livewire('vigilancia.marca-ingreso', ['designacione_id' => $designaciones->id])
            @endif
            <hr>
            @if (yaMarque($designaciones->id))
                @if (yaMarque($designaciones->id) > 1)
                    @livewire('vigilancia.marca-salida', ['designacione_id' => $designaciones->id])
                @endif
            @endif
        @endif
    @else
        <div class="alert alert-danger text-center" role="alert">
            No exiten asignaciones habilitadas.
        </div>
    @endif


    <script>
        setTimeout(() => {
            location.reload();
        }, 60000);
    </script>
@endsection
