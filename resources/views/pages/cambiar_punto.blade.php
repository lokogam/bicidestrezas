@extends('layouts/contentLayoutMaster')

@section('title', 'Cambiar Punto')

@section('content')
    <div>
        <form method="get" action="{{ URL::to('formulario/guardarpuntousuario') }}" enctype="multipart/form-data"
            id="env_punto">
            <div class="card" id="punto_control">
                <div class="card-header">
                    <h4 class="card-title">Datos Punto Control</h4>
                </div>

                <div class="card-content collapse show" aria-expanded="true">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Completado <i class="fa fa-check"></i></h4>

                                <p class="mb-0">
                                    Se ha cambiado el punto correctamente.
                                </p>
                            </div>
                        @endif
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

                            <div class="col-sm-8" style="display: none;"> <br>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#exampleModal"><i class="feather icon-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="button" class="btn btn-success" onclick="cambiar();"
                        style="float: right;">Cambiar</button>
                </div>
            </div>
        </form>
    </div>

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
        function cambiar() {
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
    </script>
@endsection
