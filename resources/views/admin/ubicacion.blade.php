<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubicacion en el Mapa</title>
</head>

<body>    
    <div id="mapa" style="width: 100%; height: 330px"></div>



    <script>
        function initMap() {
            var latitud = {{ $lat }};
            var longitud = {{ $lng }};

            coordenadas = {
                lng: longitud,
                lat: latitud,
            }

            generarMapa(coordenadas);
        }

        function generarMapa() {
            var mapa = new google.maps.Map(document.getElementById('mapa'), {
                zoom: 21,
                center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
            });

            var marcador = new google.maps.Marker({
                map: mapa,
                draggable: false,
                position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
            })

            // marcador.addListener('dragend', function(event) {
            //     document.getElementById('latitud').value = this.getPosition().lat();

            //     document.getElementById('longitud').value = this.getPosition().lng();
            // })
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('API_MAPS') }}&callback=initMap&libraries=&v=weekly"
        defer></script>
</body>

</html>
