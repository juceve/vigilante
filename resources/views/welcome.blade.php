<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/blackbird1.png') }}" />
    <title>BLACKBIRD SECURITY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    .security {
        box-shadow: 0px 10px 14px -7px #276873;
        background: linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
        background-color: #599bb3;
        border-radius: 8px;
        display: inline-block;
        cursor: pointer;
        color: #ffffff;
        font-family: Arial;
        font-size: 20px;
        font-weight: bold;
        padding: 16px 76px;
        text-decoration: none;
        text-shadow: -1px 4px 0px #3d768a;
    }

    .security:hover {
        background: linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
        background-color: #408c99;
    }

    .security:active {
        position: relative;
        top: 1px;
    }
</style>

<body style="background-image: url('{{ asset('images/456.jpg') }}')">

    <div class="container text-center mt-5">
        <img src="{{ asset('images/blackbird1.png') }}" class="img-fluid" style="width: 300px">
    </div>
    <div class="container text-center mt-5">
        {{-- <a href="#" class="security">INGRESAR</a> --}}
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}" class="security">INGRESAR <svg xmlns="http://www.w3.org/2000/svg"
                        width="35" height="35" fill="currentColor" class="bi bi-box-arrow-in-right"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                        <path fill-rule="evenodd"
                            d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                    </svg></a>
            @else
                <a href="{{ route('login') }}" class="security">INGRESAR <svg xmlns="http://www.w3.org/2000/svg"
                        width="35" height="35" fill="currentColor" class="bi bi-box-arrow-in-right"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                        <path fill-rule="evenodd"
                            d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                    </svg></a>

            @endauth
        @endif
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
