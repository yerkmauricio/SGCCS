@extends('adminlte::auth.login')


@section('css')
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('{{ asset('img/login1.jpg') }}') no-repeat center center fixed;
            /* background: linear-gradient(135deg, #d10000, #feb47b); */
            /* Fondo con degradado */
        }

        .login-page {
            position: relative;
            /* background: url('{{ asset('img/login1.jpg') }}') no-repeat center center fixed; */
            background-size: cover;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-image 0.5s ease-in-out;

        }

        .login-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.647);
            /* Cambié la opacidad a 0.3 */
        }

        .login-box {
            position: relative;
            background: rgba(0, 0, 0, 0.578);
            /* Hice más transparente el cuadro de ingreso */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(2, 1, 65, 0.444);
            width: 90%;
            max-width: 400px;
            z-index: 1;
        }

        .login-logo a {
            color: #fff;
            /* Cambié el color del texto a blanco */
            font-weight: bold;
            font-size: 1.5em;
        }

        /* boton de login  */
        .btn-primary {
            background-color: #ffffff;
            border-color: #ffffffb0;
            color: #fff;
            /* Cambié el color del texto a blanco */
        }


        .btn-primary:hover {
            background-color: #1557e6;
            border-color: #ffffff00;
            color: #ffffff;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.866);
            /* Cambié el color del texto a negro en hover */
        }


        .form-group {
            margin-bottom: 20px;
            /* Aumenté el espacio entre los campos */
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.7);
            /* Ajusta la opacidad aquí */
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.7);
            /* Hice más transparente el fondo del campo de entrada */
            border: 1px solid #ffffffb0;
            /* Añadí un borde blanco */
            color: #ffffff;
            /* Cambié el color del texto a blanco */
        }

        @media (max-width: 600px) {
            .login-box {
                width: 100%;
                padding: 10px;
            }
        }

        .login-box * {
            background-color: #0a010100;
            color: #fff;
        }
    </style>


@stop
@section('js')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            var images = [
                '{{ asset('img/login1.jpg') }}',
                '{{ asset('img/login2.jpg') }}',
                '{{ asset('img/login3.jpg') }}'
            ];
            var currentIndex = 0;
            var backgroundElement = document.querySelector('.login-page');

            function changeBackground() {
                backgroundElement.style.backgroundImage = 'url(' + images[currentIndex] + ')';
                currentIndex = (currentIndex + 1) % images.length;
            }

            // Cambia la imagen de fondo cada 5 segundos
            setInterval(changeBackground, 5000);
        });
    </script> --}}
@stop

{{-- @section('auth_body')
    <!-- Contenido del formulario de inicio de sesión -->
    <div class="login-box">
        <!-- Contenido del formulario -->
    </div>
@stop
 --}}
