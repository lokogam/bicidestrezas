<div class="card">
    <div class="card-header">
        <h3 class="card-title">LISTA DE CHEQUEO PUNTO</h3>
    </div>

    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">

            <div class="row">
                <div class="col-sm-6">
                    <label for="fecha">Fecha de la actividad</label>

                    <input class="form-control" type="date" name="fecha" id="fecha"
                        value="{{ $chequeo_registros[0]->fecha }}" disabled>
                </div>

                <div class="col-sm-3">
                    <label for="hora_desde">Hora desde las</label>

                    <input type="text" class="form-control" name="hora_desde" id="hora_desde"
                        value="{{ $chequeo_registros[0]->hora_desde }}" disabled>
                </div>

                <div class="col-sm-3">
                    <label for="hora_hasta">Hasta las</label>

                    <input type="text" class="form-control" name="hora_hasta" id="hora_hasta"
                        value="{{ $chequeo_registros[0]->hora_hasta }}" disabled>
                </div>

                <div class="col-sm-6">
                    <label for="hora_hasta">Ubicación</label>

                    <input type="text" class="form-control" name="punto" id="punto"
                        value="{{ $chequeo_registros[0]->nombre_punto }} - {{ $chequeo_registros[0]->ubicacion }}"
                        disabled>
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
                                                    id="especificacion{{ $key->id }}" value="SI"
                                                    @if ($key->respuesta == 'SI') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NO"
                                                    @if ($key->respuesta == 'NO') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NA"
                                                    @if ($key->respuesta == 'NA') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <textarea class="form-control"
                                                    name="especificacion_observacion{{ $key->id }}" cols="50"
                                                    rows="2">{{ $key->observacion }}</textarea>
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

<br>

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
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}"
                                                    id="especificacion{{ $key->id }}" value="SI"
                                                    @if ($key->respuesta == 'SI') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NO"
                                                    @if ($key->respuesta == 'NO') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NA"
                                                    @if ($key->respuesta == 'NA') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <textarea class="form-control"
                                                    name="especificacion_observacion{{ $key->id }}" cols="50"
                                                    rows="2">{{ $key->observacion }}</textarea>
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

<br>

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
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}"
                                                    id="especificacion{{ $key->id }}" value="SI"
                                                    @if ($key->respuesta == 'SI') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NO"
                                                    @if ($key->respuesta == 'NO') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NA"
                                                    @if ($key->respuesta == 'NA') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <textarea class="form-control"
                                                    name="especificacion_observacion{{ $key->id }}" cols="50"
                                                    rows="2">{{ $key->observacion }}</textarea>
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

<br>

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
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}"
                                                    id="especificacion{{ $key->id }}" value="SI"
                                                    @if ($key->respuesta == 'SI') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NO"
                                                    @if ($key->respuesta == 'NO') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NA"
                                                    @if ($key->respuesta == 'NA') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <textarea class="form-control"
                                                    name="especificacion_observacion{{ $key->id }}" cols="50"
                                                    rows="2">{{ $key->observacion }}</textarea>
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

<br>

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
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}"
                                                    id="especificacion{{ $key->id }}" value="SI"
                                                    @if ($key->respuesta == 'SI') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NO"
                                                    @if ($key->respuesta == 'NO') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NA"
                                                    @if ($key->respuesta == 'NA') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <textarea class="form-control"
                                                    name="especificacion_observacion{{ $key->id }}" cols="50"
                                                    rows="2">{{ $key->observacion }}</textarea>
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

<br>

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
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}"
                                                    id="especificacion{{ $key->id }}" value="SI"
                                                    @if ($key->respuesta == 'SI') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NO"
                                                    @if ($key->respuesta == 'NO') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NA"
                                                    @if ($key->respuesta == 'NA') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <textarea class="form-control"
                                                    name="especificacion_observacion{{ $key->id }}" cols="50"
                                                    rows="2">{{ $key->observacion }}</textarea>
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

<br>

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
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}"
                                                    id="especificacion{{ $key->id }}" value="SI"
                                                    @if ($key->respuesta == 'SI') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NO"
                                                    @if ($key->respuesta == 'NO') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NA"
                                                    @if ($key->respuesta == 'NA') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <textarea class="form-control"
                                                    name="especificacion_observacion{{ $key->id }}" cols="50"
                                                    rows="2">{{ $key->observacion }}</textarea>
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

<br>

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
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}"
                                                    id="especificacion{{ $key->id }}" value="SI"
                                                    @if ($key->respuesta == 'SI') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NO"
                                                    @if ($key->respuesta == 'NO') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <input type="radio" name="especificacion{{ $key->id }}" value="NA"
                                                    @if ($key->respuesta == 'NA') checked @endif>
                                            </center>
                                        </td>

                                        <td>
                                            <center>
                                                <textarea class="form-control"
                                                    name="especificacion_observacion{{ $key->id }}" cols="50"
                                                    rows="2">{{ $key->observacion }}</textarea>
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

<br>

<div class="card">
    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">
            <div id="estado_equipos">
                <h4>FIRMA <span style="color: red;">*</span></h4>

                <div class="row">
                    <img src="../firmas/{{ $chequeo_registros[0]->firma }}">
                </div>
            </div>

        </div>
    </div>
</div>

<br>
