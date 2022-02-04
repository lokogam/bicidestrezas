<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Informe</title>
    <link href="{{ URL::to('css/pdf_equipos.css') }}" rel="stylesheet" type="text/css" />
</head>

<body style="font-family: Arial;">
    <div class="card" id="datos_registro">
        <div class="card-header">
            <center>
                <h3 class="card-title">LISTA DE CHEQUEO PUNTO</h3>
            </center>
        </div>
        <hr>

        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="row" style="text-align: -webkit-center;">
                    <table class="table" style="width: 650px; font-size: 12px;" cellpadding="10">
                        <tbody>
                            <tr>
                                <th style="text-align: right;">Fecha de la actividad</th>

                                <td style="text-align: center;">{{ $chequeo_registros[0]->fecha }} {{ $chequeo_registros[0]->hora }}</td>
                            </tr>

                            <tr>
                                <th style="text-align: right;">Hora desde las</th>

                                <td style="text-align: center;">{{ $chequeo_registros[0]->hora_desde }}</td>
                            </tr>

                            <tr>
                                <th style="text-align: right;">Hasta las</th>

                                <td style="text-align: center;">{{ $chequeo_registros[0]->hora_hasta }}</td>
                            </tr>

                            <tr>
                                <th style="text-align: right;">Ubicación</th>

                                <td style="text-align: center;">{{ $chequeo_registros[0]->nombre_punto }} -
                                    {{ $chequeo_registros[0]->ubicacion }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card" id="datos_especificaciones">
        <div class="card-header">
            <center>
                <h3 class="card-title">ESPECIFICACIONES LOGÍSTICAS PARA LAS ACCIONES EN VÍA</h3>
            </center>
        </div>
        <hr>

        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="row" style="text-align: -webkit-center; text-align-last: start;">
                    <table class="table table-striped mb-0" style="font-size: 12px;">
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
                                            <input type="radio" value="SI" @if ($key->respuesta == 'SI') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NO" @if ($key->respuesta == 'NO') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NA" @if ($key->respuesta == 'NA') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <textarea class="form-control" cols="50"
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
</body>

<body style="font-family: Arial;">
    <div class="card" id="datos_elementos_revision">
        <div class="card-header">
            <center>
                <h3 class="card-title">ELEMENTOS REVISIÓN MECANICA</h3>
            </center>
        </div>

        <hr>

        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="row" style="text-align: -webkit-center;">
                    <table class="table table-striped mb-0" style="font-size: 12px;">
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
                                            <input type="radio" value="SI" @if ($key->respuesta == 'SI') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NO" @if ($key->respuesta == 'NO') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NA" @if ($key->respuesta == 'NA') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <textarea class="form-control" cols="50"
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

    <br>

    <div class="card" id="datos_elementos_reto">
        <div class="card-header">
            <center>
                <h3 class="card-title">ELEMENTOS RETO</h3>
            </center>
        </div>

        <hr>

        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="row" style="text-align: -webkit-center;">
                    <table class="table table-striped mb-0" style="font-size: 12px;">
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
                                            <input type="radio" value="SI" @if ($key->respuesta == 'SI') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NO" @if ($key->respuesta == 'NO') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NA" @if ($key->respuesta == 'NA') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <textarea class="form-control" cols="50"
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
</body>

<body style="font-family: Arial;">
    <div class="card" id="datos_elementos_adicionales">
        <div class="card-header">
            <center>
                <h3 class="card-title">ELEMENTOS ADICIONALES</h3>
            </center>
        </div>

        <hr>

        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="row" style="text-align: -webkit-center;">
                    <table class="table table-striped mb-0" style="font-size: 12px;">
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
                                            <input type="radio" value="SI" @if ($key->respuesta == 'SI') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NO" @if ($key->respuesta == 'NO') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NA" @if ($key->respuesta == 'NA') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <textarea class="form-control" cols="50"
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

    <br>

    <div class="card" id="datos_permisos">
        <div class="card-header">
            <center>
                <h3 class="card-title">PERMISOS</h3>
            </center>
        </div>

        <hr>

        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="row" style="text-align: -webkit-center;">
                    <table class="table table-striped mb-0" style="font-size: 12px;">
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
                                            <input type="radio" value="SI" @if ($key->respuesta == 'SI') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NO" @if ($key->respuesta == 'NO') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NA" @if ($key->respuesta == 'NA') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <textarea class="form-control" cols="50"
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

    <br>

    <div class="card" id="datos_elementos_gestion">
        <div class="card-header">
            <center>
                <h3 class="card-title">ELEMENTOS DE GESTIÓN DE RIESGOS</h3>
            </center>
        </div>

        <hr>

        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="row" style="text-align: -webkit-center;">
                    <table class="table table-striped mb-0" style="font-size: 12px;">
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
                                            <input type="radio" value="SI" @if ($key->respuesta == 'SI') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NO" @if ($key->respuesta == 'NO') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NA" @if ($key->respuesta == 'NA') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <textarea class="form-control" cols="50"
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
</body>

<body style="font-family: Arial;">
    <div class="card" id="datos_control_asistencia">
        <div class="card-header">
            <center>
                <h3 class="card-title">CONTROL DE ASISTENCIA</h3>
            </center>
        </div>

        <hr>

        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="row" style="text-align: -webkit-center;">
                    <table class="table table-striped mb-0" style="font-size: 12px;">
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
                                            <input type="radio" value="SI" @if ($key->respuesta == 'SI') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NO" @if ($key->respuesta == 'NO') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NA" @if ($key->respuesta == 'NA') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <textarea class="form-control" cols="50"
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

    <br>

    <div class="card" id="datos_kit_higiene">
        <div class="card-header">
            <center>
                <h3 class="card-title">KIT DE HIGIENE Y SALUD</h3>
            </center>
        </div>

        <hr>

        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="row" style="text-align: -webkit-center;">
                    <table class="table table-striped mb-0" style="font-size: 12px;">
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
                                            <input type="radio" value="SI" @if ($key->respuesta == 'SI') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NO" @if ($key->respuesta == 'NO') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <input type="radio" value="NA" @if ($key->respuesta == 'NA') checked @endif>
                                        </center>
                                    </td>

                                    <td>
                                        <center>
                                            <textarea class="form-control" cols="50"
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

    <br>

    <div class="card" id="datos_firma">
        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="row" style="text-align: -webkit-center;">
                    <table class="table table-striped mb-0" style="font-size: 12px;">
                        <tr>
                            <td style="text-align: left;">
                                <img style="width: 500px; heigth: 250px; border-radius: 8px;" src="{{ URL::to('firmas/' . $chequeo_registros[0]->firma) }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">
                                <h4>{{ $chequeo_registros[0]->name }} - {{ $chequeo_registros[0]->documento }}</h4>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
