@extends('adminlte::page')

@section('title', 'MENSAJES')

@section('content_header')
    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif; text-align: center;">
            <h1 style="text-transform: uppercase;">formulario para enviar mensajes</h1>
        </div>
    </div>
@stop

@section('content')
    <form method="POST" action="{{ route('mensajes.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
                <div class="form-row">

                    <div class="form-group" style="margin-left: 90px;">
                        <label style="text-align: center;" for="formGroupExampleInput">ENVIAR A</label>
                        <select multiple="multiple" size="10" name="tipo_persona_id[]" title="tipo_persona_id[]">
                            @foreach ($tipo_personas as $tipo_persona)
                                <option value="{{ $tipo_persona->id }}" @if (old('tipo_persona_id') && in_array($tipo_persona->id, old('tipo_persona_id'))) selected @endif>
                                    {{ $tipo_persona->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_persona_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 mb-3" style="margin-left: 90px; text-align: center;">
                        <label for="tipo_mensaje">TIPO DE MENSAJE:</label>
                        <select name="tipo_mensaje_id" class="form-group col-md-6 mb-3" id="tipo_mensaje_select">
                            <option value="" selected disabled>Seleccione el tipo de mensaje</option>
                            @foreach ($tipo_mensajes as $tipo_mensaje)
                                <option value="{{ $tipo_mensaje->id }}"
                                    {{ old('tipo_mensaje_id') == $tipo_mensaje->id ? 'selected' : '' }}>
                                    {{ $tipo_mensaje->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_mensaje_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        <div id="tipo_mensaje_descripcion" style="display:none; margin-top: 20px;">
                            <div id="descripcion_text"></div>

                            @can('tipo_mensajes.edit')
                                <a id="editar_link" class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan

                        </div>
                    </div>

                    {{-- cantidad personalizada --}}
                    <div class="form-group col-md-6 mb-3">
                        <div>
                            <label>
                                <input type="checkbox" id="generar-cantidad"> Cantidad personalizada
                            </label>
                        </div>

                        <div id="nuevo-cantidad" style="display: none;">
                            <div class="form-group">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad"
                                    placeholder="Cantidad" min="2" max="60000">
                                <small class="form-text text-muted">Ingrese un valor de 2 a 60000.</small>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="cantidad-inicio">Inicio:</label>
                                    <input type="number" class="form-control" id="cantidad-inicio" name="cantidad_inicio"
                                        placeholder="Inicio" min="1" max="60000">
                                    <small class="form-text text-muted">Ingrese un valor de 1 a 60000.</small>
                                </div>

                                <div class="form-group">
                                    <label for="cantidad-fin">Fin:</label>
                                    <input type="text" class="form-control" id="cantidad-fin" name="cantidad_fin"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div class="form-group" style="margin-left: 90px;">
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-success float-center">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Agrega un checkbox en tu formulario -->
        <div class="form-group">
            <label>
                <input type="checkbox" id="generar-formulario"> Mensaje personalizado
            </label>
        </div>

        <!-- Div para mostrar el nuevo formulario (inicialmente oculto) -->
        <div id="nuevo-formulario" style="display: none;">
            <div class="card container d-flex justify-content-center align-items-center"
                style="font-family: 'Times New Roman', Times, serif;">
                <div class="card-body col-md-8 mx-auto">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique
                                los
                                campos.</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf

                    <div class="form-group">
                        <label for="formGroupExampleInput">Nombre del tipo de mensaje</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"
                            placeholder="Ingrese el nombre del tipo de mensaje">
                        @error('nombre')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput">Contenido del mensaje</label>
                        <textarea id="summernote" class="form-control" name="descripcion"
                            placeholder="Ingrese el contenido del tipo de mensaje">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

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

                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </form>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">
@stop

@section('js')


    {{-- calculos de numeros --}}
    <script>
        var checkboxCantidad = document.getElementById('generar-cantidad');
        var nuevoCantidad = document.getElementById('nuevo-cantidad');
        var inputCantidad = document.getElementById('cantidad');
        var inputInicio = document.getElementById('cantidad-inicio');
        var inputFin = document.getElementById('cantidad-fin');

        checkboxCantidad.addEventListener('change', function() {
            nuevoCantidad.style.display = checkboxCantidad.checked ? 'block' : 'none';
            // Limpiar los campos al deseleccionar el checkbox
            if (!checkboxCantidad.checked) {
                inputCantidad.value = '';
                inputInicio.value = '';
                inputFin.value = '';
                resetValidation();
            }
        });

        function resetValidation() {
            inputCantidad.setCustomValidity('');
            inputInicio.setCustomValidity('');
        }

        inputCantidad.addEventListener('input', function() {
            calculateFin();
        });

        inputInicio.addEventListener('input', function() {
            calculateFin();
        });

        function calculateFin() {
            var cantidad = parseInt(inputCantidad.value);
            var inicio = parseInt(inputInicio.value);

            // Validar que los valores sean números enteros positivos y estén dentro del rango permitido
            if (isNaN(cantidad) || isNaN(inicio) ||
                cantidad < 2 || cantidad > 60000 ||
                inicio < 1 || inicio > 60000) {
                inputCantidad.setCustomValidity('Ingrese valores válidos.');
                return;
            }

            // Calcular fin como inicio + cantidad y mostrar en el campo readonly
            var fin = inicio + cantidad;
            inputFin.value = fin;

            // Limpiar mensaje de error
            resetValidation();
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('guardar') == 'ok')
        <script>
            Swal.fire('Lo sentimos pero la anterio contraseña no coincide', 'no se puedo modificar la contraseña.', 'error');
        </script>
    @endif
    @if (session('error') == 'ok')
        <script>
            Swal.fire('Lo sentimos la nueva contraseñno conincide', 'no se puedo modificar la contraseña.', 'error');
        </script>
    @endif
    @if (session('editar') == 'ok')
        <script>
            Swal.fire('Perfecto!', 'se envia los mensajes', 'success');
        </script>
    @endif

    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@latest/dist/summernote-bs5.js"></script>
    <script
        src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/jquery.bootstrap-duallistbox.js">
    </script>

    <script>
        $('#persona').DataTable({
            responsive: true,
            autowidth: false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Lo sentimos, pero no hay datos para mostrar",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Lo sentimos, pero no hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });

        // Inicializar Dual Listbox
        var tipo_persona_duallistbox = $('select[name="tipo_persona_id[]"]').bootstrapDualListbox({
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


        // Inicializar Summernote
        $(document).ready(function() {
            var usuarioNombre = '{{ ucfirst(auth()->user()->name) }}';
            var usuarioApellido = '{{ ucfirst(auth()->user()->apellidopaterno) }}';

            $('#summernote').summernote({
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['font', ['bold', 'clear']],
                    ['para', ['ul']],
                    ['view', ['fullscreen']],
                ],
                icons: {
                    'align': '<i class="custom-icon-align"></i>',
                    'italic': '<i class="custom-icon-italic"></i>',
                },
                callbacks: {
                    onPaste: function(e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData)
                            .getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    },
                    onInit: function() {
                        $('.non-editable').attr('contenteditable', 'false');
                    },
                    onKeydown: function(e) {
                        if (e.keyCode === 8 || e.keyCode === 46) {
                            var selection = window.getSelection();
                            if (selection.rangeCount > 0) {
                                var range = selection.getRangeAt(0);
                                if (range.startContainer.parentElement.classList.contains(
                                        'non-editable') || range.endContainer.parentElement.classList
                                    .contains('non-editable')) {
                                    e.preventDefault();
                                }
                            }
                        }
                    },
                    onKeyup: function(e) {
                        var nonEditableElements = $('.non-editable');
                        nonEditableElements.each(function() {
                            $(this).attr('contenteditable', 'false');
                        });
                    }
                }
            });

            function actualizarContenido() {
                var tipoMensaje = $('input[name="nombre"]').val().toUpperCase();
                var contenido = '<p class="non-editable">' + tipoMensaje + '</p><p class="non-editable">' +
                    usuarioNombre + ' ' + usuarioApellido + '</p><p><br></p>';
                $('#summernote').summernote('code', contenido);
            }

            $('input[name="nombre"]').on('input', function() {
                actualizarContenido();
            });

            actualizarContenido();

            $('form').on('submit', function() {
                var summernoteContent = $('#summernote').summernote('code');
                var cleanedContent = $('<div>').html(summernoteContent).find('.non-editable').remove().end()
                    .html();
                $('#summernote').summernote('code', cleanedContent);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipoMensajes = @json($tipo_mensajes);

            const tipoMensajeSelect = document.getElementById('tipo_mensaje_select');
            const descripcionDiv = document.getElementById('tipo_mensaje_descripcion');
            const descripcionText = document.getElementById('descripcion_text');
            const editarLink = document.getElementById('editar_link');

            tipoMensajeSelect.addEventListener('change', function() {
                const selectedId = this.value;
                const selectedMensaje = tipoMensajes.find(mensaje => mensaje.id == selectedId);

                if (selectedMensaje) {
                    descripcionText.innerHTML = selectedMensaje
                    .descripcion; // Usando innerHTML para interpretar HTML
                    descripcionDiv.style.display = 'block';
                    editarLink.href = `/tipo_mensajes/${selectedId}/edit`;
                } else {
                    descripcionDiv.style.display = 'none';
                }
            });
        });
    </script>
@stop
