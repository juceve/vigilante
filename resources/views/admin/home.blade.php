@extends('adminlte::page')

@section('title')
    Inicio
@endsection
@section('content_header')
    <h4>CLIENTES REGISTRADOS</h4>
@endsection
@section('content')
    <div class="content mb-3">
        <div class="row">
            <div class="col col-12 col-md-3">
                <div class="card">
                    <div class="card-body table-responsive p-0" style="height: 420px;">
                        <table class="table table-striped" style="font-size: 13px;">
                            <thead class="table-primary">
                                <tr>
                                    <th>
                                        EMPRESAS
                                    </th>
                                    <th class="text-right">
                                        OFICINA
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input custom-control-input-{{ $colores[$i] }}"
                                                    type="radio" id="{{ $cliente->id }}" checked="">
                                                <label for="{{ $cliente->id }}" class="custom-control-label"><a
                                                        href="{{ route('clientes.show', $cliente->id) }}"
                                                        class="text-dark">{{ $cliente->nombre }}</a></label>
                                            </div>
                                        </td>
                                        <td align="right">
                                            {{ $cliente->oficina->nombre }}
                                        </td>
                                    </tr>
                                    @php
                                        if ($i == 5) {
                                            $i = 0;
                                        } else {
                                            $i++;
                                        }
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div id="mi_mapa" style="width: 100%; height: 380px;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('plugins.OpenStreetMap', true)
@section('js')
    <script>
        let map = L.map('mi_mapa').setView([-17.7817999, -63.1825485], 12)

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy;'
        }).addTo(map);

        var arr1 = "{{ $pts }}";
        arr1 = arr1.split('$');
        const puntos = [];

        var myIcon = L.icon({
            iconUrl: "{{ asset('images/punt.png') }}",
            iconSize: [35, 35],
            iconAnchor: [35, 35],
            popupAnchor: [-15, -30],
        });

        for (let i = 0; i < arr1.length; i++) {
            const pt = arr1[i].split("|");
            puntos[i] = pt;
            L.marker([pt[1], pt[2]]).addTo(map).bindPopup('<h6>' + pt[0] + '</h6><small>' + pt[3] +
                '</small><p><a href="./admin/clientes/' + pt[6] + '">' +
                'Mas Información</a></p>');
        }
        // map.on('click', onMapClick)

        // function onMapClick(e) {
        //     alert("Posición: " + e.latlng)
        // }
    </script>
@endsection
