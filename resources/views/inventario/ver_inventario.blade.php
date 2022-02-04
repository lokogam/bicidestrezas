@extends('layouts/contentLayoutMaster')

@section('title', 'Registros chequeo puntos') 

@section('content')

    <div class="card"  id="punto_control">
        <div class="card-header">
            <h4 class="card-title">Registros chequeo puntos</h4>
        </div>

        <div class="card-content">
            <div class="card-body card-dashboard">
                <p class="card-text">
                    <a style="display:none" onclick="pdfchequeos();" id="pdfchequeos">
                        <button type="button"
                            class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light">PDF
                            Chequeos</button>
                    </a>
                </p>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Buscar por punto</label>

                            <select class="select2 form-control" id="punto" onchange="tabla()">
                                <option value=""></option>
                                @foreach($puntos as $punto)
                                    <option value="{{$punto->id}}">{{$punto->nombre_punto}} - {{$punto->ubicacion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Buscar por fecha de registro</label>

                            <input type='date' class="form-control" id="fecha" onchange="tabla()">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group"><br>
                            <input type='button' class="btn btn-info" onclick="reiniciarFiltros()"
                                value="Reiniciar Filtros">
                        </div>
                    </div>
                </div>

                <div class="tab-pane active" id="admins" role="tabpanel" aria-labelledby="admin">
                    <div class="table-responsive" id="tabla_inventario">
                        @include('inventario.tabla_inventario')
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>
    <div id="detalleModal" class="modal fade text-left" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel17"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detalleBody">
                </div>
            </div>
        </div>
    </div>

    <script>
        function tabla() {
            var punto   = $("#punto").val();
            var fecha   = $("#fecha").val();

            var tab = document.getElementsByClassName('tab-pane active');

            var id = tab[0].getAttribute('id');

            $('#pdfchequeos').show();

            if (id == 'admins') {
                var parametros = {
                    "puntoC": punto,
                    "fechaC": fecha,
                    "filtro": 1
                };

                $.ajax({
                    data: parametros,
                    url:  " {{ route('verlistachequeo') }}",
                    type: 'get',

                    success: function(response){
                        $("#tabla_inventario").html(response);
                    }
                });
            }
        }

        function reiniciarFiltros() {
            var punto   = $("#punto").val('');
            var fecha   = $("#fecha").val('');

            $('#pdfchequeos').hide();

            var parametros = {
                "puntoC": '',
                "fechaC": '',
                "filtro": 1
            };

            $.ajax({
                data: parametros,
                url: " {{ route('verlistachequeo') }}",
                type: 'get',

                success: function(response) {
                    $("#tabla_inventario").html(response);
                }
            });

        }

        function showModal (id,fecha) {
            var parametros = {
                "id": id
            };
            
            $.ajax({
                data: parametros,
                url:  " {{ route('detallelistachequeo') }}",
                type: 'get',

                success: function(response){
                    $("#detalleBody").html(response);
                    $("#myModalLabel17").html('Detalle Inventario -'+' '+fecha);
                }
            });
        }

        function pdfchequeos() {
            var punto = $("#punto").val();
            var fecha = $("#fecha").val();

            var dir = "pdfchequeos?punto=" + punto + "&fecha=" + fecha;

            window.open(dir);
        }
    </script>

@endsection