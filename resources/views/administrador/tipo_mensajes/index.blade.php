@extends('adminlte::page')

@section('title', 'Tipo de mensajes')

@section('content_header')

    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <strong>Lista de los tipo mensajes</strong>
            @can('tipo_mensajes.create')
                <a class="btn btn-success float-right" href="{{ route('tipo_mensajes.create') }}">
                    <i class="fas fa-plus"></i>
                    Agregar mensaje
                </a>
            @endcan

        </div>
    </div>
@stop

@section('content')
    <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('tipos de mensajes') }}</h1>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="tipo_mensaje">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        {{-- <th scope="col">Contenido</th> --}}
                        <th scope="col">Fotografia</th>
                        {{-- <th scope="col">Estado</th> --}}
                        <th scope="col">Fecha</th>
                        @if (auth()->user()->can('tipo_mensajes.show') ||
                                auth()->user()->can('tipo_mensajes.edit') ||
                                auth()->user()->can('tipo_mensajes.destroy'))
                            <th scope="col">Acción</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipo_mensajes as $tipo_mensaje)
                        <tr>

                            <th scope="row">{{ $tipo_mensaje->id }}</th>
                            <td>{{ ucfirst($tipo_mensaje->nombre) }}</td>
                            {{-- <td>{{ ucfirst($tipo_mensaje->descripcion) }}</td> --}}

                            @if ($tipo_mensaje->foto == null)
                            <td><a href="#" data-toggle="modal" data-target="#contenidoModal{{ $tipo_mensaje->id }}">Contenido Específico</a></td>

                                <!-- Modal para mostrar el contenido específico -->
                                <div class="modal fade" id="contenidoModal{{ $tipo_mensaje->id }}" tabindex="-1" role="dialog" aria-labelledby="contenidoModal{{ $tipo_mensaje->id }}Label" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="contenidoModalLabel"> </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                                <div style="margin-left: 20px;">
                                                    <b>{{ ucfirst($tipo_mensaje->nombre) }}</b> <br> <br>
                                                    {{ ucfirst(auth()->user()->name) }}
                                                    {{ ucfirst(auth()->user()->apellidopaterno) }}&nbsp;<br> <br>
                                                    {!! $tipo_mensaje->descripcion !!}
                                                </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <td><img class="img-thumbnail" width="70" height="70"
                                        src="{{ Storage::url($tipo_mensaje->foto) }}" alt="" data-toggle="modal"
                                        data-target="#imagenModal{{ $tipo_mensaje->id }}">
                                </td>
                                {{-- Modal para mostrar la imagen --}}
                                <div class="modal fade" id="imagenModal{{ $tipo_mensaje->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="imagenModal{{ $tipo_mensaje->id }}Label"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imagenModal{{ $tipo_mensaje->id }}Label">
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ Storage::url($tipo_mensaje->foto) }}" class="img-fluid"
                                                    alt="">

                                            </div>
                                            <div style="margin-left: 20px;">
                                                <b> {{ ucfirst($tipo_mensaje->nombre) }}</b> <br> <br>
                                                {{ ucfirst(auth()->user()->name) }}
                                                {{ ucfirst(auth()->user()->apellidopaterno) }}&nbsp;<br> <br>
                                                {!! $tipo_mensaje->descripcion !!}
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Fin del modal --}}
                            @endif

                            {{-- @if ($tipo_mensaje->estado == 1)
                                <td>activo</td>
                            @else
                                <td>inavilitado</td>
                            @endif --}}

                            <td style="@if ($tipo_mensaje->estado == 0) background-color: rgba(255, 0, 0, 0.3); @endif">
                                {{ ucfirst($tipo_mensaje->fecha) }}</td>

                            @if (auth()->user()->can('tipo_mensajes.show') ||
                                    auth()->user()->can('tipo_mensajes.edit') ||
                                    auth()->user()->can('tipo_mensajes.destroy'))
                                <td>
                                    {{-- para eliminar es con formulario --}}
                                    <form action="{{ route('tipo_mensajes.destroy', $tipo_mensaje) }}" method="POST"
                                        class="form-eliminar">
                                        @csrf
                                        @method('DELETE')


                                        @can('tipo_mensajes.edit')
                                            <a class="btn btn-primary btn-sm" href="{{ route('tipo_mensajes.edit', $tipo_mensaje) }}">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                        @endcan

                                        @can('tipo_mensajes.destroy')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>Eliminar
                                            </button>
                                        @endcan

                                    </form>

                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css">

    {{-- DATATABLEy sus ralaciones 2
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/reponsive.bootstrap4.min.css">--}}
    {{-- marca en rolo lo inavilitado --}}
    <style>
        #tipo_persona tbody tr[data-estado="0"] {
            background-color: rgba(255, 0, 0, 0.3);
        }
    </style>
    <style>
        .custom-modal-content {
            margin-left: 20px;
            background-color: rgba(0, 255, 0, 0.3);
            /* Color verde con opacidad del 30% */
            padding: 10px;
            /* Ajusta el relleno según sea necesario */
        }
    </style>


@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>{{-- linea de importaciode para usar sweet alert --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
   <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js "></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap4.js"></script>




    {{-- mensaje de advertencia para guardar --}}
    @if (session('guardar') == 'ok')
        <script>
            Swal.fire(
                'Creado!',
                'El dato ha sido Creado.',
                'success'
            )
        </script>
    @endif
    {{-- mensaje de advertencia para eliminar --}}
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El dato ha sido eliminado.',
                'success'
            )
        </script>
    @endif

    {{-- mensaje de advertencia para editar --}}
    @if (session('editar') == 'ok')
        <script>
            Swal.fire(
                'Actualizado!',
                'El dato ha sido actulizado.',
                'success'
            )
        </script>
    @endif

    <script>
        //llega lo del formulacio de ariba
        $('.form-eliminar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Esta seguro?',
                text: "¡El dato se eliminará!",
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })
        });
    </script>

    {{-- DATATABLE y sus ralaciones 1
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4min.js"></script>--}}
    {{-- esto cambia el idioma de ingles a español --}}
    <script>
        $('#tipo_mensaje').DataTable({
            responsive: true,
            autowidth: false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Lo sentimos, pero no hay datos para mostrar",
                "info": "Mostrando página_PAGE_de_PAGES_",
                "infoEmpty": "Lo sentimos, pero no hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    </script>

@stop
