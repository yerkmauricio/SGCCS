@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un tipo de mensaje</h1>
            </strong>
        </div>
    </div>
@stop

@section('content')
    <div class="card " style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body col-md-8 mx-auto">


            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos.</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('tipo_mensajes.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del tipo de mensaje</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"
                        placeholder="Ingrese el nombre del tipo de mensaje"
                        pattern="^(?!.*([A-Za-záéíóúüñÑ])\1{3})[A-Za-záéíóúüñÑ\s\d¡!¿?]+"
                        title="Solo se permiten letras y espacios, sin repetir 4 veces seguidas">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
               

                {{-- descripcion --}}
                <div class="form-group">

                    <label for="formGroupExampleInput">Contenido del mensaje</label>
                    <!-- Reemplaza el input de texto con Summernote -->
                    <textarea id="summernote" class="form-control" name="descripcion"
                        placeholder="Ingrese el contenido del tipo de mensaje">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>


                <!-- Agrega un checkbox en tu formulario -->
                <div class="form-group">
                    <label>
                        <input type="checkbox" id="generar-formulario"> Desea agregar una fotografia
                    </label>
                </div>
                <!-- Div para mostrar el nuevo formulario (inicialmente oculto) -->
                <div id="nuevo-formulario" style="display: none;">

                    @csrf

                    {{-- foto --}}
                    <div class="form-group">
                        <label>Foto del Usario</label>
                        <input type="file" class="form-control-file" name="foto" accept=".jpg, image/jpeg"
                            value="{{ old('foto') }}" onchange="previewImage(event)">
                        @error('foto')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Imagen seleccionada:</label>
                        <img id="imagePreview" src="#" alt="Imagen seleccionada"
                            style="max-width: 200px; display: none;">
                    </div>

                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i>
                        Agregar tipo de mensaje
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')

    {{-- <style>
        .form-control {
            width: 140%;
        }

        .card-body {
            display: flex;
            align-items: 100px;
            /* Alineación vertical a 100 píxeles desde la parte superior */
            justify-content: 50px;
            padding-left: 80px;
        }
    </style> --}}
    <!-- Incluye los estilos de Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css" rel="stylesheet">
    {{-- <style>
        .form-control {
            width: 140%;
        }

        .card-body {
            display: flex;
            align-items: 100px;
            /* Alineación vertical a 100 píxeles desde la parte superior */
            justify-content: 50px;
            padding-left: 80px;
        }
    </style> --}}
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

    <script>
        var input = document.querySelector("#whatsapp");
        var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // Agregado
        });

        input.addEventListener("countrychange", function() {
            var countryCode = iti.getSelectedCountryData().dialCode;
            var phoneNumber = input.value;
            var phoneNumberWithCountryCode = countryCode + phoneNumber;
            input.value = phoneNumberWithCountryCode;
        });

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var imagePreview = document.getElementById('imagePreview');
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script>
        // Obtén el checkbox y el div del nuevo formulario
        var checkbox = document.getElementById('generar-formulario');
        var nuevoFormulario = document.getElementById('nuevo-formulario');

        // Agrega un listener para detectar cambios en el estado del checkbox
        checkbox.addEventListener('change', function() {
            // Si el checkbox está marcado, muestra el nuevo formulario; de lo contrario, ocúltalo
            if (checkbox.checked) {
                nuevoFormulario.style.display = 'block';
            } else {
                nuevoFormulario.style.display = 'none';
            }
        });
    </script>
   <script src="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.js"></script>
   <script>
       $(document).ready(function() {
           // Obtener el nombre del usuario autenticado
           var usuarioNombre = '{{ ucfirst(auth()->user()->name) }}';
           var usuarioApellido = '{{ ucfirst(auth()->user()->apellidopaterno) }}';

           // Inicializar Summernote
           $('#summernote').summernote({
               tabsize: 2,
               height: 200,
               toolbar: [
                   ['font', ['bold', 'clear']],
                   //['fontname', ['fontname']],
                   ['para', ['ul']],
                   //['insert', ['link']],
                   ['view', ['fullscreen']],
               ],
               icons: {
                   'align': '<i class="custom-icon-align"></i>',
                   'italic': '<i class="custom-icon-italic"></i>',
               },
            
           });

         
       });
   </script>

@stop
