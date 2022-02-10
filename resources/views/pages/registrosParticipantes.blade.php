@extends('layouts/contentLayoutMaster')

@section('title', 'Registros Participantes')

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
                        <h4 class="card-title">Registros Participantes</h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <p class="card-text">
                                <a onclick="exportarexcel();">
                                    <button type="button"
                                        class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light">Exportar
                                        Encuestados</button>
                                </a>

                                <a style="display: none" onclick="pdfproteccionmasivo();" id="pdfproteccionmasivo">
                                    <button type="button"
                                        class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light">PDF
                                        Protección</button>
                                </a>
                            </p>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Filtro punto</label>
                                        <select class="select2 form-control" id="punto" onchange="tabla()">
                                            <option value=""></option>
                                            @foreach ($puntos as $punto)
                                                <option value="{{ $punto->id }}">{{ $punto->nombre_punto }} - {{ $punto->ubicacion }} 
                                                    </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Filtro colectivo</label>
                                        <select class="select2 form-control" id="colectivo" onchange="tabla()">
                                            <option value=""></option>
                                            @foreach ($puntosFormacion as $punto)
                                                <option value="{{ $punto->id }}">{{ $punto->colectivo }} - {{ $punto->ubicacion_espacio }} 
                                                    </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Filtro nivel</label>
                                        <select class="select2 form-control" id="nivel" onchange="tabla()">
                                            <option value=""></option>
                                            @foreach ($niveles as $nivel)
                                                    <option value="{{ $nivel->id }}"> nivel {{ $nivel->nivel }}
                                                    </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3" style="display: none" id="tags">
                                    <div class="form-group">
                                        <label>tags</label>
                                        <select class="select2 form-control" id="campo" onchange="tabla()">
                                            <option value=""></option>
                                            @foreach ($campos as $campo)
                                                <option >
                                                    {{ $campo }} 
                                                </option>
                                            @endforeach
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
                                    <div class="table-responsive" id="tabla_registros_participantes">
                                        @include('pages.tabla_registros_participantes')
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
                <h4 class="modal-title" id="myModalLabel17">Detalles de Encuestados </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detalleBody">
            </div>
        </div>
    </div>
</div>

    </section>

    <script>
        function tabla() {
            var puntoFormacion = $("#colectivo").val();
            var punto = $("#punto").val();
            var nivel = $("#nivel").val();
            var campo = $("#campo").val();
            var fecha = $("#fecha_desde").val();
            var fecha_H = $("#fecha_hasta").val();

            if (nivel != "") {
                $('#tags').show();
            }
            else{
                $('#tags').hide();
            }

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
                    "nivelF": nivel,
                    "nivelFP": campo,
                    
                    "puntoRF": puntoFormacion,
                    "puntoR": punto,
                    "fechaR": fecha,
                    "fechahR": fecha_H,
                    "filtro": 1
                };
                

            $.ajax({
                data: parametros,
                url: " {{ route('registrosparticipantes') }}",
                type: 'get',

                success: function(response) {
                    $("#tabla_registros_participantes").html(response);
                }
            });
        }

        function reiniciarFiltros() {
            var nivelF = $("#nivel").val('');
            var nivelFP = $("#campo").val('');
            var puntoR = $("#punto").val('');
            var puntoRF = $("#colectivo").val('');
            var fechaR = $("#fecha_desde").val('');
            var fechahR = $("#fecha_hasta").val('');

            $('#tags').hide();

            var parametros = {
                "nivelF": '',
                "nivelFP": '',

                "puntoR": '',
                "puntoRF": '',
                "fechaR": '',
                "filtro": 1
            };

            $.ajax({
                data: parametros,
                url: " {{ route('registrosparticipantes') }}",
                type: 'get',

                success: function(response) {
                    $("#tabla_registros_participantes").html(response);
                }
            });

        }

        function exportarexcel() {
            var punto = $("#punto").val();
            // var jornada = $("#jornada").val();
            var fecha = $("#fecha_desde").val();
            var fecha_hasta = $("#fecha_hasta").val();

            var dir = "exportarexcelparticipantes?punto=" + punto  + "&fecha=" + fecha + "&fecha_hasta=" + fecha_hasta;

            window.open(dir);
        }

        function showModal(id) {
            var parametros = {
                "id": id
            };

            $.ajax({
                data: parametros,
                url: "{{ route('detalleparticipante') }}",
                type: 'get',

                success: function(response) {
                    $("#detalleBody").html(response);
                }
            });
        }
    </script>

@endsection

@section('vendor-script')
    <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
@endsection
