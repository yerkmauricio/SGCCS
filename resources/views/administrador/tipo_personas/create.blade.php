@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un tipo de persona</h1>
            </strong>
        </div>
    </div>
@stop

@section('content')
    <div class="card " style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body col-md-6 mx-auto">
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
            <form method="POST" action="{{ route('tipo_personas.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del tipo de persona</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"
                        placeholder="Ingrese el nombre del tipo de persona"
                        pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Contenido del tipo de persona</label>
                    <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}"
                        placeholder="Ingrese el contenido del tipo de persona"
                        pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                        title="Solo se permiten letras y espacios">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i>
                        Agregar tipo de persona
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">

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

@stop
