@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1>{{ ucfirst('modificar al tipo de persona:') }}&nbsp;{{ ucfirst($tipo_persona->nombre) }}</h1>
        </div>
    </div>
@stop

@section('content')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body col-md-6 mx-auto">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos y no
                        olvide subir la foto.</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('tipo_personas.update', $tipo_persona) }}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')


                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del tipo de persona</label>
                    <input type="text" class="form-control" name="nombre"
                        value="{{ old('nombre', $tipo_persona->nombre) }}"
                        pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>



                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Contenido</label>
                    <input type="text" class="form-control" name="descripcion"
                        value="{{ old('descripcion', $tipo_persona->descripcion) }}"
                        pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>



                {{-- estado --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Estado del tipo de persona</label>
                    <select class="form-control" name="estado">
                        <option value="1" @if (old('estado', $tipo_persona->estado) == '1') selected @endif>activo</option>
                        <option value="0" @if (old('estado', $tipo_persona->estado) == '0') selected @endif>inactivo</option>
                    </select>
                    @error('estado')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar tipo de persona
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

    <script>
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
