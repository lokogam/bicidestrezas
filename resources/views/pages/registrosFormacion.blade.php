@extends('layouts/contentLayoutMaster')

@section('title', 'Registros Formación')

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
                        <h4 class="card-title">Registros Formación</h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <p class="card-text">
                                {{-- <a onclick="exportarexcel();">
                                    <button type="button"
                                        class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light">Exportar
                                        Formaciones</button>
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
                                </a> --}}
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
                                        @include('pages.tabla_registros_formacion')
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
                    <h4 class="modal-title" id="myModalLabel17">Detalle de la formación</h4>

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
        function showModal(id) {
            var parametros = {
                "id": id
            };

            $.ajax({
                data: parametros,
                url: "{{ route('detalleformacion') }}",
                type: 'get',

                success: function(response) {
                    $("#detalleBody").html(response);
                }
            });
        }

        function tabla() {
            var punto = $("#punto").val();
            var fecha = $("#fecha_desde").val();
            var fecha_H = $("#fecha_hasta").val();

            // $('#pdfproteccionmasivo').show();
            // $('#pdfconsentimientomasivo').show();
            // $('#certificadomasivo').show();

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
                "fechaR": fecha,
                "fechahR": fecha_H,
                "filtro": 1
            };

            $.ajax({
                data: parametros,
                url: " {{ route('registrosformacion') }}",
                type: 'get',

                success: function(response) {
                    $("#tabla_registros").html(response);
                }
            });
        }

        function reiniciarFiltros() {
            var puntoR = $("#punto").val('');
            var fechaR = $("#fecha_desde").val('');
            var fechahR = $("#fecha_hasta").val('');

            // $('#pdfproteccionmasivo').hide();
            // $('#pdfconsentimientomasivo').hide();
            // $('#certificadomasivo').hide();

            var parametros = {
                "puntoR": '',
                "fechaR": '',
                "filtro": 1
            };

            $.ajax({
                data: parametros,
                url: " {{ route('registrosformacion') }}",
                type: 'get',

                success: function(response) {
                    $("#tabla_registros").html(response);
                }
            });

        }

        function exportarexcel() {
            var punto = $("#punto").val();
            var fecha = $("#fecha_desde").val();
            var fecha_hasta = $("#fecha_hasta").val();

            var dir = "exportarexcelformacion?punto=" + punto + "&fecha=" + fecha + "&fecha_hasta=" + fecha_hasta;

            window.open(dir);
        }

        function pdfproteccionmasivo() {
            var punto = $("#punto").val();
            var fecha = $("#fecha_desde").val();
            var fecha_hasta = $("#fecha_hasta").val();

            var dir = "pdfproteccionmasivo?punto=" + punto + "&fecha=" + fecha + "&fecha_hasta=" + fecha_hasta;

            window.open(dir);
        }

        function pdfconsentimientomasivo() {
            var punto = $("#punto").val();
            var fecha = $("#fecha_desde").val();
            var fecha_hasta = $("#fecha_hasta").val();

            var dir = "pdfconsentimientomasivo?punto=" + punto + "&fecha=" + fecha + "&fecha_hasta=" + fecha_hasta;

            window.open(dir);
        }

        function certificadomasivo() {
            var punto = $("#punto").val();
            var fecha = $("#fecha_desde").val();
            var fecha_hasta = $("#fecha_hasta").val();

            var dir = "certificadomasivo?punto=" + punto + "&fecha=" + fecha + "&fecha_hasta=" + fecha_hasta;

            window.open(dir);
        }
    </script>
@endsection

@section('vendor-script')
    <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
@endsection
