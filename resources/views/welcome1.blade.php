@extends('layouts.head')
@section('title','Dashboard')

<body class="bg">
    <div class="container-fluid" style="margin-top:100px">
        <div class=""></div>
        @include('layouts.navbar')

        @if(session()->has('alert'))
        <div class="alert alert-info">{{ session('alert') }}</div>
        @endif
        <div class="row">
            <div class="col-lg-2" style="margin-top:80px">
                @include('layouts.sidebar')
            </div>
            <div class="col-lg-8 shadow-sm">
                <div class="card border-0">
                    <div class="card my-1 p-2">
                        <div class="card-header tecnm heading">
                            <h2 class="card-title heading">Bienvenido {{ $datosGral['nombre'] }}</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="card-subtitle mb-2 h3">correo: {{ $datosGral['correo'] }}</h3>
                            <h3 class="card-subtitle mb-2 h3">curp: {{ $datosGral['curp'] }}</h3>
                        </div>
                    </div>
                    <div class="card-group">
                        <div class="container">
                            <h2>Información Trabajador</h2>
                            @isset($datosPersonal)
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-block block-1">
                                            <div class="card-header tecnm heading">
                                                <h3 class="card-subtitle">RFC</h3>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $datosPersonal['rfc'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <div cl ass="card">
                                        <div class="card-block block-2">
                                            <div class="card-header heading">
                                                <h3 class="card-subtitle">Departamento</h3>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $datosPersonal['depto'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-block block-3">
                                            <div class="card-header heading">
                                                <h3 class="card-subtitle">Oficina</h3>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $datosPersonal['oficina'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-block block-4">
                                            <div class="card-header heading">
                                                <h3 class="card-subtitle">Ingreso</h3>
                                            </div>
                                            <p class="card-body">{{ $datosPersonal['ingreso'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-block block-5">
                                            <div class="card-header heading">
                                                <h3 class="card-subtitle">Plaza</h3>
                                            </div>
                                            <p class="card-body">{{ $datosPersonal['plaza'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-block block-6">
                                            <div class="card-header heading">
                                                <h3 class="card-subtitle">Puesto</h3>
                                            </div>
                                            <p class="card-body">{{ $datosPersonal['puesto'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endisset
                            <h2>Información Estudiante</h2>
                            @isset($datosAlumno)
                            <div class="row my-1">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-block block-1">
                                            <div class="card-header heading">
                                                <h3 class="card-subtitle">Numero de Control</h3>
                                            </div>
                                            <p class="card-body">{{ $datosAlumno['nocontrol'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-block block-2">
                                            <h3 class="card-header heading">Carrera</h3>
                                            <p class="card-body">{{ $datosAlumno['carrera'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-block block-3">
                                            <h3 class="card-header heading">Ingreso</h3>
                                            <p class="card-body">{{ $datosAlumno['ingreso'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-block block-1">
                                            <h3 class="card-header heading">Semestre</h3>
                                            <p class="card-body">{{ $datosAlumno['semestre'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-block block-2">
                                            <h3 class="card-header heading">Promedio</h3>
                                            <p class="card-body">{{ $datosAlumno['promedio'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-block block-3">
                                            <h3 class="card-header heading">Especialidad</h3>
                                            <p class="card-body">{{ $datosAlumno['especialidad'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endisset
                        </div>
                    </div>
                </div>
                @isset($listado)
                <div class="row flex-xl-nowrap border-0 shadow-sm">
                    <div class="container">
                        <div class="col-md-12 col-md-offset-6">
                            <div class="card">
                                <div class="container-fluid">
                                    <h2>Status</h2>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="text-primary">
                                                    <tr>
                                                        <th scope="col">Plataforma</th>
                                                        <th>Rol</th>
                                                        <th>Estatus</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($listado as $plataforma => $p)
                                                    <tr>
                                                        <td>
                                                            {{ $plataforma }}
                                                        </td>
                                                        <td>
                                                            @foreach ($p as $rol)
                                                            @if($loop->first)
                                                            {{ $rol }}
                                                            @elseif($loop->last)
                                                            - {{ $rol }}
                                                            @else
                                                            - {{ $rol }}
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                        <td>En progreso</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endisset
            </div>

        </div>

        <!-- /Services section -->
        {{-- aqui va el codigo para la tabla de las plataformas --}}

    </div>
