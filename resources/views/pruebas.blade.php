@extends('adminlte::page')

@section('content')
    <div class="container">
        @livewire('datatables', ['tabla' => 'citememorandums', 'campos' => ['cite', 'fecha', 'empleado', 'estado'], 'titulos' => ['cite', 'fecha', 'empleado', 'estado'], 'condiciones' => []])

    </div>
@endsection
