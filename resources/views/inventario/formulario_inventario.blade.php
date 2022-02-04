@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de chequeo de punto')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">LISTA DE CHEQUEO PUNTO</h3>
        </div>

        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Completado <i class="fa fa-check"></i></h4>

                                <p class="mb-0">
                                    Se ha guardado correctamente.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ URL::to('chequeo/guardarinventario') }}" enctype="multipart/form-data" id="env_invent">
        @csrf
        <div class="card">
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body">
                    <div id="estado_equipos">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="fecha">Fecha de la actividad</label>

                                <input class="form-control" type="date" name="fecha" id="fecha">
                            </div>

                            <div class="col-sm-3">
                                <label for="hora_desde">Hora desde las</label>

                                <input type="time" class="form-control" name="hora_desde" id="hora_desde">
                            </div>

                            <div class="col-sm-3">
                                <label for="hora_hasta">Hasta las</label>

                                <input type="time" class="form-control" name="hora_hasta" id="hora_hasta">
                            </div>

                            <div class="col-sm-6">
                                <label for="ubicacion_punto">Ubicación del punto</label>

                                <select class="form-control" name="ubicacion_punto" id="ubicacion_punto">
                                    <option value=""></option>
                                    @foreach ($puntos as $punto)
                                        <option value="{{ $punto->id }}">{{ $punto->nombre_punto }} -
                                            {{ $punto->ubicacion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body">
                    <div id="estado_equipos">
                        <h4>ESPECIFICACIONES LOGÍSTICAS PARA LAS ACCIONES EN VÍA <span style="color: red;">*</span></h4>

                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>

                                            <th scope="col">
                                                <center>SI</center>
                                            </th>

                                            <th scope="col">
                                                <center>NO</center>
                                            </th>

                                            <th scope="col">
                                                <center>N.A.</center>
                                            </th>

                                            <th scope="col">
                                                <center>OBSERVACIONES</center>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($especificaciones as $key)
                                            <tr>
                                                <th scope="row">
                                                    <center>{{ $key->item }}</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="especificacion{{ $key->id }}"
                                                            id="especificacion{{ $key->id }}" value="SI" checked>
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="especificacion{{ $key->id }}"
                                                            value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="especificacion{{ $key->id }}"
                                                            value="NA">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <textarea class="form-control"
                                                            name="especificacion_observacion{{ $key->id }}" cols="50"
                                                            rows="2"></textarea>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body">
                    <div id="estado_equipos">
                        <h4>ELEMENTOS REVISIÓN MECANICA <span style="color: red;">*</span></h4>

                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>

                                            <th scope="col">
                                                <center>SI</center>
                                            </th>

                                            <th scope="col">
                                                <center>NO</center>
                                            </th>

                                            <th scope="col">
                                                <center>N.A.</center>
                                            </th>

                                            <th scope="col">
                                                <center>OBSERVACIONES</center>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($elementos_revision as $key)
                                            <tr>
                                                <th scope="row">
                                                    <center>{{ $key->item }}</center>
                                                </th>

                                                <td>
                                                    <center><input type="radio" name="elemento_revision{{ $key->id }}"
                                                            id="elemento_revision{{ $key->id }}" value="SI" checked>
                                                    </center>
                                                </td>

                                                <td>
                                                    <center><input type="radio" name="elemento_revision{{ $key->id }}"
                                                            value="NO"></center>
                                                </td>

                                                <td>
                                                    <center><input type="radio" name="elemento_revision{{ $key->id }}"
                                                            value="NA"></center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <textarea class="form-control"
                                                            name="elemento_revision_observacion{{ $key->id }}"
                                                            cols="50" rows="2"></textarea>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body">
                    <div id="estado_equipos">
                        <h4>ELEMENTOS RETO <span style="color: red;">*</span></h4>

                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>

                                            <th scope="col">
                                                <center>SI</center>
                                            </th>

                                            <th scope="col">
                                                <center>NO</center>
                                            </th>

                                            <th scope="col">
                                                <center>N.A.</center>
                                            </th>

                                            <th scope="col">
                                                <center>OBSERVACIONES</center>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($elementos_reto as $key)
                                            <tr>
                                                <th scope="row">
                                                    <center>{{ $key->item }}</center>
                                                </th>

                                                <td>
                                                    <center><input type="radio" name="elemento_reto{{ $key->id }}"
                                                            id="elemento_reto{{ $key->id }}" value="SI" checked>
                                                    </center>
                                                </td>

                                                <td>
                                                    <center><input type="radio" name="elemento_reto{{ $key->id }}"
                                                            value="NO"></center>
                                                </td>

                                                <td>
                                                    <center><input type="radio" name="elemento_reto{{ $key->id }}"
                                                            value="NA"></center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <textarea class="form-control"
                                                            name="elemento_reto_observacion{{ $key->id }}" cols="50"
                                                            rows="2"></textarea>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body">
                    <div id="estado_equipos">
                        <h4>ELEMENTOS ADICIONALES <span style="color: red;">*</span></h4>

                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>

                                            <th scope="col">
                                                <center>SI</center>
                                            </th>

                                            <th scope="col">
                                                <center>NO</center>
                                            </th>

                                            <th scope="col">
                                                <center>N.A.</center>
                                            </th>

                                            <th scope="col">
                                                <center>OBSERVACIONES</center>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($elementos_adicionales as $key)
                                            <tr>
                                                <th scope="row">
                                                    <center>{{ $key->item }}</center>
                                                </th>

                                                <td>
                                                    <center><input type="radio"
                                                            name="elemento_adicional{{ $key->id }}"
                                                            id="elemento_adicional{{ $key->id }}" value="SI" checked>
                                                    </center>
                                                </td>

                                                <td>
                                                    <center><input type="radio"
                                                            name="elemento_adicional{{ $key->id }}" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center><input type="radio"
                                                            name="elemento_adicional{{ $key->id }}" value="NA">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <textarea class="form-control"
                                                            name="elemento_adicional_observacion{{ $key->id }}"
                                                            cols="50" rows="2"></textarea>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body">
                    <div id="estado_equipos">
                        <h4>PERMISOS <span style="color: red;">*</span></h4>

                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>

                                            <th scope="col">
                                                <center>SI</center>
                                            </th>

                                            <th scope="col">
                                                <center>NO</center>
                                            </th>

                                            <th scope="col">
                                                <center>N.A.</center>
                                            </th>

                                            <th scope="col">
                                                <center>OBSERVACIONES</center>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($permisos as $key)
                                            <tr>
                                                <th scope="row">
                                                    <center>{{ $key->item }}</center>
                                                </th>

                                                <td>
                                                    <center><input type="radio" name="permiso{{ $key->id }}"
                                                            id="permiso{{ $key->id }}" value="SI" checked></center>
                                                </td>

                                                <td>
                                                    <center><input type="radio" name="permiso{{ $key->id }}"
                                                            value="NO"></center>
                                                </td>

                                                <td>
                                                    <center><input type="radio" name="permiso{{ $key->id }}"
                                                            value="NA"></center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <textarea class="form-control"
                                                            name="permiso_observacion{{ $key->id }}" cols="50"
                                                            rows="2"></textarea>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body">
                    <div id="estado_equipos">
                        <h4>ELEMENTOS DE GESTIÓN DE RIESGOS <span style="color: red;">*</span></h4>

                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>

                                            <th scope="col">
                                                <center>SI</center>
                                            </th>

                                            <th scope="col">
                                                <center>NO</center>
                                            </th>

                                            <th scope="col">
                                                <center>N.A.</center>
                                            </th>

                                            <th scope="col">
                                                <center>OBSERVACIONES</center>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($elementos_gestion as $key)
                                            <tr>
                                                <th scope="row">
                                                    <center>{{ $key->item }}</center>
                                                </th>

                                                <td>
                                                    <center><input type="radio" name="elemento_gestion{{ $key->id }}"
                                                            id="elemento_gestion{{ $key->id }}" value="SI" checked>
                                                    </center>
                                                </td>

                                                <td>
                                                    <center><input type="radio" name="elemento_gestion{{ $key->id }}"
                                                            value="NO"></center>
                                                </td>

                                                <td>
                                                    <center><input type="radio" name="elemento_gestion{{ $key->id }}"
                                                            value="NA"></center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <textarea class="form-control"
                                                            name="elemento_gestion_observacion{{ $key->id }}"
                                                            cols="50" rows="2"></textarea>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body">
                    <div id="estado_equipos">
                        <h4>CONTROL DE ASISTENCIA <span style="color: red;">*</span></h4>

                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>

                                            <th scope="col">
                                                <center>SI</center>
                                            </th>

                                            <th scope="col">
                                                <center>NO</center>
                                            </th>

                                            <th scope="col">
                                                <center>N.A.</center>
                                            </th>

                                            <th scope="col">
                                                <center>OBSERVACIONES</center>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($control_asistencia as $key)
                                            <tr>
                                                <th scope="row">
                                                    <center>{{ $key->item }}</center>
                                                </th>

                                                <td>
                                                    <center><input type="radio"
                                                            name="control_asistencia{{ $key->id }}"
                                                            id="control_asistencia{{ $key->id }}" value="SI" checked>
                                                    </center>
                                                </td>

                                                <td>
                                                    <center><input type="radio"
                                                            name="control_asistencia{{ $key->id }}" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center><input type="radio"
                                                            name="control_asistencia{{ $key->id }}" value="NA">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <textarea class="form-control"
                                                            name="control_asistencia_observacion{{ $key->id }}"
                                                            cols="50" rows="2"></textarea>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body">
                    <div id="estado_equipos">
                        <h4>KIT DE HIGIENE Y SALUD <span style="color: red;">*</span></h4>

                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>

                                            <th scope="col">
                                                <center>SI</center>
                                            </th>

                                            <th scope="col">
                                                <center>NO</center>
                                            </th>

                                            <th scope="col">
                                                <center>N.A.</center>
                                            </th>

                                            <th scope="col">
                                                <center>OBSERVACIONES</center>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($kit_higiene as $key)
                                            <tr>
                                                <th scope="row">
                                                    <center>{{ $key->item }}</center>
                                                </th>

                                                <td>
                                                    <center><input type="radio" name="kit_higiene{{ $key->id }}"
                                                            id="kit_higiene{{ $key->id }}" value="SI" checked>
                                                    </center>
                                                </td>

                                                <td>
                                                    <center><input type="radio" name="kit_higiene{{ $key->id }}"
                                                            value="NO"></center>
                                                </td>

                                                <td>
                                                    <center><input type="radio" name="kit_higiene{{ $key->id }}"
                                                            value="NA"></center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <textarea class="form-control"
                                                            name="kit_higiene_observacion{{ $key->id }}" cols="50"
                                                            rows="2"></textarea>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div id="signature-pad" class="signature-pad">
                                <div class="description">Firmas<span id="alerta_firma" style="color:red;display: none;">La firma
                                        es obligatoria.</span>
                                </div>
        
                                <div class="signature-pad-body">
                                    <canvas style="width: 600px; height: 150px; border: 1px black solid; " id="canvas"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="nombre_tecnico">Nombre técnico</label>

                                <input type="text" class="form-control" name="nombre_tecnico" id="nombre_tecnico">
                        </div>
                    </div>
                    

                    <br>

                    <input type="hidden" name="base64" value="" id="base64">

                    <button type="button" class="btn btn-primary" onclick="limpiarcanvas()"><i
                            class="feather icon-refresh-ccw"></i> Limpiar</button>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button id="enviar" type="button" class="btn btn-primary"
                onclick="guardar({{ $especificaciones }},{{ $elementos_revision }},{{ $elementos_reto }},{{ $elementos_adicionales }},{{ $permisos }},{{ $elementos_gestion }});"
                style="float: right;">
                Guardar <i class="feather icon-save"></i>
            </button>

            <button class="btn btn-primary mb-1" type="button" disabled style="float: right;display: none;" id="cargando">
                <span class="">Cargando ... </span>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            </button>
        </div>
        </div>
    </form>

    <button style="display: none;" type="button" class="btn btn-success" data-toggle="modal" data-target="#error"><i
            class="feather icon-plus" id="modalerror"></i></button>

    <div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="errorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="error">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorLabel">PRECAUCIÓN <i class="fa fa-exclamation-triangle"
                            style="color:orange;"></i></h5>
                </div>

                <div class="modal-body">
                    <center>
                        <p id="texto_error"></p>
                    </center>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ URL::to('app-assets/js/scripts/jquery.min.js') }}"></script>
    <script src="{{ URL::to('app-assets/js/scripts/signature_pad.js') }}"></script>

    <script>
        var wrapper = document.getElementById("signature-pad");

        var canvas = wrapper.querySelector("canvas");

        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)'
        });

        function resizeCanvas() {
            var ratio = Math.max(window.devicePixelRatio || 1, 1);

            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);

            signaturePad.clear();
        }

        window.onresize = resizeCanvas;
        resizeCanvas();

        function limpiarcanvas() {
            signaturePad.clear();
        }

        function cambiarmunicipio() {
            var departamento = $("#departamento").find(':selected').val();

            if (departamento != 0) {
                $("#municipio").load('selected_municipio?id=' + departamento);
            }
        }

        function guardar(especificaciones, elementos_revision, elementos_reto, elementos_adicionales, permisos,
            elementos_gestion) {
            var fecha = $('#fecha').val();
            if (fecha == "") {
                $('#fecha').focus();
                return;
            }

            var hora_desde = $('#hora_desde').val();
            if (hora_desde == "") {
                $('#hora_desde').focus();
                return;
            }

            var hora_hasta = $('#hora_hasta').val();
            if (hora_hasta == "") {
                $('#hora_hasta').focus();
                return;
            }

            var departamento = $('#departamento').val();
            if (departamento == "") {
                $('#departamento').focus();
                return;
            }

            var municipio = $('#municipio').val();
            if (municipio == "") {
                $('#municipio').focus();
                return;
            }

            var ubicacion_punto = $('#ubicacion_punto').val();
            if (ubicacion_punto == "") {
                $('#ubicacion_punto').focus();
                return;
            }


            for (let index = 0; index < especificaciones.length; index++) {
                const element = especificaciones[index];

                if (!document.querySelector('input[name="especificacion' + element['id'] + '"]:checked')) {
                    $('#texto_error').html(
                        'El campo <b>' + element['especificacion'] +
                        '</b> en la sección <b>ESPECIFICACIONES LOGÍSTICAS PARA LAS ACCIONES EN VÍA</b> no puede estar vacío.'
                    );
                    $('#especificacion' + element['id']).focus();
                    $('#modalerror').click();
                    return;
                }
            }

            for (let index = 0; index < elementos_revision.length; index++) {
                const element = elementos_revision[index];

                if (!document.querySelector('input[name="elemento_revision' + element['id'] + '"]:checked')) {
                    $('#texto_error').html(
                        'El campo <b>' + element['elemento_revision'] +
                        '</b> en la sección <b>ELEMENTOS REVISIÓN MECANICA</b> no puede estar vacío.');
                    $('#elemento_revision' + element['id']).focus();
                    $('#modalerror').click();
                    return;
                }
            }

            for (let index = 0; index < elementos_reto.length; index++) {
                const element = elementos_reto[index];

                if (!document.querySelector('input[name="elemento_reto' + element['id'] + '"]:checked')) {
                    $('#texto_error').html(
                        'El campo <b>' + element['elemento_reto'] +
                        '</b> en la sección <b>ELEMENTOS RETO</b> no puede estar vacío.');
                    $('#elemento_reto' + element['id']).focus();
                    $('#modalerror').click();
                    return;
                }
            }

            for (let index = 0; index < elementos_adicionales.length; index++) {
                const element = elementos_adicionales[index];

                if (!document.querySelector('input[name="elemento_adicional' + element['id'] + '"]:checked')) {
                    $('#texto_error').html(
                        'El campo <b>' + element['elemento_adicional'] +
                        '</b> en la sección <b>ELEMENTOS ADICIONALES</b> no puede estar vacío.');
                    $('#elemento_adicional' + element['id']).focus();
                    $('#modalerror').click();
                    return;
                }
            }

            for (let index = 0; index < permisos.length; index++) {
                const element = permisos[index];

                if (!document.querySelector('input[name="permiso' + element['id'] + '"]:checked')) {
                    $('#texto_error').html(
                        'El campo <b>' + element['permiso'] +
                        '</b> en la sección <b>PERMISOS</b> no puede estar vacío.');
                    $('#permiso' + element['id']).focus();
                    $('#modalerror').click();
                    return;
                }
            }

            for (let index = 0; index < elementos_gestion.length; index++) {
                const element = elementos_gestion[index];

                if (!document.querySelector('input[name="elemento_gestion' + element['id'] + '"]:checked')) {
                    $('#texto_error').html(
                        'El campo <b>' + element['elemento_gestion'] +
                        '</b> en la sección <b>ELEMENTOS DE GESTIÓN DE RIESGOS</b> no puede estar vacío.');
                    $('#elemento_gestion' + element['id']).focus();
                    $('#modalerror').click();
                    return;
                }
            }

            if (signaturePad.isEmpty()) {
                $('#alerta_firma').show();

                return;
            } else {
                $('#alerta_firma').hide();
            }

            var ctx = document.getElementById("canvas");
            var image = ctx.toDataURL(); // data:image/png....

            document.getElementById('base64').value = image;

            $('#enviar').hide();
            $('#cargando').show();
            $('#env_invent').submit();
        }
    </script>

@endsection
