@extends('layouts.app')

@section('template_title')
    Visita
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Visita') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('visitas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Nombre</th>
										<th>Docidentidad</th>
										<th>Residente</th>
										<th>Nrovivienda</th>
										<th>Motivo Id</th>
										<th>Otros</th>
										<th>Imgs</th>
										<th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visitas as $visita)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $visita->nombre }}</td>
											<td>{{ $visita->docidentidad }}</td>
											<td>{{ $visita->residente }}</td>
											<td>{{ $visita->nrovivienda }}</td>
											<td>{{ $visita->motivo_id }}</td>
											<td>{{ $visita->otros }}</td>
											<td>{{ $visita->imgs }}</td>
											<td>{{ $visita->estado }}</td>

                                            <td>
                                                <form action="{{ route('visitas.destroy',$visita->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('visitas.show',$visita->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('visitas.edit',$visita->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $visitas->links() !!}
            </div>
        </div>
    </div>
@endsection
