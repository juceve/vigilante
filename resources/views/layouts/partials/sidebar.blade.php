<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-shield-alt"></i> --}}

            <img class="img-profile rounded-circle" src="{{asset('images/blackbird1.png')}}" style="width: 40px;">
        </div>
        <div class="sidebar-brand-text mx-3">BlackBird</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        REGISTROS
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{route('customer.visitas')}}">
            <i class="fas fa-glasses"></i>
            <span>Visitas</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('customer.novedades')}}">
            <i class="fas fa-newspaper"></i>
            <span>Novedades</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('customer.rondas')}}">
            <i class="fas fa-street-view"></i>
            <span>Rondas</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        DOCUMENTOS VINCULADOS
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{route('customer.informes')}}">
            <i class="fas fa-file-alt"></i>
            <span>Informes</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('customer.cobros')}}">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Cobros</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('customer.recibos')}}">
            <i class="fas fa-receipt"></i>
            <span>Recibos</span></a>
    </li>
    {{--
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li>--}}

    <!-- Nav Item - Utilities Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> --}}




    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->