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
                                                <label for="{{ $cliente->id }}"
                                                    class="custom-control-label"><a href="{{route('clientes.show',$cliente->id)}}" class="text-dark">{{ $cliente->nombre }}</a></label>
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
                        <div id="mapa" style="width: 100%; height: 380px;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script>
        function initMap() {
            var latitud = {{ '-17.7817999' }};
            var longitud = {{ '-63.1825485' }};

            coordenadas = {
                lng: longitud,
                lat: latitud,
            }

            generarMapa(coordenadas);
        }

        function generarMapa() {
            var arr1 = "{{ $pts }}";
            arr1 = arr1.split('$');
            const puntos = [];
            for (let i = 0; i < arr1.length; i++) {
                const pt = arr1[i].split("|");
                puntos[i] = pt;
            }
            // console.log(puntos);
            var mapa = new google.maps.Map(document.getElementById('mapa'), {
                zoom: 12,
                center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
            });


            var i = 0;
            var infowindow = new google.maps.InfoWindow({
                content: "<strong>Información de un marker</strong>"
            });
            while (i < puntos.length) {
                let punto = puntos[i];
                const contentString =
                    '<div id="content">' +
                    '<div id="siteNotice">' +
                    "</div>" +
                    '<h5 id="firstHeading" class="firstHeading">'+punto[0]+'</h5>' +
                    '<div id="bodyContent">' +
                    "<p><b>Dirección: </b>"+punto[3]+"</p>" +
                    "<p><b>Contacto: </b>"+punto[4]+"</p>" +
                    "<p><b>Telefono: </b>"+punto[5]+"</p>" +
                    '<p><a href="./admin/clientes/'+punto[6]+'">' +
                    "Mas Información</a></p>" +
                    "</div>" +
                    "</div>";
                const infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    ariaLabel: "Uluru",
                });

                
                i++
                const marker = new google.maps.Marker({
                    position: new google.maps.LatLng(punto[1], punto[2]),
                    map: mapa,
                    title: punto[0],
                    icon: "{{ asset('images/punt.png') }}",
                });

                marker.addListener("click", () => {
                    infowindow.open({
                        anchor: marker,
                        mapa,
                    });
                });
            }
        }
</script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('API_MAPS') }}&callback=initMap&libraries=&v=weekly"
        defer></script>
@endsection
