@extends('layouts/contentLayoutMaster')

@section('title', 'Formulario Formación')

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
                <a href="{{ URL::to('formulario/formacion') }}" type="button" class="btn btn-primary"
                    style="float: right;color:#fff;">volver a consultar</a>
            </div>
        </div>
    @else
        <div>
            <div class="col-md-4">
                <h3>Tiempo: <span id='crono'>00:00:00</span></h3>
            </div>

            <form method="post" action="{{ URL::to('formulario/guardarformularioformacion') }}"
                enctype="multipart/form-data" id="env_form">
                @csrf

                <div class="card" id="datos_firma">
                    <div class="card-header">
                        <h4 class="card-title">Aceptación de términos</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <input type="checkbox" id="actividad" name="actividad" checked> Autorizo para participar en la
                            actividad y asistencia
                            <br>

                            <input type="checkbox" id="datos_personales" name="datos_personales" checked> Autorizo la toma y
                            <a href="#" data-toggle="modal" data-target="#default"> POLITICA DE TRATAMIENTO Y PROTECCIÓN DE
                                DATOS PERSONALES</a> y registro fotografico
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
                        <h4 class="card-title">DATOS DE IDENTIFICACIÓN</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="tipo_documento">Tipo de documento</label>

                                    <select class="form-control" name="tipo_documento" id="tipo_documento">
                                        <option value=""></option>
                                        <option value="CC">Cédula de Ciudadanía</option>
                                        <option value="CE">Cédula de Extranjería</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label for="numero_documento">Número documento</label>

                                    <input class="form-control" type="number" name="numero_documento"
                                        id="numero_documento" value="{{ $numero_documento }}">
                                </div>

                                <div class="col-sm-6">
                                    <label for="nombre">Nombre completo</label>

                                    <input type="text" style="text-transform:uppercase;" class="form-control"
                                        name="nombre" id="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>

                                <div class="col-sm-6">
                                    <label for="nombre_entidad">Nombre de la entidad, empresa o colectivo a la que
                                        pertenece</label>

                                    <input type="text" style="text-transform:uppercase;" class="form-control"
                                        name="nombre_entidad" id="nombre_entidad"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>

                                <div class="col-sm-6">
                                    <label for="ciudad_residencia">Ciudad de residencia</label>

                                    <select class="form-control" name="ciudad_residencia" id="ciudad_residencia">
                                        <option value=""></option>
                                        <option value="Santa Marta">Santa Marta</option>
                                        <option value="Valledupar">Valledupar</option>
                                        <option value="Montería">Montería</option>
                                        <option value="Riohacha">Riohacha</option>
                                        <option value="Cúcuta">Cúcuta</option>
                                        <option value="Cartagena">Cartagena</option>
                                        <option value="Ciénaga">Ciénaga</option>
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

                <div class="card" id="datos_nivel_1" style="display: none;">
                    <div class="card-header">
                        <h4 class="card-title">Nivel I- Conocimientos básicos</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <input type="hidden" id="fecha_inicio" name="fecha_inicio" value="">

                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="bicicleta_es">1. La bicicleta es:</label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="bicicleta_es" name="bicicleta_es" id="bicicleta_es"
                                                value="Un juguete">
                                            <label>Un juguete</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="bicicleta_es" name="bicicleta_es"
                                                value="Un medio de transporte">
                                            <label>Un medio de transporte</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="bicicleta_es" name="bicicleta_es"
                                                value="Un vehículo">
                                            <label>Un vehículo</label><br><br>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <label for="ciclista_es">2. Usted como ciclista es:</label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="ciclista_es" name="ciclista_es" id="ciclista_es"
                                                value="Un conductor">
                                            <label>Un conductor</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="ciclista_es" name="ciclista_es"
                                                value="Un usuario de la bicicleta">
                                            <label>Un usuario de la bicicleta</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="ciclista_es" name="ciclista_es"
                                                value="Un deportista">
                                            <label>Un deportista</label><br><br>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <label for="norma_transito_1">3. Es una norma de tránsito: No deben adelantar a otros
                                        vehículos por la derecha o entre vehículos que transiten por sus respectivos
                                        carriles.</label><br>
                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="norma_transito_1" name="norma_transito_1"
                                                id="norma_transito_1" value="Verdadero">
                                            <label>Verdadero</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="norma_transito_1" name="norma_transito_1"
                                                value="Falso">
                                            <label>Falso</label><br><br>
                                        </li>
                                    </ul>

                                </div>

                                <div class="col-sm-6">
                                    <label for="norma_transito_2">4. Es una norma de tránsito: los ciclistas deben transitar
                                        por el lado derecho de la vía, a un metro y medio al lado de los vehículos.
                                    </label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="norma_transito_2" name="norma_transito_2"
                                                id="norma_transito_2" value="Verdadero">
                                            <label>Verdadero</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="norma_transito_2" name="norma_transito_2"
                                                value="Falso">
                                            <label>Falso</label><br><br>
                                        </li>
                                    </ul>

                                </div>

                                <div class="col-sm-6">
                                    <label for="norma_transito_3">5. Es una norma de tránsito: El ciclista o la ciclista
                                        debe hacerse visible utilizando pitos y chaleco reflectivo.</label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="norma_transito_3" name="norma_transito_3"
                                                id="norma_transito_3" value="Verdadero">
                                            <label>Verdadero</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="norma_transito_3" name="norma_transito_3"
                                                value="Falso">
                                            <label>Falso</label>
                                        </li>
                                    </ul>
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

                <div class="card" id="datos_nivel_2" style="display: none;">
                    <div class="card-header">
                        <h4 class="card-title">Nivel II. Iniciación en vía</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="transito_cicloruta">6. Transitamos por las ciclorrutas cuando las hay.
                                        Cuando no, podemos transitar por la calzada ocupando un carril, preferiblemente el
                                        derecho.</label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="transito_cicloruta" name="transito_cicloruta"
                                                id="transito_cicloruta" value="Verdadero">
                                            <label>Verdadero</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="transito_cicloruta" name="transito_cicloruta"
                                                value="Falso">
                                            <label>Falso</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <label for="espacio_publico">7. El espacio público corresponde al conjunto de inmuebles
                                        públicos y los elementos arquitectónicos y naturales de los inmuebles privados,
                                        destinados por su naturaleza, por su uso o afectación, a la satisfacción de
                                        necesidades urbanas colectivas que transcienden, por tanto, los límites de los
                                        intereses, individuales de los habitantes. </label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="espacio_publico" name="espacio_publico"
                                                id="espacio_publico" value="Verdadero">
                                            <label>Verdadero</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="espacio_publico" name="espacio_publico"
                                                value="Falso">
                                            <label>Falso</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <label for="casco_uso">8. El casco es de uso: </label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="casco_uso" name="casco_uso" id="casco_uso"
                                                value="Obligatorio">
                                            <label>Obligatorio</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="casco_uso" name="casco_uso" value="Voluntario">
                                            <label>Voluntario</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <label for="girar_derecha">9. Si necesitas girar a la derecha, mientras conduces
                                        bicicleta:</label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="girar_derecha" name="girar_derecha"
                                                id="girar_derecha" value="Pitas para que las demás personas se den cuenta.">
                                            <label>Pitas para que las demás personas se den cuenta.</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="girar_derecha" name="girar_derecha"
                                                value="Extiendes el brazo izquierdo con la mano hacia arriba.">
                                            <label>Extiendes el brazo izquierdo con la mano hacia arriba.</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="girar_derecha" name="girar_derecha"
                                                value="Volteas a mirar y revisas que puedas voltear sin problema.">
                                            <label>Volteas a mirar y revisas que puedas voltear sin
                                                problema.</label><br><br>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <label for="cuando_frena">10. Cuando vas a frenar:</label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="cuando_frena" name="cuando_frena" id="cuando_frena"
                                                value="Extiende la mano izquierda hacia abajo">
                                            <label>Extiende la mano izquierda hacia abajo</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="cuando_frena" name="cuando_frena"
                                                value="Pita para que los demás actores viales sepan que vas a hacer algo">
                                            <label>Pita para que los demás actores viales sepan que vas a hacer algo</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="cuando_frena" name="cuando_frena"
                                                value="No es necesario hacer nada, sencillamente para">
                                            <label>No es necesario hacer nada, sencillamente para</label>
                                        </li>
                                    </ul>
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

                <div class="card" id="datos_nivel_3" style="display: none;">
                    <div class="card-header">
                        <h4 class="card-title">Nivel III. Cotidianidad en vía</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="puntos_ciegos">11. Los puntos ciegos son posiciones alrededor de un vehículo
                                        que no pueden ser controlados visualmente por el conductor, y están presentes tanto
                                        en carros como en motocicletas.</label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="puntos_ciegos" name="puntos_ciegos"
                                                id="puntos_ciegos" value="Verdadero">
                                            <label>Verdadero</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="puntos_ciegos" name="puntos_ciegos" value="Falso">
                                            <label>Falso</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <label for="cruzar_obstaculo">12. Para cruzar un obstáculo en la vía (hueco, bache), el
                                        o la ciclista debe poder: pararse en los pedales previo al subir o al descenso,
                                        llevar el cuerpo hacia atrás y levantar la rueda delantera. </label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="cruzar_obstaculo" name="cruzar_obstaculo"
                                                id="cruzar_obstaculo" value="Verdadero">
                                            <label>Verdadero</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="cruzar_obstaculo" name="cruzar_obstaculo"
                                                value="Falso">
                                            <label>Falso</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <label for="disminuir_riesgo">13. Para disminuir el riesgo de no ser visible para los
                                        demás actores viales, el o la ciclista debe:</label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="disminuir_riesgo" name="disminuir_riesgo"
                                                id="disminuir_riesgo" value="Estar atento (a) a las señales de tránsito">
                                            <label>Estar atento (a) a las señales de tránsito</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="disminuir_riesgo" name="disminuir_riesgo"
                                                value="Verificar que la cicla esté en buenas condiciones">
                                            <label>Verificar que la cicla esté en buenas condiciones</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="disminuir_riesgo" name="disminuir_riesgo"
                                                value="Llevar los elementos de protección personal">
                                            <label>Llevar los elementos de protección personal</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <label for="ciclista_evitar">14. El ciclista puede evitar los puntos ciegos (puede
                                        marcar una o más respuestas):</label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="checkbox" id="ciclista_evitar_1">

                                            <input type="hidden" name="ciclista_evitar_res_1" id="ciclista_evitar_res_1"
                                                value="">
                                            <label>Buscando siempre ver la cara del conductor del otro vehículo por uno de
                                                sus espejos.</label>
                                        </li>

                                        <li>
                                            <input type="checkbox" id="ciclista_evitar_2">

                                            <input type="hidden" name="ciclista_evitar_res_2" id="ciclista_evitar_res_2"
                                                value="">
                                            <label>Ubicándose a una distancia desde la cual pueda tener contacto visual
                                                directo con el conductor de adelante.</label>
                                        </li>

                                        <li>
                                            <input type="checkbox" id="ciclista_evitar_3">

                                            <input type="hidden" name="ciclista_evitar_res_3" id="ciclista_evitar_res_3"
                                                value="">
                                            <label>Evitar rodar en paralelo al otro vehículo (especialmente con buses y
                                                vehículos de carga)</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <label for="cotidianidad">15. En la cotidianidad de la vía, según las normas de
                                        tránsito, ¿Quién tiene la prioridad?</label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="cotidianidad" name="cotidianidad"
                                                id="cotidianidad" value="Los ciclistas">
                                            <label>Los ciclistas</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="cotidianidad" name="cotidianidad"
                                                value="Los vehículos motorizados">
                                            <label>Los vehículos motorizados</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="cotidianidad" name="cotidianidad"
                                                value="Los peatones">
                                            <label>Los peatones</label>
                                        </li>
                                    </ul>
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

                <div class="card" id="datos_nivel_4" style="display: none;">
                    <div class="card-header">
                        <h4 class="card-title">Nivel IV. Mecánica básica</h4>
                    </div>

                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="cierres_ruedas">16. Es importante que se compruebe los cierres de las
                                        ruedas, para ello es necesario asegurarse de que estén bien apretados. </label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="cierres_ruedas" name="cierres_ruedas"
                                                id="cierres_ruedas" value="Verdadero">
                                            <label>Verdadero</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="cierres_ruedas" name="cierres_ruedas" value="Falso">
                                            <label>Falso</label>
                                        </li>
                                    </ul>
                                </div>


                                <div class="col-sm-6">
                                    <label for="sistema_conducir">17. Es el sistema que nos permite conducir nuestra
                                        bicicleta y dirigirla hacia donde queramos, utilizamos nuestras manos para
                                        controlarlo.</label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="sistema_conducir" name="sistema_conducir"
                                                id="sistema_conducir" value="Sistema de dirección">
                                            <label>Sistema de dirección</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="sistema_conducir" name="sistema_conducir"
                                                value="Sistema de transmisión">
                                            <label>Sistema de transmisión</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="sistema_conducir" name="sistema_conducir"
                                                value="Sistema de frenos">
                                            <label>Sistema de frenos</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <label for="antes_subir">18. Antes de subir a la bicicleta se debe revisar solo los
                                        frenos y la rueda. </label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="antes_subir" name="antes_subir" id="antes_subir"
                                                value="Verdadero">
                                            <label>Verdadero</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="antes_subir" name="antes_subir" value="Falso">
                                            <label>Falso</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <label for="platos_pinones">19. Los platos y los piñones hacen parte de este sistema de
                                        la bicicleta:</label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="platos_pinones" name="platos_pinones"
                                                id="platos_pinones" value="Sistema de dirección">
                                            <label>Sistema de dirección</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="platos_pinones" name="platos_pinones"
                                                value="Sistema de Transmisión">
                                            <label>Sistema de Transmisión</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="platos_pinones" name="platos_pinones"
                                                value="Sistema de frenos">
                                            <label>Sistema de frenos</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-6">
                                    <label for="antes_lubricar">20. Antes de lubricar la cadena es recomendable limpiarla,
                                        retirando todo material que se ha adherido con el uso cotidiano como polvo, barro y
                                        otro material de suciedad.</label><br>

                                    <ul style="list-style:none">
                                        <li>
                                            <input type="radio" class="antes_lubricar" name="antes_lubricar"
                                                id="antes_lubricar" value="Verdadero">
                                            <label>Verdadero</label>
                                        </li>

                                        <li>
                                            <input type="radio" class="antes_lubricar" name="antes_lubricar" value="Falso">
                                            <label>Falso</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button id="enviar" type="button" class="btn btn-info" onclick="siguiente(7);"
                            style="float: right;">siguiente <i class="feather icon-arrow-right"></i></button>

                        <button class="btn btn-info mb-1" type="button" disabled style="float: right;display: none;"
                            id="cargando">
                            <span class="">siguiente </span>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </button>

                        <button type="button" class="btn btn-info" onclick="anterior(6);"><i
                                class="feather icon-arrow-left"></i> anterior</button>
                    </div>
                </div>
            </form>
        </div>
    @endif

    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">POLITICA DE TRATAMIENTO Y PROTECCIÓN DE DATOS PERSONALES
                    </h4>
                </div>

                <div class="modal-body">
                    <p>
                        Respetado(a) Usuario: Con el fin de dar cumplimiento a lo estipulado en el artículo 10 del Decreto
                        1377 de 2013, reglamentario de la Ley 1581 de 2012, le manifestamos que sus datos personales se
                        encuentran almacenados en las bases de datos de LA AGENCIA NACIONAL DE SEGURIDAD VIAL , con el fin
                        de hacerlo partícipe de actividades de promoción y prevención en seguridad vial, gestión del riesgo
                        en el sector transporte, evaluar la calidad de nuestros tramites y servicios, y facilitarle el
                        acceso general a la información pública y de utilidad para toda la ciudadanía. LA AGENCIA NACIONAL
                        DE SEGURIDAD VIAL solicita a sus usuarios la autorización para continuar usando sus datos
                        personales, con fines promocionales e informativos y así mantenerlo actualizado de nuestros tramites
                        y servicios. De acuerdo con nuestra Política de tratamiento de datos personales, los medios a través
                        de los cuales realizamos la recolección, almacenamiento y uso de los mismos, son seguros y
                        confidenciales, ya que contamos con las herramientas tecnológicas y el recurso humano idóneo, con el
                        fin de asegurar que su información esté almacenada de forma segura, evitando el acceso no autorizado
                        de terceras personas y asegurando la confidencialidad de la misma.
                    </p>

                    <p>
                        Ningún dato sensible que viole la integridad y privacidad de la información de un usuario podrá ser
                        usado con fines diferentes a los de consecución de los objetivos misionales de la entidad, La
                        Agencia Nacional de Seguridad Vial solamente empleará los datos personales, en conformidad con lo
                        establecido por la ley.
                    </p>
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
                var tipo_documento = $('#tipo_documento').val();
                if (tipo_documento == "") {
                    $('#tipo_documento').focus();

                    return;
                }

                var nombre = $('#nombre').val();
                if (nombre == "") {
                    $('#nombre').focus();

                    return;
                }

                var nombre_entidad = $('#nombre_entidad').val();
                if (nombre_entidad == "") {
                    $('#nombre_entidad').focus();

                    return;
                }

                var ciudad_residencia = $('#ciudad_residencia').val();
                if (ciudad_residencia == "") {
                    $('#ciudad_residencia').focus();

                    return;
                }

                $('#datos_registro').hide();
                $('#datos_nivel_1').show();
            } else if (num == 4) {
                var bicicleta_es = $('input:radio[class=bicicleta_es]:checked').val();
                if (bicicleta_es == undefined) {
                    $('#bicicleta_es').focus();

                    return;
                }

                var ciclista_es = $('input:radio[class=ciclista_es]:checked').val();
                if (ciclista_es == undefined) {
                    $('#ciclista_es').focus();

                    return;
                }

                var norma_transito_1 = $('input:radio[class=norma_transito_1]:checked').val();
                if (norma_transito_1 == undefined) {
                    $('#norma_transito_1').focus();

                    return;
                }

                var norma_transito_2 = $('input:radio[class=norma_transito_2]:checked').val();
                if (norma_transito_2 == undefined) {
                    $('#norma_transito_2').focus();

                    return;
                }

                var norma_transito_3 = $('input:radio[class=norma_transito_3]:checked').val();
                if (norma_transito_3 == undefined) {
                    $('#norma_transito_3').focus();

                    return;
                }

                $('#datos_nivel_1').hide();
                $('#datos_nivel_2').show();
            } else if (num == 5) {
                var transito_cicloruta = $('input:radio[class=transito_cicloruta]:checked').val();
                if (transito_cicloruta == undefined) {
                    $('#transito_cicloruta').focus();

                    return;
                }

                var espacio_publico = $('input:radio[class=espacio_publico]:checked').val();
                if (espacio_publico == undefined) {
                    $('#espacio_publico').focus();

                    return;
                }

                var casco_uso = $('input:radio[class=casco_uso]:checked').val();
                if (casco_uso == undefined) {
                    $('#casco_uso').focus();

                    return;
                }

                var girar_derecha = $('input:radio[class=girar_derecha]:checked').val();
                if (girar_derecha == undefined) {
                    $('#girar_derecha').focus();

                    return;
                }

                var cuando_frena = $('input:radio[class=cuando_frena]:checked').val();
                if (cuando_frena == undefined) {
                    $('#cuando_frena').focus();

                    return;
                }

                $('#datos_nivel_2').hide();
                $('#datos_nivel_3').show();
            } else if (num == 6) {
                var puntos_ciegos = $('input:radio[class=puntos_ciegos]:checked').val();
                if (puntos_ciegos == undefined) {
                    $('#puntos_ciegos').focus();

                    return;
                }

                var cruzar_obstaculo = $('input:radio[class=cruzar_obstaculo]:checked').val();
                if (cruzar_obstaculo == undefined) {
                    $('#cruzar_obstaculo').focus();

                    return;
                }

                var disminuir_riesgo = $('input:radio[class=disminuir_riesgo]:checked').val();
                if (disminuir_riesgo == undefined) {
                    $('#disminuir_riesgo').focus();

                    return;
                }

                if ($('#ciclista_evitar_1').is(':checked')) {
                    $('#ciclista_evitar_res_1').val(1);
                } else {
                    $('#ciclista_evitar_res_1').val(0);
                }

                if ($('#ciclista_evitar_2').is(':checked')) {
                    $('#ciclista_evitar_res_2').val(1);
                } else {
                    $('#ciclista_evitar_res_2').val(0);
                }

                if ($('#ciclista_evitar_3').is(':checked')) {
                    $('#ciclista_evitar_res_3').val(1);
                } else {
                    $('#ciclista_evitar_res_3').val(0);
                }

                var cotidianidad = $('input:radio[class=cotidianidad]:checked').val();
                if (cotidianidad == undefined) {
                    $('#cotidianidad').focus();

                    return;
                }
                $('#datos_nivel_3').hide();
                $('#datos_nivel_4').show();
            } else if (num == 7) {
                var cierres_ruedas = $('input:radio[class=cierres_ruedas]:checked').val();
                if (cierres_ruedas == undefined) {
                    $('#cierres_ruedas').focus();

                    return;
                }

                var sistema_conducir = $('input:radio[class=sistema_conducir]:checked').val();
                if (sistema_conducir == undefined) {
                    $('#sistema_conducir').focus();

                    return;
                }

                var antes_subir = $('input:radio[class=antes_subir]:checked').val();
                if (antes_subir == undefined) {
                    $('#antes_subir').focus();

                    return;
                }

                var platos_pinones = $('input:radio[class=platos_pinones]:checked').val();
                if (platos_pinones == undefined) {
                    $('#platos_pinones').focus();

                    return;
                }

                var antes_lubricar = $('input:radio[class=antes_lubricar]:checked').val();
                if (antes_lubricar == undefined) {
                    $('#antes_lubricar').focus();

                    return;
                }

                var ctx = document.getElementById("canvas");
                var image = ctx.toDataURL(); // data:image/png....

                document.getElementById('base64').value = image;

                $('#cargando').show()
                $('#enviar').hide()

                $('#env_form').submit();
            }
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
                $('#datos_nivel_1').hide();
            } else if (num == 4) {
                $('#datos_nivel_1').show();
                $('#datos_nivel_2').hide();
            } else if (num == 5) {
                $('#datos_nivel_2').show();
                $('#datos_nivel_3').hide();
            } else if (num == 6) {
                $('#datos_nivel_3').show();
                $('#datos_nivel_4').hide();
            }
        }
    </script>
@endsection
