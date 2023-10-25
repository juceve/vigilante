@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="container text-center mb-4">
        <h4 class="text-secondary">Bienvenido!</h4>
        <h1 style="color: #1abc9c"><strong>{{ Auth::user()->name }}</strong></h1>
    </div>
    @if ($designaciones)
        <div class="container text-center mb-3">

            <table class="table table-bordered text-info">
                <tr>
                    <th>
                        <strong>{{ $designaciones->turno->cliente->nombre }}</strong>
                    </th>
                    <th>
                        <strong>{{ $designaciones->turno->nombre }}</strong>
                    </th>
                </tr>
            </table>



        </div>
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
                                <img class="w-50 py-4" src="{{ asset('web/assets/img/home/news.png') }}" alt="..." />
                                <h6 class="text-blue">NOVEDADES</h6>
                            </a>
                        </div>
                    </div>
                    {{-- End Portfolio Items --}}
                </div>
            </div>
        </section>
    @else
        <div class="alert alert-danger" role="alert">
            No exiten asignaciones habilitadas.
        </div>
    @endif

@endsection
