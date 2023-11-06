<div>
    <div class="container text-center d-grid mt-5">
        <button class="btn btn-primary py-4" wire:click='marcar'>
            <h4 class="text-secondary"><i class="fas fa-user-clock"></i> INICIAR TURNO</h4> <small class="text-secondary"><b>{{$designacione->turno->horainicio}} HRS.</b></small>
        </button>
    </div>
</div>
@section('js')
    <script>
        localize();

        function localize() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(enviar);
            } else {
                alert('Tu navegador no soporta geolocalizacion.');
            }
        }

        function enviar(pos) {
            var latitud = pos.coords.latitude;
            var longitud = pos.coords.longitude;
            // var precision = pos.coords.accuracy;
            let data = [
                latitud,
                longitud,
            ];
            Livewire.emit('cargaPosicion', data);
        }
    </script>
@endsection
