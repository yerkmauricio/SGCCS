@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{-- <div class='card'>
        <div class="card-body  text-center" >
            <strong>
                @if (auth()->user()->genero == 1)
                    <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                        Bienvenido señor {{ auth()->user()->name }}&nbsp;{{ auth()->user()->apellidopaterno }} </h1>
                @else
                    <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                        Bienvenido señorita {{ auth()->user()->name }}&nbsp;{{ auth()->user()->apellidopaterno }} </h1>
                @endif
            </strong>
        </div>
    </div> --}}

@stop

@section('content')
    <div class="card-body  text-center">
        <strong>
            @if (auth()->user()->genero == 1)
                <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                    Bienvenido señor {{ auth()->user()->name }}&nbsp;{{ auth()->user()->apellidopaterno }} </h1>
            @else
                <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                    Bienvenido señorita {{ auth()->user()->name }}&nbsp;{{ auth()->user()->apellidopaterno }} </h1>
            @endif
        </strong>
    </div>
    <div class='card'>
        <div class="card-body">

            <div class="row" style="font-family: 'Times New Roman', Times, serif;">
                <div class="col-md-3">
                    <img src="{{ Storage::url(auth()->user()->foto) }}" alt="" class="custom-img mx-auto">

                    <br> <br>
                    <!-- Botón para abrir el modal -->

                    <a class="btn btn-success float-left" data-toggle="modal" data-target="#cambiarContrasenaModal">
                        <i class="fas fa-key"></i>
                        Cambiar Contraseña
                    </a>
                    <br><br>
                    <a class="btn btn-success float-left" data-toggle="modal" data-target="#manualModal">
                        <i class="fas fa-book"></i>
                        Ver Manual
                    </a>
                </div>

                <div class="col-md-6">
                    <ul>
                        <br>
                        <h5 class="mt-0 text-center" style="text-transform: uppercase;"><b>usuario</b></h5>
                        <li class="mt-0"><b>Nombre:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst(auth()->user()->name) }} </li>
                        <li class="mt-0"><b>Apellido paterno:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                            {{ ucfirst(auth()->user()->apellidopaterno) }} </li>
                        <li class="mt-0"><b>Apellido materno:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                            {{ ucfirst(auth()->user()->apellidomaterno) }} </li>
                        <li class="mt-0"><b>Documento nacional de identidad :</b>&nbsp;&nbsp;&nbsp;&nbsp;
                            {{ ucfirst(auth()->user()->ci) }}&nbsp;{{ ucfirst(auth()->user()->expedito) }} </li>

                        @if (auth()->user()->estado == 1)
                            <li class="mt-0"><b>Estado laboral:</b>&nbsp;&nbsp;&nbsp;&nbsp; Trabajando </li>
                        @else
                            <li class="mt-0"><b>Estado laboral:</b>&nbsp;&nbsp;&nbsp;&nbsp; No trabajado </li>
                        @endif

                        @if (auth()->user()->genero == 1)
                            <li class="mt-0"><b>Genero:</b>&nbsp;&nbsp;&nbsp;&nbsp; Masculino </li>
                        @else
                            <li class="mt-0"><b>Genero:</b>&nbsp;&nbsp;&nbsp;&nbsp; Femenino </li>
                        @endif
                        <li class="mt-0"><b>Unidad:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst(auth()->user()->unidad) }}
                        </li>
                        <li class="mt-0"><b>Cargo:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst(auth()->user()->cargo) }} </li>
                        <li class="mt-0">
                            <b>Role:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst(auth()->user()->roles->first()->name) }}
                        </li>

                        <li class="mt-0"><b>Fecha de nacimiento:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                            {{ ucfirst(auth()->user()->fnacimiento) }} </li>
                        <li class="mt-0"><b>Fecha de inicio:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                            {{ ucfirst(auth()->user()->finicio) }}
                        </li>

                        @if (auth()->user()->estado == 0)
                            <li class="mt-0"><b>Fecha de suspension:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ ucfirst(auth()->user()->fsuspension) }} </li>
                        @endif
                    </ul>
                </div>
                <br>
                <div class="col-md-3">
                    <div>
                        <h5 class="mt-0  text-center" style="text-transform: uppercase;"><b>acciones</b></h5>
                        @can('roles.index')
                            <a class="btn btn-outline-danger btn-sm" href="{{ route('roles.index') }}">
                                <i class="fas fa-eye"></i> LISTAR LOS ROLES
                            </a>
                        @endcan
                    </div>
                    <br>
                    <div>

                        @can('users.index')
                            <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.users.index') }}">
                                <i class="fas fa-eye"></i> LISTAR LOS USUARIOS
                            </a>
                        @endcan
                    </div>
                    <br>
                    <div>
                        @can('tipo_mensajes.index')
                            <a class="btn btn-outline-success  btn-sm" href="{{ route('tipo_mensajes.index') }}">
                                <i class="fas fa-eye"></i>TIPOS DE MENSAJES
                            </a>
                        @endcan
                    </div>
                    <br>
                    <div>
                        @can('personas.index')
                            <a class="btn btn-outline-info btn-sm" href="{{ route('personas.index') }}">
                                <i class="fas fa-eye"></i> LISTAR A LAS PERSONAS
                            </a>
                        @endcan
                    </div>
                    <br>
                    <div>
                        @can('tipo_personas.index')
                            <a class="btn btn-outline-primary btn-sm" href="{{ route('tipo_personas.index') }}">
                                <i class="fas fa-eye"></i> LISTAR TIPOS PERSONAS
                            </a>
                        @endcan
                    </div>
                    <br>
                    <div>
                        {{-- @can('mensajes.create ') --}}
                        <a class="btn btn-outline-dark  btn-sm" href="{{ route('mensajes.create') }}">
                            <i class="fas fa-eye"></i> ENVIAR MENSAJES
                        </a>
                        {{-- @endcan --}}
                    </div>


                </div>

            </div>

            <!-- Modal para cambiar contraseña -->
            <div class="modal fade" id="cambiarContrasenaModal" tabindex="-1" role="dialog"
                aria-labelledby="cambiarContrasenaModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cambiarContrasenaModalLabel">Cambiar Contraseña</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Modifica la acción del formulario para redireccionarlo a homes.update -->
                            <form id="cambiarContrasenaForm"
                                action="{{ route('homes.update', ['home' => auth()->user()->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="current_password">Contraseña Anterior</label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Nueva Contraseña</label>
                                    <input type="password" id="password" name="password" class="form-control" required
                                        minlength="8">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" required minlength="8">
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar Contraseña</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal manual de suuarios-->
            <div class="modal fade" id="manualModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Manual de Usuario</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <iframe src="{{ asset('doc/MANUAL DE USUARIO SISTEMA SGM.pdf') }}"
                                style="width: 100%; height: 500px;"></iframe>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='card'>
        <div class="row">
            <div class="card-body">

                <canvas id="userStatusChart" width="200" height="200"></canvas>
            </div>
            <div class="card-body">

                <canvas id="personTypeChart" width="200" height="200"></canvas>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .custom-img {
            max-width: 100%;
            height: auto;
            border-width: 10px;
            border-style: solid;
            border-image: linear-gradient(to right, rgb(14, 14, 121), rgb(127, 5, 7)) 1;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
        }

        .photo-container {
            max-width: 300px;
            /* Ajusta este valor según tu diseño */
            margin: 0 auto;
            /* Para centrar la foto */
        }
    </style>
    <style>
        .card {
            margin: 10px;
        }

        .card-body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chart-container {
            position: relative;
            width: 200px;
            height: 200px;
        }

        canvas {
            display: block;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
@stop

@section('js')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('personTypeChart').getContext('2d');
            var personTypeChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Cantidad de Personas',
                        data: {!! json_encode($counts) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Azul para las barras
                        borderColor: 'rgba(54, 162, 235, 1)', // Azul oscuro para el borde
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('userStatusChart').getContext('2d');
            var userStatusChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Usuarios Activos', 'Usuarios Inactivos'],
                    datasets: [{
                        label: 'Usuarios',
                        data: [{{ $activeUsers }}, {{ $inactiveUsers }}],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)', // Azul para activos
                            'rgba(255, 99, 132, 0.2)' // Rojo para inactivos
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)', // Azul para activos
                            'rgba(255, 99, 132, 1)' // Rojo para inactivos
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                generateLabels: function(chart) {
                                    var data = chart.data;
                                    return data.labels.map(function(label, i) {
                                        var dataset = data.datasets[0];
                                        var value = dataset.data[i];
                                        return {
                                            text: label + ': ' + value,
                                            fillStyle: dataset.backgroundColor[i],
                                            hidden: isNaN(dataset.data[i]),
                                            lineCap: dataset.borderCapStyle,
                                            lineDash: dataset.borderDash,
                                            lineDashOffset: dataset.borderDashOffset,
                                            lineJoin: dataset.borderJoinStyle,
                                            lineWidth: dataset.borderWidth,
                                            strokeStyle: dataset.borderColor[i],
                                            pointStyle: dataset.pointStyle,
                                            rotation: 0
                                        };
                                    });
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    var label = tooltipItem.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += tooltipItem.raw;
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>{{-- linea de importaciode para usar sweet alert --}}
    {{-- mensaje de advertencia para guardar --}}
    @if (session('guardar') == 'ok')
        <script>
            Swal.fire(
                'Lo sentimos pero la anterio contraseña no coincide',
                'no se puedo modificar la contraseña.',
                'error'
            )
        </script>
    @endif
    {{-- mensaje de advertencia para eliminar --}}
    @if (session('error') == 'ok')
        <script>
            Swal.fire(
                'Lo sentimos la nueva contraseñno conincide',
                'no se puedo modificar la contraseña.',
                'error'
            )
        </script>
    @endif

    {{-- mensaje de advertencia para editar --}}
    @if (session('editar') == 'ok')
        <script>
            Swal.fire(
                'Perfecto!',
                'Su Contraseña ha sido modificada',
                'success'
            )
        </script>
    @endif


    </script>

@stop
