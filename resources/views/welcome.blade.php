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
                            <h2 class="card-title heading">Bienvenido</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="card-subtitle mb-2">correo: {{ $datosGral['correo'] }}</h3>
                            <h3 class="card-subtitle mb-2">curp: {{ $datosGral['curp'] }}</h3>
                        </div>
                    </div>
                    <div class="card-group">
                        <div class="container">
                            <h2>Información Trabajador</h2>
                            @isset($datosPersonal)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th scope="col">RFC</th>
                                            <th>Departamento</th>
                                            <th>Oficina</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $datosPersonal['rfc'] }}
                                            </td>
                                            <td>
                                                {{ $datosPersonal['depto'] }}
                                            </td>
                                            <td>
                                                {{ $datosPersonal['oficina'] }}
                                            </td>
                                        </tr>
                                    </tbody>

                                    <thead class="text-primary">
                                        <tr>
                                            <th scope="col">Ingreso</th>
                                            <th scope="col">Plaza</th>
                                            <th scope="col">Puesto
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $datosPersonal['ingreso'] }}
                                            </td>
                                            <td>
                                                {{ $datosPersonal['plaza'] }}
                                            </td>
                                            <td>
                                                {{ $datosPersonal['puesto'] }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endisset
                            <h2>Información Estudiante</h2>
                            @isset($datosAlumno)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th scope="col">Numero de Control</th>
                                            <th>Carrera</th>
                                            <th>Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $datosAlumno['nocontrol'] }}
                                            </td>
                                            <td>
                                                {{ $datosAlumno['carrera'] }}
                                            </td>
                                            <td>
                                                {{ $datosAlumno['ingreso'] }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th scope="col">Semestre</th>
                                            <th>Promedio</th>
                                            <th>Especialidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $datosAlumno['semestre'] }}
                                            </td>
                                            <td>
                                                {{ $datosAlumno['promedio'] }}
                                            </td>
                                            <td>
                                                {{ $datosAlumno['especialidad'] }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
