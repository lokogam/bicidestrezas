<div class="card" id="datos_registro">
    <div class="card-header">
        <h4 class="card-title">DATOS DE IDENTIFICACIÓN</h4>
    </div>

    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><b>Firma</b></label>

                        <center>
                            <img style="width: 300px; heigth: 300px; border-radius: 8px;"
                                src="{{ URL::to('firmas/' . $registro[0]->firma) }}">
                        </center>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <label>Tipo de documento</label>

                    <input type="text" class="form-control" value="{{ $registro[0]->tipo_documento }}">
                </div>

                <div class="col-sm-6">
                    <label>Número documento</label>

                    <input class="form-control" type="number" value="{{ $registro[0]->numero_documento }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label>Nombre completo</label>

                    <input type="text" class="form-control" value="{{ $registro[0]->nombre }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label>Nombre de la entidad, empresa o colectivo a la que
                        pertenece</label>

                    <input type="text" class="form-control" value="{{ $registro[0]->nombre_entidad }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label>Ciudad de residencia</label>

                    <input type="text" class="form-control" value="{{ $registro[0]->ciudad_residencia }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" id="datos_nivel_1">
    <div class="card-header">
        <h4 class="card-title">Nivel I- Conocimientos básicos</h4>
    </div>

    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <label for="bicicleta_es">1. La bicicleta es:</label><br>

                    <ul style="list-style:none">
                        <li>
                            <input type="radio"
                                {{ $registro[0]->bicicleta_es == 'Un juguete' ? 'checked' : 'disabled' }}>
                            <label>Un juguete</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->bicicleta_es == 'Un medio de transporte' ? 'checked' : 'disabled' }}>
                            <label>Un medio de transporte</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->bicicleta_es == 'Un vehículo' ? 'checked' : 'disabled' }}>
                            <label>Un vehículo</label><br><br>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6">
                    <label for="ciclista_es">2. Usted como ciclista es:</label><br>

                    <ul style="list-style:none">
                        <li>
                            <input type="radio"
                                {{ $registro[0]->ciclista_es == 'Un conductor' ? 'checked' : 'disabled' }}>
                            <label>Un conductor</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->ciclista_es == 'Un usuario de la bicicleta' ? 'checked' : 'disabled' }}>
                            <label>Un usuario de la bicicleta</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->ciclista_es == 'Un deportista' ? 'checked' : 'disabled' }}>
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
                            <input type="radio"
                                {{ $registro[0]->norma_transito_1 == 'Verdadero' ? 'checked' : 'disabled' }}>
                            <label>Verdadero</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->norma_transito_1 == 'Falso' ? 'checked' : 'disabled' }}>
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
                            <input type="radio"
                                {{ $registro[0]->norma_transito_2 == 'Verdadero' ? 'checked' : 'disabled' }}>
                            <label>Verdadero</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->norma_transito_2 == 'Falso' ? 'checked' : 'disabled' }}>
                            <label>Falso</label><br><br>
                        </li>
                    </ul>

                </div>

                <div class="col-sm-6">
                    <label for="norma_transito_3">5. Es una norma de tránsito: El ciclista o la ciclista
                        debe hacerse visible utilizando pitos y chaleco reflectivo.</label><br>

                    <ul style="list-style:none">
                        <li>
                            <input type="radio"
                                {{ $registro[0]->norma_transito_3 == 'Verdadero' ? 'checked' : 'disabled' }}>
                            <label>Verdadero</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->norma_transito_3 == 'Falso' ? 'checked' : 'disabled' }}>
                            <label>Falso</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" id="datos_nivel_2">
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
                            <input type="radio"
                                {{ $registro[0]->transito_cicloruta == 'Verdadero' ? 'checked' : 'disabled' }}>
                            <label>Verdadero</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->transito_cicloruta == 'Falso' ? 'checked' : 'disabled' }}>
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
                            <input type="radio"
                                {{ $registro[0]->espacio_publico == 'Verdadero' ? 'checked' : 'disabled' }}>
                            <label>Verdadero</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->espacio_publico == 'Falso' ? 'checked' : 'disabled' }}>
                            <label>Falso</label>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6">
                    <label for="casco_uso">8. El casco es de uso: </label><br>

                    <ul style="list-style:none">
                        <li>
                            <input type="radio"
                                {{ $registro[0]->casco_uso == 'Obligatorio' ? 'checked' : 'disabled' }}>
                            <label>Obligatorio</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->casco_uso == 'Voluntario' ? 'checked' : 'disabled' }}>
                            <label>Voluntario</label>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6">
                    <label for="girar_derecha">9. Si necesitas girar a la derecha, mientras conduces
                        bicicleta:</label><br>

                    <ul style="list-style:none">
                        <li>
                            <input type="radio"
                                {{ $registro[0]->girar_derecha == 'Pitas para que las demás personas se den cuenta.' ? 'checked' : 'disabled' }}>
                            <label>Pitas para que las demás personas se den cuenta.</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->girar_derecha == 'Extiendes el brazo izquierdo con la mano hacia arriba.' ? 'checked' : 'disabled' }}>
                            <label>Extiendes el brazo izquierdo con la mano hacia arriba.</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->girar_derecha == 'Volteas a mirar y revisas que puedas voltear sin problema.' ? 'checked' : 'disabled' }}>
                            <label>Volteas a mirar y revisas que puedas voltear sin problema.</label><br><br>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6">
                    <label for="cuando_frena">10. Cuando vas a frenar:</label><br>

                    <ul style="list-style:none">
                        <li>
                            <input type="radio"
                                {{ $registro[0]->cuando_frena == 'Extiende la mano izquierda hacia abajo' ? 'checked' : 'disabled' }}>
                            <label>Extiende la mano izquierda hacia abajo</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->cuando_frena == 'Pita para que los demás actores viales sepan que vas a hacer algo' ? 'checked' : 'disabled' }}>
                            <label>Pita para que los demás actores viales sepan que vas a hacer algo</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->cuando_frena == 'No es necesario hacer nada, sencillamente para' ? 'checked' : 'disabled' }}>
                            <label>No es necesario hacer nada, sencillamente para</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" id="datos_nivel_3">
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
                            <input type="radio"
                                {{ $registro[0]->puntos_ciegos == 'Verdadero' ? 'checked' : 'disabled' }}>
                            <label>Verdadero</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->puntos_ciegos == 'Falso' ? 'checked' : 'disabled' }}>
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
                            <input type="radio"
                                {{ $registro[0]->cruzar_obstaculo == 'Verdadero' ? 'checked' : 'disabled' }}>
                            <label>Verdadero</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->cruzar_obstaculo == 'Falso' ? 'checked' : 'disabled' }}>
                            <label>Falso</label>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6">
                    <label for="disminuir_riesgo">13. Para disminuir el riesgo de no ser visible para los
                        demás actores viales, el o la ciclista debe:</label><br>

                    <ul style="list-style:none">
                        <li>
                            <input type="radio"
                                {{ $registro[0]->disminuir_riesgo == 'Estar atento (a) a las señales de tránsito' ? 'checked' : 'disabled' }}>
                            <label>Estar atento (a) a las señales de tránsito</label>
                        </li>

                        <li>
                            <input type="radio" 
                                {{ $registro[0]->disminuir_riesgo == 'Verificar que la cicla esté en buenas condiciones' ? 'checked' : 'disabled' }}>
                            <label>Verificar que la cicla esté en buenas condiciones</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->disminuir_riesgo == 'Llevar los elementos de protección personal' ? 'checked' : 'disabled' }}>
                            <label>Llevar los elementos de protección personal</label>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6">
                    <label for="ciclista_evitar">14. El ciclista puede evitar los puntos ciegos (puede
                        marcar una o más respuestas):</label><br>

                    <ul style="list-style:none">
                        <li>
                            <input type="checkbox" {{ $registro[0]->ciclista_evitar_res_1 == 1 ? 'checked' : 'disabled' }}>

                            <label>Buscando siempre ver la cara del conductor del otro vehículo por uno de
                                sus espejos.</label>
                        </li>

                        <li>
                            <input type="checkbox" {{ $registro[0]->ciclista_evitar_res_2 == 1 ? 'checked' : 'disabled' }}>

                            <label>Ubicándose a una distancia desde la cual pueda tener contacto visual
                                directo con el conductor de adelante.</label>
                        </li>

                        <li>
                            <input type="checkbox" {{ $registro[0]->ciclista_evitar_res_3 == 1 ? 'checked' : 'disabled' }}>

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
                            <input type="radio"
                                {{ $registro[0]->cotidianidad == 'Los ciclistas' ? 'checked' : 'disabled' }}>
                            <label>Los ciclistas</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->cotidianidad == 'Los vehículos motorizados' ? 'checked' : 'disabled' }}>
                            <label>Los vehículos motorizados</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->cotidianidad == 'Los peatones' ? 'checked' : 'disabled' }}>
                            <label>Los peatones</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" id="datos_nivel_4">
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
                            <input type="radio"
                                {{ $registro[0]->cierres_ruedas == 'Verdadero' ? 'checked' : 'disabled' }}>
                            <label>Verdadero</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->cierres_ruedas == 'Falso' ? 'checked' : 'disabled' }}>
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
                            <input type="radio"
                                {{ $registro[0]->sistema_conducir == 'Sistema de dirección' ? 'checked' : 'disabled' }}>
                            <label>Sistema de dirección</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->sistema_conducir == 'Sistema de transmisión' ? 'checked' : 'disabled' }}>
                            <label>Sistema de transmisión</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->sistema_conducir == 'Sistema de frenos' ? 'checked' : 'disabled' }}>
                            <label>Sistema de frenos</label>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6">
                    <label for="antes_subir">18. Antes de subir a la bicicleta se debe revisar solo los
                        frenos y la rueda. </label><br>

                    <ul style="list-style:none">
                        <li>
                            <input type="radio"
                                {{ $registro[0]->antes_subir == 'Verdadero' ? 'checked' : 'disabled' }}>
                            <label>Verdadero</label>
                        </li>

                        <li>
                            <input type="radio" {{ $registro[0]->antes_subir == 'Falso' ? 'checked' : 'disabled' }}>
                            <label>Falso</label>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6">
                    <label for="platos_pinones">19. Los platos y los piñones hacen parte de este sistema de
                        la bicicleta:</label><br>

                    <ul style="list-style:none">
                        <li>
                            <input type="radio"
                                {{ $registro[0]->platos_pinones == 'dirección' ? 'checked' : 'disabled' }}>
                            <label>Sistema de dirección</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->platos_pinones == 'Sistema de transmisión' ? 'checked' : 'disabled' }}>
                            <label>Sistema de transmisión</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->platos_pinones == 'Sistema de frenos' ? 'checked' : 'disabled' }}>
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
                            <input type="radio"
                                {{ $registro[0]->antes_lubricar == 'Verdadero' ? 'checked' : 'disabled' }}>
                            <label>Verdadero</label>
                        </li>

                        <li>
                            <input type="radio"
                                {{ $registro[0]->antes_lubricar == 'Falso' ? 'checked' : 'disabled' }}>
                            <label>Falso</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
