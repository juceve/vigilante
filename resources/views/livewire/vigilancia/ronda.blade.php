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

    <section>
        <div class="card">
            <div class="card-header text-center">
                <h5 class="text-primary">Punto Programado: 19:30</h5>
            </div>
            <div class="card-body">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d949.8092763714083!2d-63.184583130364615!3d-17.780550321903927!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93f1e80b8a91a677%3A0x18bacf166354ec6d!2sCalle%2021%20de%20Mayo%20336%2C%20Santa%20Cruz%20de%20la%20Sierra!5e0!3m2!1ses-419!2sbo!4v1690993677045!5m2!1ses-419!2sbo"
                    style="border:2;" width="100%" height="350" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="text-center mt-3 d-grid">
            
                <label for="">Anotaciones:</label>
                <textarea class="form-control mb-2"></textarea>
                <button class="btn btn-primary">Marcar arribo <i class="fas fa-map-marker-alt"></i></button>
            
        </div>
    </section>
</div>
