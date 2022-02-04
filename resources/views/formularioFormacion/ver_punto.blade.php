@extends('layouts/contentLayoutMaster')

@section('title', 'Formulario Formacion')

@section('content')
    @if ($usuario_punto < 1)
        <div>
            <form method="get" action="{{ URL::to('formulario/guardarpuntousuario') }}" enctype="multipart/form-data"
                id="env_punto">
                <div class="card" id="punto_control">
                    <div class="card-header">
                        <h4 class="card-title">Datos Punto Control</h4>
                    </div>
                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="">Seleccione punto de control</label>
                                    <select class="form-control" name="pc" id="pc">
                                        <option value=""></option>
                                        @foreach ($puntos as $key)
                                            <option value="{{ $key->id }}">{{ $key->nombre_punto }} -
                                                {{ $key->ubicacion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-8" style="display: none;">
                                    <br>
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#exampleModal"><i class="feather icon-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-success" onclick="pasar_validar();"
                            style="float: right;">siguiente</button>
                        <!-- <button type="button" class="btn btn-info" onclick="anterior(1);"><i class="feather icon-arrow-left"></i> anterior</button> -->
                    </div>
                </div>
            </form>
        </div>
    @else
        <div>
            <form method="post" action="{{ URL::to('formulario/consultarformacion') }}" enctype="multipart/form-data" id="env_consulta">
                @csrf

                <div class="card" id="punto_control">
                    <div class="card-header">
                        <h4 class="card-title">Validar Documento</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Completado <i class="fa fa-check"></i></h4>

                                    <p class="mb-0">
                                        Se ha guardado correctamente.
                                    </p>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-sm-5">
                                    <label for="" style="color:red;">Recuerde ingresar número de Documento sin espacios ni
                                        guiones.</label>

                                    <input style="text-transform:uppercase;" class="form-control" type="text"
                                        name="numero_documento" id="numero_documento"
                                        placeholder="Numero de Documento"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-success" type="button" onclick="consulta()" style="float: right;"
                            id="enviar">Consultar</button>

                        <button class="btn btn-success mb-1" type="button" disabled style="float: right;display: none;"
                            id="cargando">

                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="">Consultando...</span>
                        </button>
                        <!-- <button type="button" class="btn btn-info" onclick="anterior(1);"><i class="feather icon-arrow-left"></i> anterior</button> -->
                    </div>
                </div>
            </form>
        </div>
    @endif

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="get" action="{{ URL::to('formulario/crearpuntocontrol') }}" enctype="multipart/form-data"
                id="guardar_pc">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Punto de Control</h5>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Nombre del Punto</label>

                                <input class="form-control" name="nuevo_pc" id="nuevo_pc">
                            </div>

                            <div class="col-sm-12">
                                <label for="">Ubicación del Punto</label>

                                <input class="form-control" name="coordenadas" id="coordenadas">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="guardar_nuevo_pc()">Guardar</button>

                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function validar_documento() {
            var tipo_documento = $('#tipo_documento').val();

            if (tipo_documento == 1) {
                document.getElementById("numero_documento").setAttribute("type", "number");
            } else {
                document.getElementById("numero_documento").setAttribute("type", "text");
            }

        }

        function pasar_validar() {
            var pc = $('#pc').val();

            if (pc == "") {
                $('#pc').focus();
                return;
            }
            $('#env_punto').submit();
        }

        function guardar_nuevo_pc() {
            var nuevo_pc = $('#nuevo_pc').val();
            var coordenadas = $('#coordenadas').val();

            if (nuevo_pc == "") {
                $('#nuevo_pc').focus();
                return;
            }
            if (coordenadas == "") {
                $('#coordenadas').focus();
                return;
            }

            $('#guardar_pc').submit();
        }

        function consulta() {
            var numero_documento = $("#numero_documento").val();

            if (numero_documento == "") {
                $("#numero_documento").focus();
                return;
            }

            $('#cargando').show()
            $('#enviar').hide()

            $('#env_consulta').submit();
        }
    </script>
@endsection
