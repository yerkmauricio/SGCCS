@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1>{{ ucfirst('modificar a la persona:') }}&nbsp;{{ ucfirst($persona->nombre) }}&nbsp;{{ ucfirst($persona->apellidop) }}
            </h1>
        </div>
    </div>
@stop

@section('content')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <br>
        <h4 style="text-transform: uppercase; font-weight: bold; text-align: center;">Formulario de edicion</h4>
        <div class="card-body col-md-9 mx-auto">
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
            <form method="POST" action="{{ route('personas.update', $persona) }}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                <div class="form-row">
                    {{-- nombre --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Nombre de la Persona</label>
                        <input type="text" class="form-control" name="nombre"
                            value="{{ old('nombre', $persona->nombre) }}" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                        @error('nombre')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>



                    {{-- apellidop --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Apellido paterno</label>
                        <input type="text" class="form-control" name="apellidop"
                            value="{{ old('apellidop', $persona->apellidop) }}" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                            title="Solo se permiten letras, sin espacios">
                        @error('apellidop')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">

                    {{-- apellidom --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Apellido materno</label>
                        <input type="text" class="form-control" name="apellidom"
                            value="{{ old('apellidom', $persona->apellidom) }}" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$"
                            title="Solo se permiten letras, sin espacios">
                        @error('apellidom')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- genero --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Genero de la Persona</label>
                        <select class="form-control" name="genero">
                            <option value="1" @if (old('genero', $persona->genero) == '1') selected @endif>Masculino</option>
                            <option value="0" @if (old('genero', $persona->genero) == '0') selected @endif>Femenino</option>
                        </select>
                        @error('genero')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">


                    {{-- whatsapp --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Whatsapp de la Persona</label>
                        <div class="input-group">
                            <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                                value="{{ old('whatsapp', $persona->whatsapp) }}"placeholder="Ingrese el whatsapp del persona"
                                pattern="^[0-9]+$" title="Solo se permiten números">
                            <input type="hidden" id="codigoPais" name="codigoPais">
                        </div>
                        @error('whatsapp')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- institucion --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Institucion de la Persona</label>
                        <input type="text" class="form-control" name="institucion"
                            value="{{ old('institucion', $persona->institucion) }}"
                            placeholder="Ingrese la institucion de la persona" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                        @error('institucion')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    {{-- cargo --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Cargo de la Persona</label>
                        <input type="text" class="form-control" name="cargo"
                            value="{{ old('cargo', $persona->cargo) }}" placeholder="Ingrese el cargo de la persona"
                            pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$" title="Solo se permiten letras y espacios">
                        @error('cargo')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- unidad --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Unidad de la Persona</label>
                        <input type="text" class="form-control" name="unidad"
                            value="{{ old('unidad', $persona->unidad) }}" placeholder="Ingrese el unidad de la persona"
                            pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$" title="Solo se permiten letras y espacios">
                        @error('unidad')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">


                    {{-- sede --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Sede de la Persona</label>
                        <input type="text" class="form-control" name="sede" value="{{ old('sede', $persona->sede) }}"
                            placeholder="Ingrese la sede de la persona" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                        @error('sede')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- carrera --}}
                    <div class="form-group col-md-6 mb-3">
                        <label for="formGroupExampleInput">Carrera de la Persona</label>
                        <input type="text" class="form-control" name="carrera"
                            value="{{ old('carrera', $persona->carrera) }}"
                            placeholder="Ingrese la carrera de la persona" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$"
                            title="Solo se permiten letras y espacios">
                        @error('carrera')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- tipo_persona --}}
                {{-- <div class="form-group col-md-6 mb-3">
                    <label for="tipo_persona">Tipo de Persona:</label>
                    <select name="tipo_persona_id" class="form-control">
                        <option value="" selected disabled>Seleccione el tipo de persona</option>

                        @foreach ($tipo_personas as $tipo_personaId => $tipo_personaNombre)
                            <option value="{{ $tipo_personaId }}"
                                {{ old('tipo_persona_id', $persona->tipo_persona_id) == $tipo_personaId ? 'selected' : '' }}>
                                {{ $tipo_personaNombre }}
                            </option>
                        @endforeach

                    </select>
                    @error('tipo_persona_id')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div> --}}
                <div class="form-group">
                    <label style="text-align: center;" for="tipo_persona_ids">Tipos de Persona:</label>
                    <select multiple="multiple" size="10" name="tipo_persona_ids[]" title="tipo_persona_ids[]">
                        @foreach ($tipo_personas as $tipo_personaId => $tipo_personaNombre)
                            <option value="{{ $tipo_personaId }}"
                                @if (old('tipo_persona_ids') && in_array($tipo_personaId, old('tipo_persona_ids')))
                                    selected
                                @elseif (isset($persona) && $persona->tipoPersonas->contains($tipo_personaId))
                                    selected
                                @endif
                            >
                                {{ $tipo_personaNombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('tipo_persona_ids')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar Persona
                    </button>
                </div>
            </form>

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link rel="stylesheet" type="text/css"
            href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">
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
     <script
     src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/jquery.bootstrap-duallistbox.js">
 </script>
 <script>
     // Inicializar Dual Listbox
     var tipo_persona_duallistbox = $('select[name="tipo_persona_ids[]"]').bootstrapDualListbox({
         nonSelectedListLabel: 'Tipos de Personas Disponibles',
         selectedListLabel: 'Tipos de Personas Seleccionadas',
         preserveSelectionOnMove: 'moved',
         moveAllLabel: 'Mover todos',
         removeAllLabel: 'Eliminar todos',
         infoText: 'Mostrando todo {0}',
         infoTextFiltered: '<span class="badge badge-warning">Filtrado</span> {0} de {1}',
         infoTextEmpty: 'Lista vacía',
         filterPlaceHolder: 'Filtrar',
         moveSelectedLabel: 'Mover seleccionado',
         removeSelectedLabel: 'Eliminar seleccionado'

     });
     $('.moveall').html('Mover todos <span class="badge badge-secondary"> </span>');
     $('.removeall').html('Eliminar todos <span class="badge badge-secondary"> </span>');

     // Inicializar Dual Listbox

     // Mostrar u ocultar el nuevo formulario según el estado del checkbox
     var checkbox = document.getElementById('generar-formulario');
     var nuevoFormulario = document.getElementById('nuevo-formulario');
     checkbox.addEventListener('change', function() {
         nuevoFormulario.style.display = checkbox.checked ? 'block' : 'none';
     });
 </script>

@stop
