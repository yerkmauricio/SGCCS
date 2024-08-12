@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class='card'>
        <div class="card-body">
            <strong>
                @if ($user->genero == 1)
                    <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                        Datos del usuario: {{ $user->name }}&nbsp;{{ $user->apellidopaterno }} </h1>
                @else
                    <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                        Datos de la usuaria: {{ $user->name }}&nbsp;{{ $user->apellidopaterno }} </h1>
                @endif

            </strong>
        </div>
    </div>
@stop

@section('content')

    <div class="row container d-flex justify-content-center align-items-center"
        style="font-family: 'Times New Roman', Times, serif;">
        <div class="col-md-3">
            <img src="{{ Storage::url($user->foto) }}" alt="" class="custom-img mx-auto">

        </div>

        <div class="col-md-6">
            <ul>
                <br>
                <h5 class="mt-0" style="text-transform: uppercase;"><b>usuario</b></h5>
                <li class="mt-0"><b>Nombre:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($user->name) }} </li>
                <li class="mt-0"><b>Apellido paterno:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ ucfirst($user->apellidopaterno) }} </li>
                <li class="mt-0"><b>Apellido materno:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ ucfirst($user->apellidomaterno) }} </li>
                <li class="mt-0"><b>Documento nacional de identidad :</b>&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ ucfirst($user->ci) }}&nbsp;{{ ucfirst($user->expedito) }} </li>

                @if ($user->estado == 1)
                    <li class="mt-0"><b>Estado laboral:</b>&nbsp;&nbsp;&nbsp;&nbsp; Trabajando </li>
                @else
                    <li class="mt-0"><b>Estado laboral:</b>&nbsp;&nbsp;&nbsp;&nbsp; No trabajado </li>
                @endif

                {{-- <li class="mt-0"><b>Domicilio:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($user->domicilio) }} </li>
                <li class="mt-0"><b>Nacionalidad:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($user->nacionalidad) }}
                </li> --}}

                @if ($user->genero == 1)
                    <li class="mt-0"><b>Genero:</b>&nbsp;&nbsp;&nbsp;&nbsp; Masculino </li>
                @else
                    <li class="mt-0"><b>Genero:</b>&nbsp;&nbsp;&nbsp;&nbsp; Femenino </li>
                @endif
                <li class="mt-0"><b>Unidad:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($user->unidad) }} </li>
                <li class="mt-0"><b>Cargo:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($user->cargo) }} </li>
                {{-- @if ($user->universidad != null)
                    <li class="mt-0"><b>Universidad:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($user->universidad) }} </li>
                @endif

                <li class="mt-0"><b>Localizacion:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($user->localizacion) }} </li>
                @if ($user->carrera != null)
                    <li class="mt-0"><b>Carrera:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($user->carrera) }} </li>
                @endif --}}
                <li class="mt-0"><b>Role:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($user->roles->first()->name) }} </li>


                {{-- <li class="mt-0"><b>Whatsapp:</b>&nbsp;&nbsp;&nbsp;&nbsp; +{{ ucfirst($user->whatsapp) }} </li> --}}
                <li class="mt-0"><b>Fecha de nacimiento:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ ucfirst($user->fnacimiento) }} </li>
                <li class="mt-0"><b>Fecha de inicio:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($user->finicio) }} </li>

                @if ($user->estado == 0)
                    <li class="mt-0"><b>Fecha de suspension:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ ucfirst($user->fsuspension) }} </li>
                @endif


                {{-- <li class="mt-0"><b>Nivel jerarquico:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ ucfirst($user->n_jerarquicos->nombre) }}</li> --}}

                {{-- @if ($user->cargos->salario <= 500)
                <li class="mt-0"><b>Salario:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($user->cargos->salario) }}0 Bs por tour del dia </li>
                @else
                <li class="mt-0"><b>Salario:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($user->cargos->salario) }}0 Bs mensual </li>
                @endif --}}
            </ul>
        </div>
    </div>

@stop

@section('css')

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

@stop
