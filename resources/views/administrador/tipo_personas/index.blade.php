@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <strong>Lista de los tipo de personas</strong>
            @can('tipo_personas.create')
                <a class="btn btn-success float-right" href="{{ route('tipo_personas.create') }}">
                    <i class="fas fa-plus"></i>
                    Agregar persona
                </a>
            @endcan

        </div>
    </div>
@stop

@section('content')
    <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('tipos de personas') }}</h1>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <table class="table" id="tipo_persona">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Contenido</th>

                        <th scope="col">Fecha</th>
                        @if (auth()->user()->can('tipo_personas.show') ||
                                auth()->user()->can('tipo_personas.edit') ||
                                auth()->user()->can('tipo_personas.destroy'))
                            <th scope="col">Acción</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipo_personas as $tipo_persona)
                        <tr >
                            <th scope="row">{{ $tipo_persona->id }}</th>
                            <td>{{ ucfirst($tipo_persona->nombre) }}</td>
                            <td>{{ ucfirst($tipo_persona->descripcion) }}</td>



                            <td style="@if ($tipo_persona->estado == 0) background-color: rgba(255, 0, 0, 0.3); @endif">{{ ucfirst($tipo_persona->fecha) }}</td>

                            @if (auth()->user()->can('tipo_personas.show') ||
                                    auth()->user()->can('tipo_personas.edit') ||
                                    auth()->user()->can('tipo_personas.destroy'))
                                <td>
                                    {{-- para eliminar es con formulario --}}
                                    <form action="{{ route('tipo_personas.destroy', $tipo_persona) }}" method="POST"
                                        class="form-eliminar">
                                        @csrf
                                        @method('DELETE')


                                        @can('tipo_personas.edit')
                                            <a class="btn btn-primary btn-sm" href="{{ route('tipo_personas.edit', $tipo_persona) }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan

                                        @can('tipo_personas.destroy')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
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

    {{-- DATATABLEy sus ralaciones 2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/reponsive.bootstrap4.min.css">

    {{-- marca en rolo lo inavilitado --}}
    <style>

        #tipo_persona tbody tr[data-estado="0"] {
            background-color: rgba(255, 0, 0, 0.3);
        }
    </style>


@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>{{-- linea de importaciode para usar sweet alert --}}
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

    {{-- DATATABLE y sus ralaciones 1 --}}
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4min.js"></script>
    {{-- esto cambia el idioma de ingles a español --}}
    <script>
        $('#tipo_persona').DataTable({
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
