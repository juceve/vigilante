<div>
    @section('title')
        Ronda
    @endsection
    <div class="row mb-3">
        <div class="col-1">
            <a href="{{ route('home') }}" class="text-silver"><i class="fas fa-arrow-circle-left fa-2x"></i></a>
        </div>
        <div class="col-10">
            <h4 class="text-secondary text-center">RONDA</h4>
        </div>
        <div class="col-1"></div>

    </div>
    <div class="container text-center mb-3">
        @if ($designacion)
            <table class="table table-bordered text-info">
                <tr>
                    <th>
                        <strong>{{ $designacion->turno->cliente->nombre }}</strong>
                    </th>
                    <th>
                        <strong>{{ $designacion->turno->nombre }}</strong>
                    </th>
                </tr>
            </table>
            @if ($proxpunto)
                <section>
                    <div class="card">
                        <div class="card-header text-center">
                            <h5 class="text-primary">Punto Programado: {{ $proxpunto->hora }}</h5>
                        </div>
                        <div class="card-body">
                            <div id="mapa" style="width: 100%; height: 300px;"></div>
                        </div>                        
                    </div>
                    <div class="form-group d-grid mt-2">
                        <button type="button" onClick="window.location.reload()" class="btn btn-secondary btn-sm">
                            <i class="fas fa-sync"></i> Actualizar Ubicación
                        </button>
                    </div>
                    <div class="text-center mt-3 d-grid">

                        <label for="">Anotaciones:</label>
                        <textarea class="form-control mb-2"></textarea>
                        <button class="btn btn-primary">Marcar arribo <i class="fas fa-map-marker-alt"></i></button>

                    </div>
                </section>
            @else
                <div class="alert alert-success" role="alert">
                    No existen más puntos de control.
                </div>
            @endif
        @else
            <div class="alert alert-danger" role="alert">
                No exiten asignaciones habilitadas.
            </div>

        @endif


    </div>

</div>
@section('js')
@if ($proxpunto)
<script>
    var mapa;

    function initMap() {
        var latitud = {{ $cliente->latitud ? $cliente->latitud : '-17.7817999' }};
        var longitud = {{ $cliente->longitud ? $cliente->longitud : '-63.1825485' }};

        coordenadas = {
            lat: {{ $proxpunto->latitud }},
            lng: {{ $proxpunto->longitud }},
        }

        punto = {
            lat: {{ $proxpunto->latitud }},
            lng: {{ $proxpunto->longitud }},
        }

        generarMapa(coordenadas, punto);
    }

    function generarMapa() {
        mapa = new google.maps.Map(document.getElementById('mapa'), {
            zoom: 20,
            center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
        });

        var marcador = new google.maps.Marker({
            map: mapa,
            position: new google.maps.LatLng(punto.lat, punto.lng)
        })

        if (navigator.geolocation) {
            let miUbicacion = navigator.geolocation.getCurrentPosition(success);
        }

    }

    function success(geoLocationPosition) {

        let data = [
            geoLocationPosition.coords.latitude,
            geoLocationPosition.coords.longitude,
        ];

        var marcador = new google.maps.Marker({
            map: mapa,
            position: new google.maps.LatLng(geoLocationPosition.coords.latitude, geoLocationPosition.coords
                .longitude),
            title: "Mi Ubicación",
            icon: {
                url: "{{asset('images/local.png')}}"
            },
        })
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('API_MAPS') }}&callback=initMap&libraries=&v=weekly"
    defer></script>
@endif
@endsection
