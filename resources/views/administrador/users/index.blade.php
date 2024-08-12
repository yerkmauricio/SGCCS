@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <strong>Lista de Usuarios</strong>
            @can('users.create')
                <a class="btn btn-success float-right" href="{{ route('admin.users.create') }}">
                    <i class="fas fa-plus"></i>
                    Agregar usuarios
                </a>
            @endcan

        </div>
    </div>
@stop

@section('content')
    <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('Usuarios') }}</h1>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <table class="table" id="user">{{-- el id trasporte lla al DATATABLE --}}
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido Paterno</th>
                        <th scope="col">Apellido Materno</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Role</th>
                        <th scope="col">Estado Laboral</th>
                        @if (auth()->user()->can('users.show') || auth()->user()->can('users.edit') || auth()->user()->can('users.destroy'))
                            <th scope="col">Acción</th>
                        @endif


                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ ucfirst($user->name) }}</td>
                            <td>{{ ucfirst($user->apellidopaterno) }}</td>
                            <td>{{ ucfirst($user->apellidomaterno) }}</td>{{-- <td><img width="70" height="70" src="{{ Storage::url($user->foto) }}" alt="">
                            </td> esto se hace en imagen --}}
                            @if ($user->genero == 1)
                                <td>Masculino</td>
                            @else
                                <td>Femenino</td>
                            @endif
                            <td>{{ $user->roles->first()->name }}</td> <!-- Mostrar el primer rol del usuario -->

                            @if ($user->estado == 1)
                                <td>Trabajando</td>
                            @else
                                <td
                                    style="@if ($user->estado == 0) background-color: rgba(255, 0, 0, 0.3); @endif">
                                    No trabajando</td>
                            @endif
                            @if (auth()->user()->can('users.show') || auth()->user()->can('users.edit') || auth()->user()->can('users.destroy'))
                                <td>
                                    {{-- para eliminar es con formulario --}}
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                        class="form-eliminar">
                                        @csrf
                                        @method('DELETE')

                                        @can('users.show')
                                            <a class="btn btn-secondary btn-sm" href="{{ route('admin.users.show', $user) }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endcan


                                        @can('users.edit')
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.users.edit', $user) }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan

                                        @can('users.destroy')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endcan

                                    </form>
                                    <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="rp" value="505">
                                        <button class=" btn btn-success float-right btn-sm" type="submit "
                                            onclick="return confirm('¿Estás seguro de restablecer la contraseña de este usuario?')">
                                            <i class="fas fa-sync-alt"></i> Restablecer contraseña
                                        </button>
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

    @if (session('restablecer') == 'ok')
        <script>
            Swal.fire(
                'Se restablecio correctamente',

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
        $('#user').DataTable({
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
