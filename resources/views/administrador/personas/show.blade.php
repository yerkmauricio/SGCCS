@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class='card'>
        <div class="card-body">
            <strong>

                <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                    Datos de la persona: {{ $persona->nombre }}&nbsp;{{ $persona->apellidop }} </h1>


            </strong>
        </div>
    </div>
@stop

@section('content')

    <div class="row container d-flex justify-content-center align-items-center"
        style="font-family: 'Times New Roman', Times, serif;">
        <div class="col-md-3">
            {{-- <img src="{{ Storage::url($user->foto) }}" alt="" class="custom-img mx-auto"> --}}
            @if ($persona->genero == 1)
                <img src="{{ asset('img/masculino.png') }}" alt="Imagen Masculino" class="custom-img mx-auto">
            @else
                <img src="{{ asset('img/femenino.jpg') }}" alt="Imagen Femenino" class="custom-img mx-auto">
            @endif



        </div>


        <div class="col-md-6">
            <ul>
                <br>
                <h5 class="mt-0" style="text-transform: uppercase;"><b>Persona</b></h5>
                {{-- <li class="mt-0"><b>Tipo de personas:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($persona->tipo_persona->nombre) }} </li> --}}
                <li class="mt-0"><b>Tipos de personas:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                    @foreach($persona->tipoPersonas as $tipo_persona)
                        {{ ucfirst($tipo_persona->nombre) }}@if (!$loop->last), @endif
                    @endforeach
                </li>
                <li class="mt-0"><b>Nombre:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($persona->nombre) }} </li>
                @if ($persona->apellidop != null)
                    <li class="mt-0"><b>Apellido paterno:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ ucfirst($persona->apellidop) }} </li>
                @endif

                @if ($persona->apellidom != null)
                    <li class="mt-0"><b>Apellido materno:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ ucfirst($persona->apellidom) }} </li>
                @endif

                <li class="mt-0"><b>Nacionalidad:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($persona->nacionalidad) }}
                </li>

                @if ($persona->genero == 1)
                    <li class="mt-0"><b>Genero:</b>&nbsp;&nbsp;&nbsp;&nbsp; Masculino </li>
                @else
                    <li class="mt-0"><b>Genero:</b>&nbsp;&nbsp;&nbsp;&nbsp; Femenino </li>
                @endif
                @if ($persona->unidad != null)
                    <li class="mt-0"><b>Unidad:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($persona->unidad) }} </li>
                @endif

                @if ($persona->cargo != null)
                    <li class="mt-0"><b>Cargo:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($persona->cargo) }} </li>
                @endif
                @if ($persona->institucion!= null)
                <li class="mt-0"><b>Institucion:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($persona->institucion) }} </li>
                @endif
                {{-- @if ($persona->localizacion != null)
                    <li class="mt-0"><b>Localizacion:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($persona->localizacion) }}
                    </li>
                @endif --}}
                @if ($persona->carrera != null)
                    <li class="mt-0"><b>Carrera:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($persona->carrera) }} </li>
                @endif
                @if ($persona->sede != null)
                    <li class="mt-0"><b>Sede:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($persona->sede) }} </li>
                @endif


            </ul>
        </div>
    </div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
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
@stop

@section('js')
    {{-- <script>
        console.log('Hi!');
    </script> --}}
@stop
