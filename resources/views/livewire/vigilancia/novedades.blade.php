<div>
    @section('title')
        Novedades
    @endsection
    <div class="row mb-3">
        <div class="col-1">
            <a href="{{ route('home') }}" class="text-silver"><i class="fas fa-arrow-circle-left fa-2x"></i></a>
        </div>
        <div class="col-10">
            <h4 class="text-secondary text-center">NOVEDADES</h4>
        </div>
        <div class="col-1"></div>

    </div>
    <div class="row">
        <h6 class="text-center text-primary">NUEVO REGISTRO</h6>

        <div class="col-12 col-md-6 d-grid mb-3">
            <div class="mb-3">
                <label for="txtinforme" class="form-label text-primary"><strong>Anotaciones:</strong></label>
                <textarea class="form-control" id="txtinforme" wire:model.lazy='informe' rows="4"></textarea>
            </div>
        </div>

        <div class="col-12 col-md-6 d-grid mb-3">
            <div class="mb-3">
                <label for="files" class="form-label text-primary"><strong>Imagenes:</strong></label>
                <input class="form-control" type="file" id="files" multiple accept="image/*,audio/*,video/*"
                    wire:model='files'>
                @foreach ($files as $file)
                    @error('file')
                        <span class="error">{{ $message }}</span>
                    @enderror
                @endforeach
            </div>
            @if ($files)
                <small><i>Vista previa:</i></small>
                <div class="row">
                    @foreach ($files as $file)
                        <div class="col-4">
                            <img src="{{ $file->temporaryUrl() }}" class="img-thumbnail">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="d-grid">
        <button class="btn btn-primary py-3" id="enviar" wire:click='enviar'>ENVIAR <i class="fas fa-paper-plane"></i></button>
    </div>
</div>
@section('js')
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success2);
        }else{
            console.log('No tiene acceso a Ubicacion.');
        }

        function success2(geoLocationPosition) {
            // console.log(geoLocationPosition.timestamp);
            let data = [
                geoLocationPosition.coords.latitude,
                geoLocationPosition.coords.longitude,
            ];
            Livewire.emit('ubicacionAprox', data);
        }
    </script>
@endsection
