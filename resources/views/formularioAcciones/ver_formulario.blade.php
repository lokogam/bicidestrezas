@extends('layouts/contentLayoutMaster')

@section('title', 'Formulario Acciones')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-sweet-alerts.css') }}">
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('app-assets/vendors/css/forms/select/select2.min.css') }}">

    @if ($dias_documento != 'No')
        <div class="card" id="datos_firma">
            <div class="card-header">
                <h4 class="card-title"></h4>
            </div>

            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body">
                    <center>
                        @if ($dias_documento != 'No')
                            <h2>Persona con documento: {{ $numero_documento }}</h2>
                            <h3>Inspeccionado @if ($dias_documento == 0) hoy. @elseif($dias_documento==1) hace {{ $dias_documento }} día. @else hace {{ $dias_documento }} días. @endif</h3>
                        @endif
                    </center>
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ URL::to('formulario/acciones') }}" type="button" class="btn btn-primary"
                    style="float: right;color:#fff;">volver a consultar</a>
            </div>
        </div>
    @else
        <div>
            <div class="col-md-4">
                <h3>Tiempo: <span id='crono'>00:00:00</span></h3>
            </div>

            <form method="post" action="{{ URL::to('formulario/guardarformularioacciones') }}"
                enctype="multipart/form-data" id="env_form">
                @csrf

                <div class="card" id="datos_firma">
                    <div class="card-header">
                        <h4 class="card-title">Aceptación de términos</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <input type="checkbox" id="actividad" name="actividad" checked> Autorizo para participar en la
                            actividad y asistencia.
                            <br>

                            <input type="checkbox" id="datos_personales" name="datos_personales" checked> Estoy de acuerdo
                            con la
                            <a href="#" data-toggle="modal" data-target="#default">PROTECCIÓN DE
                                DATOS</a>.
                            <br>

                            <input type="checkbox" id="datos_personales2" name="datos_personales2" checked>He leído y estoy
                            de acuerdo
                            con el
                            <a href="#" data-toggle="modal" data-target="#default2">CONSENTIMIENTO INFORMADO</a>.
                            <br>

                            <br>

                            <p style="font-size: 12px; text-align: justify;">
                                <b>AMABLEMENTE LES INFORMAMOS QUE, "DE ACUERDO CON LO DISPUESTO EN EL
                                ARTÍCULO 38 DE LA LEY 996 DE2005, ESTE TIPO DE REUNIONES NO SE ADELANTA
                                CON LA PARTICIPACIÓN DE CANDIDATOS A LA PRESIDENCIA DE LA REPÚBLICA,
                                LA VICEPRESIDENCIA, CANDIDATOS AL CONGRESO DE LA REPÚBLICA O VOCERO
                                ALGUNO. EN ESE SENTIDO, LES AGRADECEMOS A QUIENES OSTENTEN LA
                                CALIDAD DE CANDIDATO EN ALGUNA CAMPAÑA ELECTORAL, ABSTENERSE DE
                                REALIZAR CUALQUIER ACTO O ACCIÓN PROSELITISTA O PROPAGANDÍSTICA EN
                                ESTA REUNIÓN, CON EL FIN DE PRESERVAR TODAS LAS GARANTÍAS
                                ELECTORALES Y CIUDADANAS".</b>
                            </p>
                            <br>

                            <div id="signature-pad" class="signature-pad">
                                <div class="description">Firma <span id="alerta_firma"
                                        style="color:red;display: none;">La firma es obligatoria.</span>
                                </div>

                                <div class="signature-pad--body">
                                    <canvas style="width: 452px; height: 150px; border: 1px black solid; "
                                        id="canvas"></canvas>
                                </div>
                            </div>
                            <br>

                            <input type="hidden" name="base64" value="" id="base64">

                            <button type="button" class="btn btn-primary" onclick="limpiarcanvas()"><i
                                    class="feather icon-refresh-ccw"></i> Limpiar</button>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="siguiente(2);" style="float: right;">siguiente
                            <i class="feather icon-arrow-right"></i></button>
                    </div>
                </div>

                <div class="card" id="datos_registro" style="display:none;">
                    <div class="card-header">
                        <h4 class="card-title">DATOS PRINCIPALES</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="fecha">Fecha</label>

                                    <input class="form-control" type="date" name="fecha" id="fecha">
                                </div>

                                <div class="col-sm-6">
                                    <label for="jornada">Jornada</label>

                                    <select class="form-control" name="jornada" id="jornada">
                                        <option value=""></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label for="encargado">Encargado</label>

                                    <select class="form-control" name="encargado" id="encargado">
                                        <option value=""></option>
                                        @foreach ($encargados as $encargado)
                                            <option value="{{ $encargado->id }}">{{ $encargado->name }} -
                                                {{ $encargado->documento }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="siguiente(3);" style="float: right;">
                            siguiente

                            <i class="feather icon-arrow-right"></i>
                        </button>

                        <button type="button" class="btn btn-info" onclick="anterior(2);">
                            <i class="feather icon-arrow-left"></i>

                            anterior
                        </button>
                    </div>
                </div>

                <div class="card" id="datos_ciclista" style="display: none;">
                    <div class="card-header">
                        <h4 class="card-title">DATOS GENERALES DEL CICLISTA</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <input type="hidden" id="fecha_inicio" name="fecha_inicio" value="">

                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="nombre">Nombre y apellido</label>

                                    <input style="text-transform:uppercase;" class="form-control" type="text"
                                        name="nombre" id="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>

                                <div class="col-sm-6">
                                    <label for="numero_documento">Cédula de ciudadanía</label>

                                    <input class="form-control" type="number" name="numero_documento"
                                        id="numero_documento" value="{{ $numero_documento }}">
                                </div>

                                <div class="col-sm-6">
                                    <label for="numero_contacto">Número de celular</label>

                                    <input class="form-control" type="number" name="numero_contacto" id="numero_contacto">
                                </div>

                                <div class="col-sm-6">
                                    <label for="correo">Correo electrónico</label>

                                    <input style="text-transform:uppercase;" class="form-control" type="email"
                                        name="correo" id="correo" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>

                                <div class="col-sm-6">
                                    <label for="edad">Edad</label>

                                    <input class="form-control" type="number" name="edad" id="edad">
                                </div>

                                <div class="col-sm-6">
                                    <label for="sexo">Sexo</label>

                                    <select class="form-control" name="sexo" id="sexo">
                                        <option value=""></option>
                                        <option value="HOMBRE">HOMBRE</option>
                                        <option value="MUJER">MUJER</option>
                                        <option value="INTERSEXUAL">INTERSEXUAL</option>
                                        <option value="PREFIERO NO DECIRLO">PREFIERO NO DECIRLO</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label for="genero">Género</label>

                                    <select class="form-control" name="genero" id="genero">
                                        <option value=""></option>
                                        <option value="MASCULINO">MASCULINO</option>
                                        <option value="FEMENINO">FEMENINO</option>
                                        <option value="TRANSGÉNERO">TRANSGÉNERO</option>
                                        <option value="PREFIERO NO DECIRLO">PREFIERO NO DECIRLO</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label for="nivel_escolaridad">Nivel de escolaridad</label>

                                    <select class="form-control" name="nivel_escolaridad" id="nivel_escolaridad">
                                        <option value=""></option>
                                        <option value="SIN ESCOLARIDAD">SIN ESCOLARIDAD</option>
                                        <option value="PREESCOLAR">PREESCOLAR</option>
                                        <option value="PRIMARIA">PRIMARIA</option>
                                        <option value="SECUNDARIA">SECUNDARIA</option>
                                        <option value="UNIVERSITARIO">UNIVERSITARIO</option>
                                        <option value="TÉCNICA O TECNOLÓGICA">TÉCNICA O TECNOLÓGICA</option>
                                        <option value="POSGRADO">POSGRADO</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label for="poblacion_vulnerable">Población vulnerable</label>

                                    <select class="form-control" name="poblacion_vulnerable" id="poblacion_vulnerable">
                                        <option value=""></option>
                                        <option value="HABITANTE DE LA CALLE">HABITANTE DE LA CALLE</option>
                                        <option value="TRABAJADORES SEXUALES">TRABAJADORES SEXUALES</option>
                                        <option value="MADRE COMUNITARIA">MADRE COMUNITARIA</option>
                                        <option value="PERSONA CON DISCAPACIDAD">PERSONA CON DISCAPACIDAD</option>
                                        <option value="INMIGRANTES">INMIGRANTES</option>
                                        <option value="DESMOVILLIZADO">DESMOVILLIZADO</option>
                                        <option value="PERSONAS AFECTADAS POR CONFLICTO ARMADO">PERSONAS AFECTADAS POR
                                            CONFLICTO ARMADO</option>
                                        <option value="NINGUNA">NINGUNA</option>
                                        <option value="OTRO">OTRO</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label for="anos_experiencia">
                                        Años de experiencia montando bicicleta

                                        <span id="alerta_experiencia" style="color:red;display: none;">
                                            La experiencia ingresada es incorrecta.
                                        </span>
                                    </label>

                                    <input class="form-control" type="number" name="anos_experiencia"
                                        id="anos_experiencia">
                                </div>


                                <div class="col-sm-6">
                                    <label for="tiempo_uso">Tiempo de uso de la bicicleta al día (en minutos)</label>

                                    <input class="form-control" type="number" name="tiempo_uso" id="tiempo_uso">
                                </div>

                                <div class="col-sm-6">
                                    <label for="">Temperatura registrada al inicio de la actividad
                                        <span id="alerta_temperatura" style="color:red; display: none;">
                                            La temperatura es muy baja
                                        </span>

                                        <span id="alerta_temperatura2" style="color:red; display: none;">
                                            La temperatura es muy alta revise el campo ingresado
                                        </span>
                                    </label>

                                    <input class="form-control" type="number" name="temperatura_inicio"
                                        id="temperatura_inicio" onblur="validar_temperatura()">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="siguiente(4);" style="float: right;">
                            siguiente

                            <i class="feather icon-arrow-right"></i>
                        </button>

                        <button type="button" class="btn btn-info" onclick="anterior(3);">
                            <i class="feather icon-arrow-left"></i>

                            anterior
                        </button>
                    </div>
                </div>

                <div class="card" id="datos_recorrido" style="display: none;">
                    <div class="card-header">
                        <h4 class="card-title">DATOS SOBRE EL RECORRIDO</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="tipo_viaje">Tipo de viaje</label>

                                    <select class="form-control" name="tipo_viaje" id="tipo_viaje">
                                        <option value=""></option>
                                        <option value="URBANO">URBANO</option>
                                        <option value="INTERURBANO">INTERURBANO</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label for="sitios_accidentes">
                                        Sitios de accidentalidad identificados por el ciclista (procurar identificar
                                        dirección)
                                    </label>

                                    <textarea style="text-transform:uppercase;" class="form-control"
                                        name="sitios_accidentes" id="sitios_accidentes"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="siguiente(5);" style="float: right;">
                            siguiente

                            <i class="feather icon-arrow-right"></i>
                        </button>

                        <button type="button" class="btn btn-info" onclick="anterior(4);">
                            <i class="feather icon-arrow-left"></i>

                            anterior
                        </button>
                    </div>
                </div>

                <div class="card" id="datos_reto" style="display: none;">
                    <div class="card-header">
                        <h4 class="card-title">DATOS GENERALES DEL RESULTADO DEL RETO</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
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
                                                    <center>NA</center>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <center>1. Se sube a la bicicleta sin perder el control.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="subida_perdida_control" value="SI"
                                                            id="subida_perdida_control">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="subida_perdida_control" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="subida_perdida_control" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>2. Mantiene manos en el manillar (manubrio), con dos o tres
                                                        dedos en los frenos.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="dedos_frenos" id="dedos_frenos"
                                                            value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="dedos_frenos" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="dedos_frenos" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>3. Se sostiene con un pie en el suelo y con el otro puesto en el
                                                        pedal.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="pie_suelo_otro_pedal"
                                                            id="pie_suelo_otro_pedal" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="pie_suelo_otro_pedal" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="pie_suelo_otro_pedal" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>4. Empuja hacia adelante empezando el desplazamiento con
                                                        equilibrio de la bicicleta.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="empuje_equilibrio" id="empuje_equilibrio"
                                                            value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="empuje_equilibrio" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="empuje_equilibrio" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>5. Capacidad de levantar la mano sin perder el control de la
                                                        bicicleta.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="levantar_mano_perdida_control"
                                                            id="levantar_mano_perdida_control" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="levantar_mano_perdida_control" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="levantar_mano_perdida_control" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>6. Conoce las señales manuales.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="conoce_senales_manuales"
                                                            id="conoce_senales_manuales" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="conoce_senales_manuales" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="conoce_senales_manuales" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>7. Al frenar no derrapa (bloquea) las ruedas.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="derrapa_frenado" id="derrapa_frenado"
                                                            value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="derrapa_frenado" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="derrapa_frenado" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>8. Posiciona el cuerpo hacia atrás cuando frena.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="posicion_cuerpo_frenado"
                                                            id="posicion_cuerpo_frenado" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="posicion_cuerpo_frenado" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="posicion_cuerpo_frenado" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>9. Es capaz de mirar hacia atrás.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="mira_atras" id="mira_atras" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="mira_atras" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="mira_atras" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>10. Mantiene el equilibrio al mirar hacia atrás.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="equilibrio_mira_atras"
                                                            id="equilibrio_mira_atras" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="equilibrio_mira_atras" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="equilibrio_mira_atras" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>11. Tiene como punto de referencia el hombro izquierdo.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="hombro_referencia" id="hombro_referencia"
                                                            value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="hombro_referencia" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="hombro_referencia" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>12. Proyecta la mirada al frente.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="mirada_frente" id="mirada_frente"
                                                            value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="mirada_frente" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="mirada_frente" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>13. Mantiene el equilibrio.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="mantiene_equilibrio"
                                                            id="mantiene_equilibrio" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="mantiene_equilibrio" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="mantiene_equilibrio" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>14. Pararse en pedales previo al subir o al descenso.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="pararse_pedales" id="pararse_pedales"
                                                            value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="pararse_pedales" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="pararse_pedales" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>15. Llevar el cuerpo hacia atrás.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cuerpo_atras" id="cuerpo_atras"
                                                            value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cuerpo_atras" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cuerpo_atras" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>16. Levantar la rueda delantera.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="levantar_rueda_delantera"
                                                            id="levantar_rueda_delantera" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="levantar_rueda_delantera" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="levantar_rueda_delantera" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>17. Mantiene el cuerpo centrado en la bicicleta </center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cuerpo_centrado" id="cuerpo_centrado"
                                                            value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cuerpo_centrado" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cuerpo_centrado" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>18. Apoya la media punta del pie en los pedales </center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="apoyo_punta_pedales"
                                                            id="apoyo_punta_pedales" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="apoyo_punta_pedales" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="apoyo_punta_pedales" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>19. La bicicleta se ajusta a la altura del ciclista.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="ajusta_altura_ciclista"
                                                            id="ajusta_altura_ciclista" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="ajusta_altura_ciclista" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="ajusta_altura_ciclista" value="NA">
                                                    </center>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="siguiente(6);" style="float: right;">
                            siguiente

                            <i class="feather icon-arrow-right"></i>
                        </button>

                        <button type="button" class="btn btn-info" onclick="anterior(5);">
                            <i class="feather icon-arrow-left"></i>

                            anterior
                        </button>
                    </div>
                </div>

                <div class="card" id="datos_documentacion" style="display: none;">
                    <div class="card-header">
                        <h4 class="card-title">DATOS DE LA REVISIÓN DOCUMENTAL</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="tarjeta_propiedad">Tarjeta de propiedad</label>

                                    <select class="form-control" name="tarjeta_propiedad" id="tarjeta_propiedad">
                                        <option value=""></option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label for="marcacion">Marcación</label>

                                    <select class="form-control" name="marcacion" id="marcacion">
                                        <option value=""></option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="siguiente(7);" style="float: right;">
                            siguiente

                            <i class="feather icon-arrow-right"></i>
                        </button>

                        <button type="button" class="btn btn-info" onclick="anterior(6);">
                            <i class="feather icon-arrow-left"></i>

                            anterior
                        </button>
                    </div>
                </div>

                <div class="card" id="datos_epp" style="display: none;">
                    <div class="card-header">
                        <h4 class="card-title">DATOS DE USO DE EQUIPOS DE PROTECCIÓN PERSONAL (EPP)</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
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
                                                    <center>NA</center>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <center>Uso de casco</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_casco" value="SI" id="uso_casco">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_casco" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_casco" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Uso cintas reflectivas</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_cinta_reflectiva"
                                                            id="uso_cinta_reflectiva" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_cinta_reflectiva" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_cinta_reflectiva" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Uso de luz proyectiva delantera</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_luz_delantera" id="uso_luz_delantera"
                                                            value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_luz_delantera" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_luz_delantera" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Uso de luz reflectora trasera</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_luz_trasera" id="uso_luz_trasera"
                                                            value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_luz_trasera" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_luz_trasera" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Uso de muñequeras</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_munequeras" id="uso_munequeras"
                                                            value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_munequeras" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_munequeras" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Uso de rodilleras</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_rodilleras" id="uso_rodilleras"
                                                            value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_rodilleras" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_rodilleras" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Uso de gafas</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_gafas" id="uso_gafas" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_gafas" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_gafas" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Uso de pito</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_pito" id="uso_pito" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_pito" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_pito" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Uso de guantes</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_guantes" id="uso_guantes" value="SI">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_guantes" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="uso_guantes" value="NA">
                                                    </center>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="siguiente(8);" style="float: right;">
                            siguiente

                            <i class="feather icon-arrow-right"></i>
                        </button>

                        <button type="button" class="btn btn-info" onclick="anterior(7);">
                            <i class="feather icon-arrow-left"></i>

                            anterior
                        </button>
                    </div>
                </div>

                <div class="card" id="datos_revision" style="display: none;">
                    <div class="card-header">
                        <h4 class="card-title">DATOS DE LA REVISIÓN DE LA BICICLETA</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <div class="row" id="select_revision">
                                <div class="col-md-6">
                                    <label for="acepta_revision">¿Acepta la realización de un revisión mecánica a su
                                        bicicleta?</label>

                                    <center>
                                        <label>SI</label>

                                        <input type="radio" class="acepta_revision" name="acepta_revision" value="SI"
                                            id="acepta_revision" onclick="revision()">

                                        <label>NO</label>

                                        <input type="radio" class="acepta_revision" name="acepta_revision" value="NO"
                                            onclick="revision()">
                                    </center>
                                </div>
                                <div class="col-md-12">
                                    <h4 style="margin-top: 15px;"><b>Nota: No olvide dar las recomendaciones al ciclista.</b></h4>
                                </div>
                            </div>

                            <div class="row" id="tabla_revision" style="display: none;">
                                <div class="col-sm-8">
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
                                                    <center>NA</center>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <center>No rota, ni se desliza hacia arriba</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="sillin_rota_desliza" value="SI"
                                                            id="sillin_rota_desliza">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="sillin_rota_desliza" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="sillin_rota_desliza" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>No está roto, ni fisurado</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="sillin_roto_fisura" value="SI"
                                                            id="sillin_roto_fisura">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="sillin_roto_fisura" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="sillin_roto_fisura" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>En la comprobación visual se evidencia que se encuentra a la
                                                        altura de la cadera del ciclista estando de píe</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="sillin_altura_cadera" value="SI"
                                                            id="sillin_altura_cadera">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="sillin_altura_cadera" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="sillin_altura_cadera" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>El poste no está roto</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="poste_roto" value="SI" id="poste_roto">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="poste_roto" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="poste_roto" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Los componentes del sistema están completos y ensamblados
                                                    </center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="frenos_componentes_completos" value="SI"
                                                            id="frenos_componentes_completos">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="frenos_componentes_completos" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="frenos_componentes_completos" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Pastillas, zapatas o discos no presentan fisuras, roturas o
                                                        desgastes</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="frenos_desgastados" value="SI"
                                                            id="frenos_desgastados">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="frenos_desgastados" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="frenos_desgastados" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Los frenos no están calibrados o largos</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="frenos_calibrados" value="SI"
                                                            id="frenos_calibrados">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="frenos_calibrados" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="frenos_calibrados" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>No está rota, fisurada o doblada</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cadena_rota_fisurada" value="SI"
                                                            id="cadena_rota_fisurada">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cadena_rota_fisurada" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cadena_rota_fisurada" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>La lubricación no se encuentra en escaso o carente, no tiene
                                                        residuos de grasa antigua</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cadena_lubricacion" value="SI"
                                                            id="cadena_lubricacion">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cadena_lubricacion" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cadena_lubricacion" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Los eslabones no están desgastados</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cadena_desgaste" value="SI"
                                                            id="cadena_desgaste">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cadena_desgaste" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="cadena_desgaste" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Platos, piñones están presentes, sin fisuras, roturas o
                                                        desgastes</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="roturas_platos_pinones" value="SI"
                                                            id="roturas_platos_pinones">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="roturas_platos_pinones" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="roturas_platos_pinones" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Bielas, pedales y centro están presentes, sin fisuras, roturas o
                                                        desgastes</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="roturas_bielas_pedales_centro" value="SI"
                                                            id="roturas_bielas_pedales_centro">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="roturas_bielas_pedales_centro" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="roturas_bielas_pedales_centro" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Se hacen los cambios</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="hace_cambios" value="SI"
                                                            id="hace_cambios">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="hace_cambios" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="hace_cambios" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Sentido de rotación adecuado</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="llantas_sentido_rotacion" value="SI"
                                                            id="llantas_sentido_rotacion">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="llantas_sentido_rotacion" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="llantas_sentido_rotacion" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Sin fisuras, huevos, la guía no se encuentra expuesta.</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="llantas_fisuradas" value="SI"
                                                            id="llantas_fisuradas">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="llantas_fisuradas" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="llantas_fisuradas" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Presión acorde a lo establecido en la coraza,</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="llantas_presion" value="SI"
                                                            id="llantas_presion">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="llantas_presion" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="llantas_presion" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Radios están completos, no rotos o doblados</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="radios_rotos" value="SI"
                                                            id="radios_rotos">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="radios_rotos" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="radios_rotos" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Ajuste y alineación de la llanta </center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="llantas_alineacion" value="SI"
                                                            id="llantas_alineacion">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="llantas_alineacion" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="llantas_alineacion" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Rin se encuentra sin fisuras, desgastados, doblados</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="rin_fisurado" value="SI"
                                                            id="rin_fisurado">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="rin_fisurado" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="rin_fisurado" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Gira sin fricción o resistencia</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="direccion_gira" value="SI"
                                                            id="direccion_gira">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="direccion_gira" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="direccion_gira" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Rodamientos sin juego</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="direccion_rodamientos_juego" value="SI"
                                                            id="direccion_rodamientos_juego">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="direccion_rodamientos_juego" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="direccion_rodamientos_juego" value="NA">
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <center>Manillar centrado y debidamente ajustado</center>
                                                </th>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="manillar_centrado" value="SI"
                                                            id="manillar_centrado">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="manillar_centrado" value="NO">
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <input type="radio" name="manillar_centrado" value="NA">
                                                    </center>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="siguiente(9);" style="float: right;">
                            siguiente

                            <i class="feather icon-arrow-right"></i>
                        </button>

                        <button type="button" class="btn btn-info" onclick="anterior(8);">
                            <i class="feather icon-arrow-left"></i>

                            anterior
                        </button>
                    </div>
                </div>

                {{-- <div class="card" id="datos_recomendaciones" style="display: none;">
                    <div class="card-header">
                        <h4 class="card-title">EVALUACIÓN DEL TALLER</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="evaluacion_taller">Evaluación del taller de 1 a 5.</label>

                                    <select class="form-control" name="evaluacion_taller" id="evaluacion_taller">
                                        <option value=""></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label for="importancia_informacion">Importancia de la información recibida de 1 a
                                        5.</label>

                                    <select class="form-control" name="importancia_informacion"
                                        id="importancia_informacion">
                                        <option value=""></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button id="enviar" type="button" class="btn btn-info" onclick="siguiente(10);"
                            style="float: right;">
                            siguiente

                            <i class="feather icon-arrow-right"></i>
                        </button>

                        <button class="btn btn-info mb-1" type="button" disabled style="float: right;display: none;"
                            id="cargando">
                            <span class="">siguiente </span>

                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </button>

                        <button type="button" class="btn btn-info" onclick="anterior(9);">
                            <i class="feather icon-arrow-left"></i>

                            anterior
                        </button>
                    </div>
                </div> --}}
            </form>
        </div>
    @endif

    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">PROTECCIÓN DE DATOS
                    </h4>
                </div>

                <div class="modal-body">                    
                    <p>
                        <strong>CONFIDENCIAL: </strong> El CONSORCIO y la ANSV garantizará a todos los participantes lo
                        referido a supresión
                        de identidades según el artículo 7 de la Ley 1581 de 2012 (Ley de Habeas Data). La información que
                        se solicite y se registre en el desarrollo de está actividad, se utilizará exclusivamente con fines
                        evaluativos, en ningún caso con fines fiscales y es ESTRICTAMENTE CONFIDENCIAL.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="default2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">CONSENTIMIENTO INFORMADO
                    </h4>
                </div>

                <div class="modal-body">
                    
                    <p>
                        "Es una iniciativa de la ANSV que se implementará en 38 municipios, pertenecientes a 17
                        departamentos del país, enfocada a la mejora de conocimientos y habilidades para la conducción
                        segura de la bicicleta. Con este proceso se llegará a 25000 ciclistas a nivel nacional, divididos en
                        4 zonas del país, que facilitará el desarrollo de actividades en torno a la seguridad vial de los
                        ciclistas y territorialización de contenidos orientadores del proceso de formación. Las
                        BiciDestrezas son aquellas habilidades que se desarrollan para la conducción de la bici,
                        específicamente hacía el equilibrio, control, capacidad para realizar las señales manuales (conducir
                        con una sola mano sin perder el control), entre otras. Para promover la formación de los y las
                        ciclistas se llevarán a cabo dos (2) actividades: Reto BiciDestrezas y Proceso de Formación
                        Completa. Reto BiciDestrezas, se centra en la identificación de las habilidades de ciclistas que
                        vayan transitando por puntos priorizados con anticipación y que sean de alto tráfico de ciclistas,
                        posteriormente se les brindarán recomendaciones para mejorar su conducción. La Formación completa,
                        que está dirigida a grupos de ciclistas que hagan parte de empresas, colectivos, ligas y en general
                        agrupaciones de personas que usen la bicicleta como medio de transporte, competencia, entrenamiento,
                        turismo o deporte.

                        <br><br>

                        Para el desarrollo del proyecto es de suma importancia poder realizar registro fotográfico y de
                        video de las actividades a realizar en vía, los cuales servirán para una verificación de su
                        participación en las actividades, tambien es relevante obtener sus datos personales, con dos
                        motivos, el primero sistematizar, generar soporte de la actividad y analizar la información
                        posteriormente para nuevos proyectos de la ANSV y para el seguimineto que se van a dadelantar por
                        parte de la entidad mencionada, en el cual se podrán recibir correos, llamadas o mensajes
                        solicitando opiniones sobre la formación recibida, así como encuestas para evaluar el aprendizaje.
                        Por lo anterior, la participación en el evento, así como el diligenciamiento del siguiente formato,
                        dan por entendida su autorización para el uso de la información, bajo la Ley de Habeas Data
                        mencionada previamente. Me permito informarle que para la implementación del Reto Bicidestrezas o el
                        proceso de formación completa, el cual desarrollará en su propia bicicleta es importante que conozca
                        que es posible que usted sufra caidas, golpes o afectacones fisicas, que en caso llegarse a
                        presentar deberá asumirlas por su propia cuenta y en caso de aceptar podrá para participar tanto en
                        las acciones en vía como en los procesos de formación.

                        <br><br>

                        Tambien es importante que usted conozca que va a recibir un Kit con ELEMENTOS DE SEGURIDAD A SER
                        ENTREGADOS A PARTICIPANTES, el cual consiste en un juego de luces recargables, y una banda
                        reflectiva que le servirá para hacerse visible en las vías y un codigo QR en el cuál podrá encontrar
                        el MANUAL DEL CICLISTA SEGURO, estos elementos se le entragaran 1 vez, cuando haga parte de alguna
                        de las actividades"

                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <button style="display: none;" type="button" class="btn btn-success" data-toggle="modal" data-target="#fiebre"><i
            class="feather icon-plus" id="modalfiebre"></i></button>

    <div class="modal fade" id="fiebre" tabindex="-1" role="dialog" aria-labelledby="fiebreLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="fiebre">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fiebreLabel">PRECAUCIÓN</h5>
                </div>
                <div class="modal-body">
                    <center>
                        <h2>La temperatura asignada al usuario indica que tiene fiebre</h2>
                        <h4>por favor seguir el protocolo correspondiente.</h4>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ URL::to('app-assets/js/scripts/jquery.min.js') }}"></script>
    <script src="{{ URL::to('app-assets/js/scripts/signature_pad.js') }}"></script>
    <script src="{{ URL::to('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ URL::to('app-assets/js/scripts/forms/select/form-select2.js') }}"></script>

    <script>
        var inicio = 0;
        var timeout = 0;

        function funcionando() {
            // obtenemos la fecha actual
            var actual = new Date().getTime();

            // obtenemos la diferencia entre la fecha actual y la de inicio
            var diff = new Date(actual - inicio);

            // mostramos la diferencia entre la fecha actual y la inicial
            var result = LeadingZero(diff.getUTCHours()) + ":" + LeadingZero(diff.getUTCMinutes()) + ":" + LeadingZero(diff
                .getUTCSeconds());
            document.getElementById('crono').innerHTML = result;

            // Indicamos que se ejecute esta función nuevamente dentro de 1 segundo
            timeout = setTimeout("funcionando()", 1000);
        }

        /* Funcion que pone un 0 delante de un valor si es necesario */
        function LeadingZero(Time) {
            return (Time < 10) ? "0" + Time : +Time;
        }
    </script>

    <script type="text/javascript">
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
    </script>

    <script>
        var bandera = 0;

        function validar_temperatura() {
            var temperatura_inicio = $('#temperatura_inicio').val();

            if (temperatura_inicio < 35) {
                $('#alerta_temperatura').show();
            } else {
                if (temperatura_inicio > 40) {
                    $('#alerta_temperatura2').show();
                } else {
                    $('#alerta_temperatura2').hide();
                }

                $('#alerta_temperatura').hide();
            }
        }

        function revision() {
            var acepta_revision = $('input:radio[class=acepta_revision]:checked').val();

            if (acepta_revision == 'SI') {
                $('#tabla_revision').show();
            } else if (acepta_revision == 'NO') {
                $('#tabla_revision').hide();
            }
        }

        function siguiente(num) {
            if (num == 2) {
                if (bandera == 0) {
                    bandera = 1;

                    var dt = new Date();

                    $('#fecha_inicio').val(`${
    				    dt.getFullYear().toString().padStart(4, '0')}-${
    				    (dt.getMonth()+1).toString().padStart(2, '0')}-${
    				    dt.getDate().toString().padStart(2, '0')} ${
    				    dt.getHours().toString().padStart(2, '0')}:${
    				    dt.getMinutes().toString().padStart(2, '0')}:${
    				    dt.getSeconds().toString().padStart(2, '0')}`);

                    inicio = new Date().getTime();

                    funcionando();
                }

                if (signaturePad.isEmpty()) {
                    $('#alerta_firma').show();
                    return;
                } else {
                    $('#alerta_firma').hide();
                    $('#datos_firma').hide();
                    $('#datos_registro').show();
                }

            } else if (num == 3) {
                var fecha = $('#fecha').val();
                if (fecha == "") {
                    $('#fecha').focus();

                    return;
                }

                var jornada = $('#jornada').val();
                if (jornada == "") {
                    $('#jornada').focus();

                    return;
                }

                var encargado = $('#encargado').val();
                if (encargado == "") {
                    $('#encargado').focus();

                    return;
                }

                $('#datos_registro').hide();
                $('#datos_ciclista').show();
            } else if (num == 4) {
                var nombre = $('#nombre').val();
                if (nombre == "") {
                    $('#nombre').focus();

                    return;
                }

                var numero_documento = $('#numero_documento').val();
                if (numero_documento == "") {
                    $('#numero_documento').focus();

                    return;
                }

                var numero_contacto = $('#numero_contacto').val();
                if (numero_contacto == "") {
                    $('#numero_contacto').focus();

                    return;
                }

                var correo = $('#correo').val();
                if (correo == "") {
                    $('#correo').focus();

                    return;
                }

                var edad = $('#edad').val();
                if (edad == "") {
                    $('#edad').focus();

                    return;
                }

                var sexo = $('#sexo').val();
                if (sexo == "") {
                    $('#sexo').focus();

                    return;
                }

                var genero = $('#genero').val();
                if (genero == "") {
                    $('#genero').focus();

                    return;
                }

                var nivel_escolaridad = $('#nivel_escolaridad').val();
                if (nivel_escolaridad == "") {
                    $('#nivel_escolaridad').focus();

                    return;
                }

                var poblacion_vulnerable = $('#poblacion_vulnerable').val();
                if (poblacion_vulnerable == "") {
                    $('#poblacion_vulnerable').focus();

                    return;
                }

                var anos_experiencia = $('#anos_experiencia').val();
                if (anos_experiencia == "") {
                    $('#anos_experiencia').focus();

                    return;
                }

                var tiempo_uso = $('#tiempo_uso').val();
                if (tiempo_uso == "") {
                    $('#tiempo_uso').focus();

                    return;
                }

                var temperatura_inicio = $('#temperatura_inicio').val();
                if (temperatura_inicio == "") {
                    $('#temperatura_inicio').focus();

                    return;
                }

                if (temperatura_inicio >= 38) {
                    if (temperatura_inicio > 40) {
                        $('#temperatura_inicio').focus();
                        return;
                    } else {
                        $('#modalfiebre').click();
                    }
                } else if (temperatura_inicio < 35) {
                    $('#temperatura_inicio').focus();
                    return;
                }

                $('#datos_ciclista').hide();
                $('#datos_recorrido').show();
            } else if (num == 5) {
                var tipo_viaje = $('#tipo_viaje').val();
                if (tipo_viaje == "") {
                    $('#tipo_viaje').focus();

                    return;
                }

                $('#datos_recorrido').hide();
                $('#datos_reto').show();
            } else if (num == 6) {
                if (!document.querySelector('input[name="subida_perdida_control"]:checked')) {
                    $('#subida_perdida_control').focus();
                    return;
                }

                if (!document.querySelector('input[name="dedos_frenos"]:checked')) {
                    $('#dedos_frenos').focus();
                    return;
                }

                if (!document.querySelector('input[name="pie_suelo_otro_pedal"]:checked')) {
                    $('#pie_suelo_otro_pedal').focus();
                    return;
                }

                if (!document.querySelector('input[name="empuje_equilibrio"]:checked')) {
                    $('#empuje_equilibrio').focus();
                    return;
                }

                if (!document.querySelector('input[name="levantar_mano_perdida_control"]:checked')) {
                    $('#levantar_mano_perdida_control').focus();
                    return;
                }

                if (!document.querySelector('input[name="conoce_senales_manuales"]:checked')) {
                    $('#conoce_senales_manuales').focus();
                    return;
                }

                if (!document.querySelector('input[name="derrapa_frenado"]:checked')) {
                    $('#derrapa_frenado').focus();
                    return;
                }

                if (!document.querySelector('input[name="posicion_cuerpo_frenado"]:checked')) {
                    $('#posicion_cuerpo_frenado').focus();
                    return;
                }

                if (!document.querySelector('input[name="mira_atras"]:checked')) {
                    $('#mira_atras').focus();
                    return;
                }

                if (!document.querySelector('input[name="equilibrio_mira_atras"]:checked')) {
                    $('#equilibrio_mira_atras').focus();
                    return;
                }

                if (!document.querySelector('input[name="hombro_referencia"]:checked')) {
                    $('#hombro_referencia').focus();
                    return;
                }

                if (!document.querySelector('input[name="mirada_frente"]:checked')) {
                    $('#mirada_frente').focus();
                    return;
                }

                if (!document.querySelector('input[name="mantiene_equilibrio"]:checked')) {
                    $('#mantiene_equilibrio').focus();
                    return;
                }

                if (!document.querySelector('input[name="pararse_pedales"]:checked')) {
                    $('#pararse_pedales').focus();
                    return;
                }

                if (!document.querySelector('input[name="cuerpo_atras"]:checked')) {
                    $('#cuerpo_atras').focus();
                    return;
                }

                if (!document.querySelector('input[name="levantar_rueda_delantera"]:checked')) {
                    $('#levantar_rueda_delantera').focus();
                    return;
                }

                if (!document.querySelector('input[name="cuerpo_centrado"]:checked')) {
                    $('#cuerpo_centrado').focus();
                    return;
                }

                if (!document.querySelector('input[name="apoyo_punta_pedales"]:checked')) {
                    $('#apoyo_punta_pedales').focus();
                    return;
                }

                if (!document.querySelector('input[name="ajusta_altura_ciclista"]:checked')) {
                    $('#ajusta_altura_ciclista').focus();
                    return;
                }

                $('#datos_reto').hide();
                $('#datos_documentacion').show();
            } else if (num == 7) {
                var tarjeta_propiedad = $('#tarjeta_propiedad').val();
                if (tarjeta_propiedad == "") {
                    $('#tarjeta_propiedad').focus();
                    return;
                }

                var marcacion = $('#marcacion').val();
                if (marcacion == "") {
                    $('#marcacion').focus();
                    return;
                }

                $('#datos_documentacion').hide();
                $('#datos_epp').show();
            } else if (num == 8) {
                if (!document.querySelector('input[name="uso_casco"]:checked')) {
                    $('#uso_casco').focus();
                    return;
                }

                if (!document.querySelector('input[name="uso_cinta_reflectiva"]:checked')) {
                    $('#uso_cinta_reflectiva').focus();
                    return;
                }

                if (!document.querySelector('input[name="uso_luz_delantera"]:checked')) {
                    $('#uso_luz_delantera').focus();
                    return;
                }

                if (!document.querySelector('input[name="uso_luz_trasera"]:checked')) {
                    $('#uso_luz_trasera').focus();
                    return;
                }

                if (!document.querySelector('input[name="uso_munequeras"]:checked')) {
                    $('#uso_munequeras').focus();
                    return;
                }

                if (!document.querySelector('input[name="uso_rodilleras"]:checked')) {
                    $('#uso_rodilleras').focus();
                    return;
                }

                if (!document.querySelector('input[name="uso_gafas"]:checked')) {
                    $('#uso_gafas').focus();
                    return;
                }

                if (!document.querySelector('input[name="uso_pito"]:checked')) {
                    $('#uso_pito').focus();
                    return;
                }

                if (!document.querySelector('input[name="uso_guantes"]:checked')) {
                    $('#uso_guantes').focus();
                    return;
                }

                $('#datos_epp').hide();
                $('#datos_revision').show();
            } else if (num == 9) {
                if (!document.querySelector('input[name="acepta_revision"]:checked')) {
                    $('#acepta_revision').focus();
                    return;
                }
                var acepta_revision = $('input:radio[class=acepta_revision]:checked').val();

                if (acepta_revision == 'SI') {
                    if (!document.querySelector('input[name="sillin_rota_desliza"]:checked')) {
                        $('#sillin_rota_desliza').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="sillin_roto_fisura"]:checked')) {
                        $('#sillin_roto_fisura').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="sillin_altura_cadera"]:checked')) {
                        $('#sillin_altura_cadera').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="poste_roto"]:checked')) {
                        $('#poste_roto').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="frenos_componentes_completos"]:checked')) {
                        $('#frenos_componentes_completos').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="frenos_desgastados"]:checked')) {
                        $('#frenos_desgastados').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="frenos_calibrados"]:checked')) {
                        $('#frenos_calibrados').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="cadena_rota_fisurada"]:checked')) {
                        $('#cadena_rota_fisurada').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="cadena_lubricacion"]:checked')) {
                        $('#cadena_lubricacion').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="cadena_desgaste"]:checked')) {
                        $('#cadena_desgaste').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="roturas_platos_pinones"]:checked')) {
                        $('#roturas_platos_pinones').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="roturas_bielas_pedales_centro"]:checked')) {
                        $('#roturas_bielas_pedales_centro').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="hace_cambios"]:checked')) {
                        $('#hace_cambios').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="llantas_sentido_rotacion"]:checked')) {
                        $('#llantas_sentido_rotacion').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="llantas_fisuradas"]:checked')) {
                        $('#llantas_fisuradas').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="llantas_presion"]:checked')) {
                        $('#llantas_presion').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="radios_rotos"]:checked')) {
                        $('#radios_rotos').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="llantas_alineacion"]:checked')) {
                        $('#llantas_alineacion').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="rin_fisurado"]:checked')) {
                        $('#rin_fisurado').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="direccion_gira"]:checked')) {
                        $('#direccion_gira').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="direccion_rodamientos_juego"]:checked')) {
                        $('#direccion_rodamientos_juego').focus();
                        return;
                    }

                    if (!document.querySelector('input[name="manillar_centrado"]:checked')) {
                        $('#manillar_centrado').focus();
                        return;
                    }
                }

                var ctx = document.getElementById("canvas");
                var image = ctx.toDataURL(); // data:image/png...

                document.getElementById('base64').value = image;

                console.log(document.getElementById('crono').innerHTML);

                if (document.getElementById('crono').innerHTML < "00:17:00") {
                    Swal.fire({
                        title: 'El tiempo mínimo para un registro es de 17 minutos',
                        text: "¿Aún desea guardar?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, guardar',
                        cancelButtonText: 'No, cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#cargando').show();
                            $('#enviar').hide();

                            $('#env_form').submit();
                        }
                    })
                }else if(document.getElementById('crono').innerHTML >= "00:17:00"){
                    $('#cargando').show();
                    $('#enviar').hide();

                    $('#env_form').submit();
                }

            }
            /* else if (num == 11) {
                           var evaluacion_taller = $('#evaluacion_taller').val();
                           if (evaluacion_taller == "") {
                               $('#evaluacion_taller').focus();
                               return;
                           }

                           var importancia_informacion = $('#importancia_informacion').val();
                           if (importancia_informacion == "") {
                               $('#importancia_informacion').focus();
                               return;
                           }

                           
                       } */
        }

        function anterior(num) {
            if (num == 1) {
                $('#datos_firma').show();
                $('#datos_registro').hide();
            } else if (num == 2) {
                $('#datos_firma').show();
                $('#datos_registro').hide();
            } else if (num == 3) {
                $('#datos_registro').show();
                $('#datos_ciclista').hide();
            } else if (num == 4) {
                $('#datos_ciclista').show();
                $('#datos_recorrido').hide();
            } else if (num == 5) {
                $('#datos_recorrido').show();
                $('#datos_reto').hide();
            } else if (num == 6) {
                $('#datos_reto').show();
                $('#datos_documentacion').hide();
            } else if (num == 7) {
                $('#datos_documentacion').show();
                $('#datos_epp').hide();
            } else if (num == 8) {
                $('#datos_epp').show();
                $('#datos_revision').hide();
            }
        }
    </script>
@endsection

@section('vendor-script')
    <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endsection
