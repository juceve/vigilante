<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>

<script>
    Livewire.on('loading', () => {
        $.blockUI({
            message: '<h1 class="text-success"><div class="spinner-grow text-success" role="status"></div> Espere por favor...</h1>'
        });
    });
    Livewire.on('unLoading', () => {
        $.unblockUI();
    });

    function loading(){
        $.blockUI({
            message: '<h1 class="text-success"><div class="spinner-grow text-success" role="status"></div> Espere por favor...</h1>'
        });
    }

    function unLoading(){
        $.unblockUI();
    }
</script>

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

    Livewire.on('dataTableRender', () => {
        $(".dataTable").dataTable({
            "destroy": true,
            order: [
                [0, 'desc']
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            },
        })
    })

    Livewire.on('success', message => {
        // Swal.fire('Excelente!',message,'success');  
        Swal.fire({
            icon: 'success',
            title: 'Excelente',
            text: message,
            showConfirmButton: false,
            timer: 1500
        })
    });
    Livewire.on('error', message => {
        Swal.fire('Error!', message, 'error');

    });
    Livewire.on('warning', message => {
        Swal.fire('Atención!', message, 'warning');
    });
</script>
