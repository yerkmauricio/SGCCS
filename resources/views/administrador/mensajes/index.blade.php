@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class='card'>
        <div class="card-body">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                    Estadistica y Reporte </h1>
            </strong>
        </div>
    </div>
@stop

@section('content')

    {{-- <div class="row" style="font-family: 'Times New Roman', Times, serif;"> --}}

    <div class="container">
        <h1>Cantidad de personas por su tipo</h1>
        <canvas id="personTypeChart" width="100" height="100"></canvas>
    </div>

    <div class="container">
        <h1>Usuarios activos e inactivos</h1>

        <canvas id="userStatusChart" width="100" height="100"></canvas>
    </div>

    <div class="container">
        <h1>Estadísticas de Mensajes por Usuario</h1>
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>

    {{-- </div> --}}

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">
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
    </style> --}}
    <style>
        .container {
            width: 50%;
            /* Reduce el ancho del contenedor */
            margin: auto;
            /* Centra el contenedor */
            text-align: center;
        }

        canvas {
            max-width: 100%;
            /* Asegura que el canvas no exceda el tamaño del contenedor */
            height: auto;
        }

        h1 {
            font-size: 1.5em;
            /* Ajusta el tamaño de la fuente del título */
        }
    </style>
@stop

@section('js')
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


<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var data = {!! $jsonData !!};

    var labels = data.map(function(user) {
        return user.name;
    });

    var values = data.map(function(user) {
        return user.messages_sent;
    });

    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Mensajes enviados por usuario',
                data: values,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@stop
