@extends('adminlte::page')

@section('title')
    Información de Area
@endsection
@section('content_header')
    <h4>Información de Area</h4>
@endsection
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Datos
                            </span>

                             <div class="float-right">
                                <a href="javascript:history.back()" class="btn btn-info btn-sm float-right"  data-placement="left">
                                  <i class="fas fa-arrow-left"></i> Volver
                                </a>
                              </div>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $area->nombre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
