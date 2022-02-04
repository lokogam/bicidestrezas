@extends('layouts/contentLayoutMaster')

@section('title', 'Registros Acciones')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
@endsection

@section('content')
    <div>
        <section id="basic-datatable" class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Registros Acciones</h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <p class="card-text">
                                
                                <a onclick="exportarexcel();">
                                    <button type="button"
                                        class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light">Exportar
                                        Acciones</button>
                                </a>

                                <a style="display: none" onclick="pdfproteccionmasivo();" id="pdfproteccionmasivo">
                                    <button type="button"
                                        class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light">PDF
                                        Protección</button>
                                </a>

                                <a style="display: none" onclick="pdfconsentimientomasivo();" id="pdfconsentimientomasivo">
                                    <button type="button"
                                        class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light">PDF
                                        Consentimiento</button>
                                </a>

                                <a style="display: none" onclick="certificadomasivo();" id="certificadomasivo">
                                    <button type="button"
                                        class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light">PDF
                                        Certificados</button>
                                </a>
                            </p>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Filtro punto</label>
                                        <select class="select2 form-control" id="punto" onchange="tabla()">
                                            <option value=""></option>
                                            @foreach ($puntos as $punto)
                                                <option value="{{ $punto->id }}">{{ $punto->nombre_punto }} -
                                                    {{ $punto->ubicacion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Filtro jornada</label>
                                        <select class="select2 form-control" id="jornada" onchange="tabla()">
                                            <option value=""></option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Filtro fecha - desde</label>
                                        <input type='date' class="form-control" id="fecha_desde" onchange="tabla()">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Hasta</label>
                                        <input type='date' class="form-control" id="fecha_hasta" onchange="tabla()">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group"><br>
                                        <input type='button' class="btn btn-info" onclick="reiniciarFiltros()"
                                            value="Reiniciar Filtros">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div>
                                    <div class="table-responsive" id="tabla_registros">
                                        @include('pages.tabla_registros_acciones')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div id="detalleModal" class="modal fade text-left" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel17">Detalles de la Acción</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detalleBody">
                </div>
            </div>
        </div>
    </div>

    <div id="detalleArchivos" class="modal fade text-left" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel17">CARGUE DE ARCHIVOS</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="{{ URL::to('formulario/guardararchivos') }}" enctype="multipart/form-data"
                    id="env_form">

                    @csrf

                    <div class="modal-body" id="detalleBody">
                        <input type="hidden" id="id_registro" name="id_registro" value="">

                        <div class="row">
                            <div class="col-sm-12">
                                <img id="img_previa" class="img_previa" width="250px" style="border-radius: 7px;">
                            </div>

                            <div class="col-sm-6">
                                <label for="">Seleccionar la forma en que desea cargar la foto</label><br>
                                <input type="checkbox" name="check" onclick="onlyOne(this,1)" checked=""> Camara
                                <br>
                                <input type="checkbox" name="check" onclick="onlyOne(this,2)"> Galeria
                            </div>

                            <div class="col-sm-6">
                                <label for="">Foto</label>

                                <input type="file" capture="camera" accept="image/*" class="form-control" name="foto"
                                    id="foto" value="" onchange="ValidarImagen(this)">
                            </div>
                        </div>

                        <br>

                        <div class="row" id="campo_video">
                            <div class="col-sm-12">
                                <video id="vid_previa" class="vid_previa" width="150px" height="150px"
                                    style="border-radius: 7px;" controls>
                            </div>

                            <div class="col-sm-6">
                                <label for="">Seleccionar la forma en que desea cargar el video</label><br>
                                <input type="checkbox" name="checkVideo" onclick="onlyOneVideo(this,1)" checked="">
                                Camara <br>
                                <input type="checkbox" name="checkVideo" onclick="onlyOneVideo(this,2)"> Galeria
                            </div>

                            <div class="col-sm-6">
                                <label for="">Video</label>
                                <input type="file" capture="camera" accept="video/*" class="form-control"
                                    name="file_video" id="file_video" value="" onchange="fileValidation()">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button id="enviar" type="button" class="btn btn-info" style="float: right;"
                            onclick="guardarArchivos()">
                            Guardar
                        </button>

                        <button class="btn btn-info mb-1" type="button" disabled style="float: right;display: none;"
                            id="cargando">
                            <span class="">siguiente </span>

                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </section>

    <script>
        function onlyOne(checkbox, id) {
            var checkboxes = document.getElementsByName('check')

            checkboxes.forEach((item) => {
                if (item !== checkbox) item.checked = false
            })

            if (id == 2) {
                console.log('galeria');
                jQuery("#foto").removeAttr("capture");
            } else {
                console.log('camara');
                document.getElementById("foto").setAttribute("capture", "camara");
            }
        }

        function onlyOneVideo(checkbox, id) {
            var checkboxes = document.getElementsByName('checkVideo')
            checkboxes.forEach((item) => {
                if (item !== checkbox) item.checked = false
            })

            if (id == 2) {
                jQuery("#file_video").removeAttr("capture");
            } else {
                document.getElementById("file_video").setAttribute("capture", "camara");
            }
        }

        function ValidarImagen(obj) {
            var uploadFile = obj.files[0];

            var fileInput = document.getElementById('foto');

            if (!window.FileReader) {
                toastr.warning('El navegador no soporta la lectura de archivos.', 'Advertencia');
                return;
            }

            if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
                toastr.warning('El archivo a adjuntar no es una imagen.', 'Advertencia');
            } else {
                var img = new Image();

                img.onload = function() {
                    if (this.width.toFixed(0) < 1280 || this.height.toFixed(0) < 1024) {
                        toastr.error('Las medidas deben ser: 1280 * 1024 o mayor.', 'Advertencia');

                        fileInput.value = '';

                        return false;
                    }
                };

                img.src = URL.createObjectURL(uploadFile);
            }
        }

        function fileValidation() {
            var fileInput = document.getElementById('file_video');
            var filePath = fileInput.value;

            var allowedExtensions = /(.mp4|.avi|.3gp|.mov|.mpeg)$/i;

            if (!allowedExtensions.exec(filePath)) {
                toastr.error('Por favor solo cargue archivos con extension .mp4/.avi/.3gp/.mov/.mpeg .', 'Error');

                fileInput.value = '';

                return false;
            }

            var fileSize = $('#file_video')[0].files[0].size;

            if (fileSize > 100242880) {
                toastr.error('Archivo demasiado grande. El archivo debe ser menor que 100MB.', 'Error');

                fileInput.value = '';

                return false;
            }
        }

        function showModalArchivos(id) {
            $('#id_registro').val(id);
        }

        function guardarArchivos() {
            $('#cargando').show();
            $('#enviar').hide();

            $('#env_form').submit();
        }

        function showModal(id) {
            var parametros = {
                "id": id
            };

            $.ajax({
                data: parametros,
                url: "{{ route('detalleaccion') }}",
                type: 'get',

                success: function(response) {
                    $("#detalleBody").html(response);
                }
            });
        }

        function tabla() {
            var punto = $("#punto").val();
            var jornada = $("#jornada").val();
            var fecha = $("#fecha_desde").val();
            var fecha_H = $("#fecha_hasta").val();

            $('#pdfproteccionmasivo').show();
            $('#pdfconsentimientomasivo').show();
            $('#certificadomasivo').show();

            if (fecha != "") {
                if (fecha_H == "") {
                    $('#fecha_hasta').focus();
                    return;
                }
            }

            if (fecha_H != "") {
                if (fecha == "") {
                    $('#fecha_desde').focus();
                    return;
                }
            }

            var parametros = {
                "puntoR": punto,
                "jornadaR": jornada,
                "fechaR": fecha,
                "fechahR": fecha_H,
                "filtro": 1
            };

            $.ajax({
                data: parametros,
                url: " {{ route('registrosacciones') }}",
                type: 'get',

                success: function(response) {
                    $("#tabla_registros").html(response);
                }
            });
        }

        function reiniciarFiltros() {
            var puntoR = $("#punto").val('');
            var jornadaR = $("#jornada").val('');
            var fechaR = $("#fecha_desde").val('');
            var fechahR = $("#fecha_hasta").val('');

            $('#pdfproteccionmasivo').hide();
            $('#pdfconsentimientomasivo').hide();
            $('#certificadomasivo').hide();

            var parametros = {
                "puntoR": '',
                "jornadaR": '',
                "fechaR": '',
                "filtro": 1
            };

            $.ajax({
                data: parametros,
                url: " {{ route('registrosacciones') }}",
                type: 'get',

                success: function(response) {
                    $("#tabla_registros").html(response);
                }
            });

        }

        function exportarexcel() {
            var punto = $("#punto").val();
            var jornada = $("#jornada").val();
            var fecha = $("#fecha_desde").val();
            var fecha_hasta = $("#fecha_hasta").val();

            var dir = "exportarexcelacciones?punto=" + punto + "&jornada=" + jornada + "&fecha=" + fecha + "&fecha_hasta=" + fecha_hasta;

            window.open(dir);
        }

        function pdfproteccionmasivo() {
            var punto = $("#punto").val();
            var jornada = $("#jornada").val();
            var fecha = $("#fecha_desde").val();
            var fecha_hasta = $("#fecha_hasta").val();

            var dir = "pdfproteccionmasivo?punto=" + punto + "&jornada=" + jornada + "&fecha=" + fecha + "&fecha_hasta=" + fecha_hasta;

            window.open(dir);
        }

        function pdfconsentimientomasivo() {
            var punto = $("#punto").val();
            var jornada = $("#jornada").val();
            var fecha = $("#fecha_desde").val();
            var fecha_hasta = $("#fecha_hasta").val();

            var dir = "pdfconsentimientomasivo?punto=" + punto + "&jornada=" + jornada + "&fecha=" + fecha + "&fecha_hasta=" + fecha_hasta;

            window.open(dir);
        }

        function certificadomasivo() {
            var punto = $("#punto").val();
            var jornada = $("#jornada").val();
            var fecha = $("#fecha_desde").val();
            var fecha_hasta = $("#fecha_hasta").val();

            var dir = "certificadomasivo?punto=" + punto + "&jornada=" + jornada + "&fecha=" + fecha + "&fecha_hasta=" + fecha_hasta;

            window.open(dir);
        }
    </script>

    <script type="text/javascript">
        const photo = document.querySelector('#img_previa');
        const camera = document.querySelector('#foto');
        camera.addEventListener('change', function(e) {
            var uploadFile = $('#foto')[0].files[0];

            var img = new Image();

            img.onload = function() {
                if (this.width.toFixed(0) > 1280 && this.height.toFixed(0) > 1024) {
                    photo.src = URL.createObjectURL(e.target.files[0]);
                } else {
                    photo.src = '';
                }
            };

            img.src = URL.createObjectURL(uploadFile);
        });

        const video = document.querySelector('#vid_previa');
        const cameravideo = document.querySelector('#file_video');
        cameravideo.addEventListener('change', function(e) {
            video.src = URL.createObjectURL(e.target.files[0]);
        });
    </script>
@endsection

@section('vendor-script')
    <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
@endsection
