@if (session('success'))
    <script>
        Swal.fire(
            'Excelente!',
            '{{ session('success') }}',
            'success'
        )
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire(
            'Error',
            '{{ session('error') }}',
            'error'
        )
    </script>
@endif

@if (session('warning'))
    <script>
        Swal.fire(
            'Atención!',
            '{{ session('warning') }}',
            'warning'
        )
    </script>
@endif

<script>
    $('.delete').submit(function(e) {
        Swal.fire({
            title: 'Eliminar el Registro de la BD',
            text: "Esta seguro de realizar esta operación?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, continuar!',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });

    $('.anular').submit(function(e) {
        Swal.fire({
            title: 'Anular Venta',
            text: "Esta seguro de realizar esta operación?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, continuar!',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });

    $('.reset').submit(function(e) {
        Swal.fire({
            title: 'RESET PASSWORD',
            text: "Esta seguro de realizar esta operación?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, continuar!',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
</script>
