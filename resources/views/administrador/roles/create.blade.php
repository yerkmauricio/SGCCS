@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo role</h1>
            </strong>
        </div>
    </div>
@stop

@section('content')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <br><br>
        <div class="ccard-body col-md-9 mx-auto ">
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
            <form method="POST" action="{{ route('roles.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- name --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del role</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                        placeholder="Ingrese el nombre del role">
                    @error('name')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <h2 class="h3">Lista de permisos</h2>
                <?php $currentRole = ''; ?>
                @foreach ($permissions as $permission)
                    <?php
                    $nameParts = explode('.', $permission->name);
                    $roleName = $nameParts[0];
                    ?>
                    @if ($roleName != $currentRole)
                        @if ($currentRole != '')
        </div> {{-- Cierre del div de permisos del rol anterior --}}
        @endif
        <br>
        <h3 class="h6" style="font-weight: bold; text-transform: uppercase;">ACCIONES PARA {{ ucfirst($roleName) }}</h3>
        <div>
            <?php $currentRole = $roleName; ?>
            @endif
            <div>
                <label for="">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="mr-1">
                    {{ $permission->description }}
                </label>
            </div>
            @endforeach
            @if ($currentRole != '')
        </div> {{-- Cierre del div de permisos del último rol --}}
        @endif

        <div style="text-align: center;">
            <button type="submit" class="btn btn-success float-center">
                <i class="fas fa-plus"></i>
                Agregar role
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
