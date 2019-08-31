<!-- Topbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand align-items-center justify-content-center" href="#">
            <img src="img/logo_tnm.png" style="width:50px">
        </a>

        <a class="navbar-brand" href="{{ route('login') }}">
            {{ config('app.name') }}
        </a>
        <!-- Sidebar Toggle (Topbar) -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <!-- Topbar Navbar -->
            <ul class="nav nav-pills">
                <!-- Nav Item - User Information -->
                <li class="nav-item">
                    <a class="nav-link" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-800">{{ $datosGral['nombre'] }}</span>
                        <img class="img-profile rounded-circle" src="img/rvillalobos1.jpg">
                    </a>
                </li>
                <li class="nav-item align-self-end">
                    <form method="POST" action="{{ route('logout') }}">
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-block">Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

</nav>
<!-- End of Topbar -->
