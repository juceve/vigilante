<div>
    @section('title')
        Puntos de Control
    @endsection
    @section('content_header')
        <h4>Puntos de Control</h4>
    @endsection

    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-info">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                        CLIENTE: <strong>{{ $turno->cliente->nombre }}</strong>
                    </span>

                    <div class="float-right">
                        <a href="javascript:history.back()" class="btn btn-info btn-sm float-right" data-placement="left">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                TURNO: <strong>{{ $turno->nombre }}</strong>
                <hr>
                <div class="form-group">
                    <label>Listado de Puntos de Control</label><br>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo"><i
                            class="fas fa-plus"></i> Agregar</button>
                    <button type="button" onClick="window.location.reload()" class="btn btn-success">
                        <i class="fas fa-sync"></i> Actualizar
                    </button>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-info">
                                    <tr>
                                        <th>Nro.</th>
                                        <th>Nombre</th>
                                        <th>Hora</th>
                                        {{-- <th>Latitud</th>
                                <th>Longitud</th> --}}
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($puntos as $punto)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $punto->nombre }}</td>
                                            <td>{{ $punto->hora }}</td>
                                            {{-- <td>{{ $punto->latitud }}</td>
                                    <td>{{ $punto->longitud }}</td> --}}
                                            <td align="right">
                                                <button class="btn btn-outline-danger btn-sm" title="Eliminar de la DB"
                                                    onclick="eliminar({{ $punto->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div id="mapa2" style="width: 100%; height: 400px"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="modalNuevoLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header table-info">
                    <h5 class="modal-title" id="modalNuevoLabel">Nuevo Punto de Control</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" onsubmit="return false">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Nombre:</label>
                                    <input type="text" class="form-control" id="nombre"
                                        placeholder="Nombre de Punto" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Hora:</label>
                                    <input type="time" class="form-control" id="hora" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 ">
                                <div class="form-group">
                                    <label>Latitud:</label>
                                    <input type="text" class="form-control" id="latitud" required
                                        placeholder="Seleccione un punto en el Mapa">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 ">
                                <div class="form-group">
                                    <label>Longitud:</label>
                                    <input type="text" class="form-control" id="longitud" required
                                        placeholder="Seleccione un punto en el Mapa">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" wire:ignore>
                            <div class="border" id="mapa" style="width: 100%; height: 400px"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="mapaPrincipal()"><i
                                class="fas fa-times-circle"></i> Cerrar</button>

                        <button class="btn btn-info" onclick='registrar()'>
                            <i class="fas fa-save"></i> Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script src="{{ asset('vendor/jquery/scripts.js') }}"></script>
    @include('vendor.mensajes')
    <script></script>
    <script>
        function registrar() {
            var nombre = document.getElementById('nombre');
            var hora = document.getElementById('hora');
            var latitud = document.getElementById('latitud');
            var longitud = document.getElementById('longitud');
            if (nombre.value != "" && hora.value != "" && latitud.value != "" && longitud.value != "") {
                const data = [nombre.value, hora.value, latitud.value, longitud.value];
                Livewire.emit('registrarPunto', data);
                document.getElementById('nombre').value = "";
                document.getElementById('hora').value = "";
                document.getElementById('latitud').value = "";
                document.getElementById('longitud').value = "";
            }
        }

        function eliminar(id) {
            Swal.fire({
                title: 'Eliminar Punto',
                text: "Esta seguro de realizar esta operación?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'No, cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete', id);
                }
            })
        }
    </script>
    <script>
        $(document).ready(function() {
            mapaPrincipal();

        });

        function mapaPrincipal(){
            var arr1 = "{{ $pnts }}";
            arr1 = arr1.split('$');
            const puntos = [];
            for (let i = 0; i < arr1.length; i++) {
                const pt = arr1[i].split("|");
                puntos[i] = pt;
            }
            if (puntos.length > 0) {
                var locCenter = {
                    lat: puntos[0][1],
                    lng: puntos[0][2],
                }

                var mapa2 = new google.maps.Map(document.getElementById('mapa2'), {
                    zoom: 18,
                    center: new google.maps.LatLng(locCenter.lat, locCenter.lng)
                });
var i = 0;
                while (i < puntos.length ) {
                                      
                    let punto = puntos[i];i++  
                    new google.maps.Marker({
                        position: new google.maps.LatLng(punto[1], punto[2]),
                        map: mapa2,
                        title: punto[0],                        
                        label: 'P'+ i,
                    });
                }
            }
        }

        function initMap() {
            var latitud = {{ $cliente->latitud ? $cliente->latitud : '-17.7817999' }};
            var longitud = {{ $cliente->longitud ? $cliente->longitud : '-63.1825485' }};

            coordenadas = {
                lng: longitud,
                lat: latitud,
            }

            generarMapa(coordenadas);
        }

        function generarMapa() {
            var mapa = new google.maps.Map(document.getElementById('mapa'), {
                zoom: 18,
                center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
            });

            var marcador = new google.maps.Marker({
                map: mapa,
                draggable: true,
                position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
            })

            marcador.addListener('dragend', function(event) {
                document.getElementById('latitud').value = this.getPosition().lat();

                document.getElementById('longitud').value = this.getPosition().lng();
            })
        }

        function generarMapa2() {
            var mapa = new google.maps.Map(document.getElementById('mapa2'), {
                zoom: 18,
                center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
            });
            for (let i = 0; i < puntos.length; i++) {
                const punto = puntos[i];
                // new google.maps.Marker({
                //     map: mapa2,
                //     draggable: false,
                //     title: punto[0],
                //     position: new google.maps.LatLng(punto[1], punto[2])
                // })
            }






        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('API_MAPS') }}&callback=initMap&libraries=&v=weekly"
        defer></script>
@endsection
