@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo usuario</h1>
            </strong>
        </div>
    </div>
@stop

@section('content')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body col-md-9 mx-auto">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                @csrf


                <div class="form-row">
                {{-- name --}}
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Nombre de la Usuario</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                        placeholder="Ingrese el name del Usuario" pattern="[A-Za-z\s]+"
                        title="Solo se permiten letras y espacios">
                    @error('name')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                {{-- apellidopaterno --}}
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Apellido paterno del Usuario</label>
                    <input type="text" class="form-control" name="apellidopaterno" value="{{ old('apellidopaterno') }}"
                        placeholder="Ingrese el apellido paterno del Usuario" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                        title="Solo se permiten letras, sin espacios">
                    @error('apellidopaterno')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div></div>
                <div class="form-row">
                {{-- apellidomaterno --}}
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Apellido materno del Usuario</label>
                    <input type="text" class="form-control" name="apellidomaterno" value="{{ old('apellidomaterno') }}"
                        placeholder="Ingrese el apellido materno del usuario" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                        title="Solo se permiten letras, sin espacios">
                    @error('apellidomaterno')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                        placeholder="Ingrese su correo electrónico">
                    @error('email')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                {{-- ci --}}
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Documento nacional de identidad</label>
                    <input type="text" class="form-control" name="ci" value="{{ old('ci') }}"
                        placeholder="Ingrese el Documento nacional de identidad del empleado"
                        pattern="^[0-9]+$" title="Solo se permiten números">
                    @error('ci')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- expedito --}}
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Expedito del CI</label>
                    <select class="form-control" name="expedito">
                        <option value="LP" @if (old('expedito') == 'LP') selected @endif>La Paz</option>
                        <option value="SC" @if (old('expedito') == 'SC') selected @endif>Santa Cruz</option>
                        <option value="CB" @if (old('expedito') == 'CB') selected @endif>Cochabamba</option>
                        <option value="OR" @if (old('expedito') == 'OR') selected @endif>Oruro</option>
                        <option value="PT" @if (old('expedito') == 'PT') selected @endif>Potosí</option>
                        <option value="TJ" @if (old('expedito') == 'TJ') selected @endif>Tarija</option>
                        <option value="CH" @if (old('expedito') == 'CH') selected @endif>Chuquisaca</option>
                        <option value="BE" @if (old('expedito') == 'BE') selected @endif>Beni</option>
                        <option value="PD" @if (old('expedito') == 'PD') selected @endif>Pando</option>
                    </select>
                    @error('expedito')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                {{-- genero --}}
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Genero del Usuario</label>
                    <select class="form-control" name="genero">
                        <option value="1" @if (old('estado') == '1') selected @endif>Masculino</option>
                        <option value="0" @if (old('estado') == '0') selected @endif>Femenino</option>
                    </select>
                    @error('genero')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- cargo--}}
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Cargo del Usuario</label>
                    <input type="text" class="form-control" name="cargo" value="{{ old('cargo') }}"
                        placeholder="Ingrese el cargo del usuario"
                        pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                    @error('cargo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                {{-- unidad--}}
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Unidad del Usuario</label>
                    <input type="text" class="form-control" name="unidad" value="{{ old('unidad') }}"
                        placeholder="Ingrese el unidad del usuario"
                        pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                    @error('unidad')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- fnacimiento--}}
                <div class="form-group col-md-6 mb-3">
                    <label for="formGroupExampleInput">Fecha de nacimiento del Usuario</label>
                    <input type="date" class="form-control" name="fnacimiento" value="{{ old('fnacimiento') }}">
                    @error('fnacimiento')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

                {{-- role --}}
                <div class="form-group">
                    <label for="role">Rol del Usuario</label>
                    <select name="role" class="form-control">
                        <option value="" disabled selected>Selecciona un rol</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @if (old('role') == $role->id) selected @endif>
                                {{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                {{-- universidad
                <div class="form-group">
                    <label for="formGroupExampleInput">Universidad del Usuario</label>
                    <input type="text" class="form-control" name="universidad" value="{{ old('universidad') }}"
                        placeholder="Ingrese la universidad del usuario">
                    @error('universidad')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>--}}
                {{-- localizacion
                <div class="form-group">
                    <label for="formGroupExampleInput">Localizacion del Usuario</label>
                    <input type="text" class="form-control" name="localizacion" value="{{ old('localizacion') }}"
                        placeholder="Ingrese la localizacion del usuario">
                    @error('localizacion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>--}}

                {{-- carrera
                <div class="form-group">
                    <label for="formGroupExampleInput">Carrera del Usuario</label>
                    <input type="text" class="form-control" name="carrera" value="{{ old('carrera') }}"
                        placeholder="Ingrese la carrera del usuario">
                    @error('carrera')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>--}}


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

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i>
                        Agregar Usuario
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

    {{-- trabajando con mapa --}}


@stop
