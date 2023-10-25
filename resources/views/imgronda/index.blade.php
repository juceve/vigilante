@extends('layouts.app')

@section('template_title')
    Imgronda
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Imgronda') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('imgrondas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Regronda Id</th>
										<th>Url</th>
										<th>Tipo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($imgrondas as $imgronda)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $imgronda->regronda_id }}</td>
											<td>{{ $imgronda->url }}</td>
											<td>{{ $imgronda->tipo }}</td>

                                            <td>
                                                <form action="{{ route('imgrondas.destroy',$imgronda->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('imgrondas.show',$imgronda->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('imgrondas.edit',$imgronda->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $imgrondas->links() !!}
            </div>
        </div>
    </div>
@endsection
