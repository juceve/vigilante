@extends('layouts.app')

@section('template_title')
    Turno
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Turno') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('turnos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Cliente Id</th>
										<th>Horainicio</th>
										<th>Horafin</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($turnos as $turno)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $turno->nombre }}</td>
											<td>{{ $turno->cliente_id }}</td>
											<td>{{ $turno->horainicio }}</td>
											<td>{{ $turno->horafin }}</td>

                                            <td>
                                                <form action="{{ route('turnos.destroy',$turno->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('turnos.show',$turno->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('turnos.edit',$turno->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $turnos->links() !!}
            </div>
        </div>
    </div>
@endsection
