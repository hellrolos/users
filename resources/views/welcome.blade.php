<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/app.css" />
</head>
<body>
    <div class="container">
        <hr>
        @if(session()->has('alert'))
            <div class="alert alert-info">{{ session('alert') }}</div>
        @endif
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">Bienvenido {{ $datosGral['nombre'] }}</h1>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('logout') }}">
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-block">Cerrar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    <!-- Services section -->
    <section id="what-we-do">
        <div class="container-fluid">
            <h2 class="section-title mb-2 h1">correo: {{ $datosGral['correo'] }}</h2>
            <p class="text-center text-muted h5">curp: {{ $datosGral['curp'] }}</p>
            @isset($datosPersonal)
                <div class="row mt-5">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-1">
                                <h3 class="card-title">RFC</h3>
                                <p class="card-text">{{ $datosPersonal['rfc'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-2">
                                <h3 class="card-title">Departamento</h3>
                                <p class="card-text">{{ $datosPersonal['depto'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-3">
                                <h3 class="card-title">Oficina</h3>
                                <p class="card-text">{{ $datosPersonal['oficina'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-4">
                                <h3 class="card-title">Ingreso</h3>
                                <p class="card-text">{{ $datosPersonal['ingreso'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-5">
                                <h3 class="card-title">Plaza</h3>
                                <p class="card-text">{{ $datosPersonal['plaza'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-6">
                                <h3 class="card-title">Puesto</h3>
                                <p class="card-text">{{ $datosPersonal['puesto'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
            @isset($datosAlumno)
                <div class="row mt-5">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-1">
                                <h3 class="card-title">Numero de Control</h3>
                                <p class="card-text">{{ $datosAlumno['nocontrol'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-2">
                                <h3 class="card-title">Carrera</h3>
                                <p class="card-text">{{ $datosAlumno['carrera'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-3">
                                <h3 class="card-title">Ingreso</h3>
                                <p class="card-text">{{ $datosAlumno['ingreso'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-1">
                                <h3 class="card-title">Semestre</h3>
                                <p class="card-text">{{ $datosAlumno['semestre'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-2">
                                <h3 class="card-title">Promedio</h3>
                                <p class="card-text">{{ $datosAlumno['promedio'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-block block-3">
                                <h3 class="card-title">Especialidad</h3>
                                <p class="card-text">{{ $datosAlumno['especialidad'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </section>
    <!-- /Services section -->
    {{-- aqui va el codigo para la tabla de las plataformas --}}
    <table>
        <tr>
            <th>Plataforma</th>
            <th>Rol</th>
            <th>Estatus</th>
        </tr>
        <tr>
            <th>SII</th>
            <th>Alumno/Secretaria/Docente/Jefe</th>
            <th>En proceso de migración</th>
        </tr>
    </table>
    </div>
</body>
</html>