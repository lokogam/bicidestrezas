<div class="card" id="datos_registro">
    <div class="card-header">
        <h4 class="card-title">DATOS DEL ESPACIO DE FORMACIÓN COMPLETA						
        </h4>
    </div>

    <div class="card-content collapse show" aria-expanded="true">

        <div class="card-body">

            <div class="row">

                <div class="col-sm-6">
                    <label for="fecha">Fecha</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->fecha}}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="hora">Hora Inicio</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->hora }}" readonly>
                </div>


                <div class="col-sm-6">
                    <label for="ubicacion_punto">Ubicación del punto</label>

                    <input class="form-control" type="text"
                        value="{{ $registro[0]->nombre_punto }} - {{ $registro[0]->ubicacion_espacio }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="encargado">Encargado</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->name }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="encargado">Documento</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->documento }}" readonly>
                </div>

            </div>

        </div>

    </div>
</div>

<div class="card" id="datos_ciclista">
    <div class="card-header">
        <h4 class="card-title">DATOS GENERALES DEL CICLISTA</h4>
    </div>

    <div class="card-content collapse show" aria-expanded="true">
    
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipoDoc"><b>Firma</b></label>

                        <center>
                            <img style="width: 300px; heigth: 300px; border-radius: 8px;"
                                src="{{ URL::to('firmas/' . $registro[0]->firma) }}">
                        </center>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <label for="nombre">Nombre y apellido</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->nombre }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="colectivo">Colectivo</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->colectivo }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="numero_documento">Cédula de ciudadanía</label>

                    <input class="form-control" type="number" value="{{ $registro[0]->numero_documento }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="numero_contacto">Número de celular</label>

                    <input class="form-control" type="number" value="{{ $registro[0]->numero_celular }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="correo">Correo electrónico</label>

                    <input class="form-control" type="email" value="{{ $registro[0]->correo }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="edad">Edad</label>

                    <input class="form-control" type="number" value="{{ $registro[0]->edad }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="sexo">Sexo</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->sexo }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="nivel_escolaridad">Nivel de escolaridad</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->nivel_escolaridad }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="poblacion_vulnerable">Población vulnerable</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->poblacion_vulnerable }}"
                        readonly>
                </div>
            </div>

        </div>
        </div>
</div>

<div class="card" id="datos_nivel_1">
    <div class="card-header">
        <h4 class="card-title">PRIMER NIVEL  </h4>
    </div>

    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">
            <h5>PRETEST NIVEL 1</h5>
            <div class="row">
                
                <div class="col-sm-6">
                    <label for="">¿LA BICICLETA ES?</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_1_pre_1 }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="">¿.USTED COMO CICLISTA ES?</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_2_pre_1 }}"
                        readonly>
                </div><br>

                <div class="col-sm-10 center">
                    <table class="table table_striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Pregunta</th>

                                <th scope="col">
                                    <center>V</center>
                                </th>

                                <th scope="col">
                                    <center>F</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <center>LOS CICLISTAS NO DEBEN ADELANTAR A OTROS VEHÍCULOS POR LA  DERECHA O ENTRE VEHÍCULOS QUE TRANSITEN POR SUS RESPECTIVOS CARRILES</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_3_pre_1 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_3_pre_1 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <center>COMO NORMA DE TRÁNSITO, LOS CICLISTAS DEBEN TRANSITAR POR EL LADO DERECHO DE LA VÍA, A UN METRO Y MEDIO AL LADO DE LOS VEHÍCULOS. </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_pre_1 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_pre_1 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <center>AL SUBIRSE A LA BICICLETA DEBE MANTENER LAS MANOS EN EL MANILLAR, CON DOS O TRES DEDOS EN LOS FRENOS Y AL ARRANCAR DEBE SOSTENERSE CON UN PIE EN EL SUELO Y CON EL OTRO PUESTO EN EL PEDAL.  </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_pre_1 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_pre_1 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-8">
                    <label for="">CALIFICACIÓN </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->calificacion_pre_1 }}"
                        readonly>
                </div>

            </div><br><br>
            <h5>POSTEST NIVEL 1</h5>
            <div class="row">
                <div class="col-sm-6">
                    <label for="">¿LA BICICLETA ES?</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_1_post_1 }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="">¿.USTED COMO CICLISTA ES?</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_2_post_1 }}"
                        readonly>
                </div><br>

                <div class="col-sm-10 center">
                    <table class="table table_striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Pregunta</th>

                                <th scope="col">
                                    <center>V</center>
                                </th>

                                <th scope="col">
                                    <center>F</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <center>LOS CICLISTAS NO DEBEN ADELANTAR A OTROS VEHÍCULOS POR LA  DERECHA O ENTRE VEHÍCULOS QUE TRANSITEN POR SUS RESPECTIVOS CARRILES</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_3_post_1 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_3_post_1 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <center>COMO NORMA DE TRÁNSITO, LOS CICLISTAS DEBEN TRANSITAR POR EL LADO DERECHO DE LA VÍA, A UN METRO Y MEDIO AL LADO DE LOS VEHÍCULOS. </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_post_1 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_post_1 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <center>AL SUBIRSE A LA BICICLETA DEBE MANTENER LAS MANOS EN EL MANILLAR, CON DOS O TRES DEDOS EN LOS FRENOS Y AL ARRANCAR DEBE SOSTENERSE CON UN PIE EN EL SUELO Y CON EL OTRO PUESTO EN EL PEDAL.  </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_post_1 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_post_1 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div><br>

                <div class="col-sm-8">
                    <label for="">CALIFICACIÓN </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->calificacion_post_1 }}"
                        readonly>
                </div>
            </div><br><br>
            <h5>EVALUACIÓN NIVEL 1</h5>
            <div class="row">
                <div class="col-sm-6">
                    <label for="">EVALUACIÓN DEL TALLER </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->evaluacion_taller_1 }}"
                        readonly>
                </div>
                <div class="col-sm-6">
                    <label for="">IMPORTANCIA DE LA INFORMACIÓN RECIBIDA </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->importancia_informacion_1 }}"
                        readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" id="datos_nivel_2">
    <div class="card-header">
        <h4 class="card-title">SEGUNDO NIVEL  </h4>
    </div>

    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">
            <h5>PRETEST NIVEL 2</h5>
            <div class="row">

                <div class="col-sm-6">
                    <label for="">EL CASCO ES DE USO</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_3_pre_2 }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="">¿CUÁL ES LA SEÑAL QUE SE DEBE HACER SI SE QUIERE GIRAR A LA DERECHA EN BICICLETA?:</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_4_pre_2 }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="">. ¿CUÁL ES LA SEÑAL QUE SE DEBE HACER SI SE REQUIERE FRENAR EN BICICLETA?: </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_5_pre_2 }}"
                        readonly>
                </div><br>

                <div class="col-sm-10 center">
                    <table class="table table_striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Pregunta</th>

                                <th scope="col">
                                    <center>V</center>
                                </th>

                                <th scope="col">
                                    <center>F</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <center>CON LA BICICLETA SE DEBE TRANSITAR POR LAS CICLORRUTAS CUANDO LAS HAY; CUANDO NO LAS HAY, SE PUEDE TRANSITAR POR LA CALZADA OCUPANDO UN CARRIL, PREFERIBLEMENTE EL DERECHO. </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_1_pre_2 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_1_pre_2 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <center>EL ESPACIO PÚBLICO CORRESPONDE AL CONJUNTO DE INMUEBLES PÚBLICOS Y LOS ELEMENTOS ARQUITECTÓNICOS Y NATURALES DE LOS INMUEBLES PRIVADOS, DESTINADOS POR SU NATURALEZA, POR SU USO O AFECTACIÓN, A LA SATISFACCIÓN DE NECESIDADES URBANAS COLECTIVAS QUE TRANSCIENDEN, POR TANTO, LOS LÍMITES DE LOS INTERESES, INDIVIDUALES DE LOS HABITANTES.  </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_2_pre_2 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_2_pre_2 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div><br>


                <div class="col-sm-10">
                    <label for="">CALIFICACIÓN </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->calificacion_pre_2 }}"
                        readonly>
                </div>

            </div><br><br>
            <h5>POSTEST NIVEL 2</h5>
            <div class="row">

                <div class="col-sm-6">
                    <label for="">EL CASCO ES DE USO</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_3_post_2 }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="">¿CUÁL ES LA SEÑAL QUE SE DEBE HACER SI SE QUIERE GIRAR A LA DERECHA EN BICICLETA?:</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_4_post_2 }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="">. ¿CUÁL ES LA SEÑAL QUE SE DEBE HACER SI SE REQUIERE FRENAR EN BICICLETA?: </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_5_post_2 }}"
                        readonly>
                </div><br>

                <div class="col-sm-10 center">
                    <table class="table table_striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Pregunta</th>

                                <th scope="col">
                                    <center>V</center>
                                </th>

                                <th scope="col">
                                    <center>F</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <center>CON LA BICICLETA SE DEBE TRANSITAR POR LAS CICLORRUTAS CUANDO LAS HAY; CUANDO NO LAS HAY, SE PUEDE TRANSITAR POR LA CALZADA OCUPANDO UN CARRIL, PREFERIBLEMENTE EL DERECHO. </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_1_post_2 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_1_post_2 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <center>EL ESPACIO PÚBLICO CORRESPONDE AL CONJUNTO DE INMUEBLES PÚBLICOS Y LOS ELEMENTOS ARQUITECTÓNICOS Y NATURALES DE LOS INMUEBLES PRIVADOS, DESTINADOS POR SU NATURALEZA, POR SU USO O AFECTACIÓN, A LA SATISFACCIÓN DE NECESIDADES URBANAS COLECTIVAS QUE TRANSCIENDEN, POR TANTO, LOS LÍMITES DE LOS INTERESES, INDIVIDUALES DE LOS HABITANTES.  </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_2_post_2 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_2_post_2 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div><br>

                <div class="col-sm-10">
                    <label for="">CALIFICACIÓN </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->calificacion_post_2 }}"
                        readonly>
                </div>

            </div><br><br>
            <h5>EVALUACIÓN NIVEL 2</h5>
            <div class="row">
                <div class="col-sm-6">
                    <label for="">EVALUACIÓN DEL TALLER </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->evaluacion_taller_2 }}"
                        readonly>
                </div>
                <div class="col-sm-6">
                    <label for="">IMPORTANCIA DE LA INFORMACIÓN RECIBIDA </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->importancia_informacion_2 }}"
                        readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" id="datos_nivel_3">
    <div class="card-header">
        <h4 class="card-title">TERCER NIVEL  </h4>
    </div>

    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">
            <h5>PRETEST NIVEL 3</h5>
            <div class="row">

                <div class="col-sm-6">
                    <label for="">PARA DISMINUIR EL RIESGO DE NO SER VISIBLE PARA LOS DEMÁS ACTORES VIALES, EL O LA CICLISTA DEBE</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_3_pre_3 }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="">EN LA COTIDIANIDAD DE LA VÍA, SEGÚN LAS NORMAS DE TRÁNSITO, ¿QUIÉN TIENE LA PRIORIDAD? </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_4_pre_3 }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="">. PARA EVITAR LOS PUNTOS CIEGOS, EL O LA CICLISTA PUEDE: </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_5_pre_3 }}"
                        readonly>
                </div><br>

                <div class="col-sm-10 center">
                    <table class="table table_striped mb-0">
                        <thead>

                            <tr>
                                <th scope="col">Pregunta</th>

                                <th scope="col">
                                    <center>V</center>
                                </th>

                                <th scope="col">
                                    <center>F</center>
                                </th>
                            </tr>

                        </thead>
                        <tbody>

                            <tr>
                                <th scope="row">
                                    <center>LOS PUNTOS CIEGOS SON POSICIONES ALREDEDOR DE UN VEHÍCULO QUE NO PUEDEN SER CONTROLADOS VISUALMENTE POR EL CONDUCTOR, Y ESTÁN PRESENTES TANTO EN CARROS COMO EN MOTOCICLETAS </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_1_pre_3 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_1_pre_3 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>PARA CRUZAR UN OBSTÁCULO EN LA VÍA (HUECO, BACHE), EL O LA CICLISTA DEBE PODER: PARARSE EN LOS PEDALES PREVIO AL SUBIR O AL DESCENSO, LLEVAR EL CUERPO HACIA ATRÁS Y LEVANTAR LA RUEDA DELANTERA </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_2_pre_3 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_2_pre_3 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div><br>

                <div class="col-sm-10">
                    <label for="">CALIFICACIÓN </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->calificacion_pre_3 }}"
                        readonly>
                </div>

            </div><br><br>
            <h5>CARTOGRAFÍA SOCIAL</h5>
            <div class="row">
                <div class="col-sm-6">
                    <label for="">¿Para qué utiliza la bicicleta? </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_1_car_3 }}"
                        readonly>
                </div>
                <div class="col-sm-6">
                    <label for="">¿Cuál es el tiempo diario que dura conduciendo bicicleta? </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_2_car_3 }}"
                        readonly>
                </div>
                <div class="col-sm-6">
                    <label for="">¿Cómo considera usted que se encuentra la malla vial por donde transita habitualmente? </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_3_car_3 }}"
                        readonly>
                </div>
                <div class="col-sm-6">
                    <label for="">¿Cuál es el riesgo social más relevante que tiene su trayecto habitual?  </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_4_car_3 }}"
                        readonly>
                </div>
                <div class="col-sm-6">
                    <label for="">¿Cuál es el riesgo ambientale más relevante que tiene su trayecto habitual? </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_5_car_3 }}"
                        readonly>
                </div>
                <div class="col-sm-6">
                    <label for="">¿Cuál es el riesgo tecnológico más relevante que tiene su trayecto habitual? </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_6_car_3 }}"
                        readonly>
                </div>
            </div><br><br>
            <h5>POSTEST NIVEL 3</h5>
            <div class="row">

                <div class="col-sm-6">
                    <label for="">PARA DISMINUIR EL RIESGO DE NO SER VISIBLE PARA LOS DEMÁS ACTORES VIALES, EL O LA CICLISTA DEBE</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_3_post_3 }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="">EN LA COTIDIANIDAD DE LA VÍA, SEGÚN LAS NORMAS DE TRÁNSITO, ¿QUIÉN TIENE LA PRIORIDAD? </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_4_post_3 }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="">. PARA EVITAR LOS PUNTOS CIEGOS, EL O LA CICLISTA PUEDE: </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_5_post_3 }}"
                        readonly>
                </div><br>

                <div class="col-sm-10 center">
                    <table class="table table_striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Pregunta</th>

                                <th scope="col">
                                    <center>V</center>
                                </th>

                                <th scope="col">
                                    <center>F</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <th scope="row">
                                    <center>LOS PUNTOS CIEGOS SON POSICIONES ALREDEDOR DE UN VEHÍCULO QUE NO PUEDEN SER CONTROLADOS VISUALMENTE POR EL CONDUCTOR, Y ESTÁN PRESENTES TANTO EN CARROS COMO EN MOTOCICLETAS </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_1_post_3 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_1_post_3 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>PARA CRUZAR UN OBSTÁCULO EN LA VÍA (HUECO, BACHE), EL O LA CICLISTA DEBE PODER: PARARSE EN LOS PEDALES PREVIO AL SUBIR O AL DESCENSO, LLEVAR EL CUERPO HACIA ATRÁS Y LEVANTAR LA RUEDA DELANTERA </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_2_post_3 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_2_post_3 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div><br>

                <div class="col-sm-10">
                    <label for="">CALIFICACIÓN </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->calificacion_post_3 }}"
                        readonly>
                </div>

            </div><br><br>
            <h5>EVALUACIÓN NIVEL 3</h5>
            <div class="row">
                <div class="col-sm-6">
                    <label for="">EVALUACIÓN DEL TALLER </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->evaluacion_taller_3 }}"
                        readonly>
                </div>
                <div class="col-sm-6">
                    <label for="">IMPORTANCIA DE LA INFORMACIÓN RECIBIDA </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->importancia_informacion_3 }}"
                        readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<div class=" card" id="datos_nivel_4">
    <div class=" card-header">
        <h4 class="card-title">CUARTO NIVEL</h4>
    </div>

    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">
            <h5>PRETEST NIVEL 4</h5>
            <div class="row">
                
                <div class="col-sm-6">
                    <label for="">ES EL SISTEMA QUE PERMITE CONDUCIR LA BICICLETA Y DIRIGIRLA HACIA DONDE SE QUIERE, UTILIZANDO LAS MANOS PARA CONTROLARLA.</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_2_pre_4 }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="">LOS PLATOS Y LOS PIÑONES HACEN PARTE DE ESTE SISTEMA DE LA BICICLETA</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_4_pre_4 }}"
                        readonly>
                </div><br>

                <div class="col-sm-10 ">
                    <table class="table table_striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Pregunta</th>

                                <th scope="col">
                                    <center>V</center>
                                </th>

                                <th scope="col">
                                    <center>F</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <center>ES IMPORTANTE QUE SE COMPRUEBE LOS CIERRES DE LAS RUEDAS, PARA ESO ES NECESARIO ASEGURARSE DE QUE ESTÉN BIEN APRETADOS</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_1_pre_4 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_1_pre_4 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>LA PREPARACIÓN COMPLETA DE LA BICICLETA IMPLICA LA REVISIÓN DE LOS FRENOS Y LAS RUEDAS </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_3_pre_4 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_3_pre_4 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>ANTES DE LUBRICAR LA CADENA NO ES RECOMENDABLE LIMPIARLA, SE APLICA DIRECTAMENTE EL LUBRICANTE DE SU PREFERENCIA, PARA EVITAR MAYORES DESGASTES Y DESAJUSTES  </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_pre_4 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_pre_4 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-8">
                    <label for="">CALIFICACIÓN </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->calificacion_pre_1 }}"
                        readonly>
                </div>

            </div><br><br>

            <h5>POSTEST NIVEL 4</h5>
            <div class="row">
                <div class="col-sm-6">
                    <label for="">¿LA BICICLETA ES?</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_1_post_1 }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="">¿.USTED COMO CICLISTA ES?</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->pregunta_2_post_1 }}"
                        readonly>
                </div><br>

                <div class="col-sm-10 center">
                    <table class="table table_striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Pregunta</th>

                                <th scope="col">
                                    <center>V</center>
                                </th>

                                <th scope="col">
                                    <center>F</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <center>LOS CICLISTAS NO DEBEN ADELANTAR A OTROS VEHÍCULOS POR LA  DERECHA O ENTRE VEHÍCULOS QUE TRANSITEN POR SUS RESPECTIVOS CARRILES</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_3_post_1 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_3_post_1 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <center>COMO NORMA DE TRÁNSITO, LOS CICLISTAS DEBEN TRANSITAR POR EL LADO DERECHO DE LA VÍA, A UN METRO Y MEDIO AL LADO DE LOS VEHÍCULOS. </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_post_1 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_post_1 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <center>AL SUBIRSE A LA BICICLETA DEBE MANTENER LAS MANOS EN EL MANILLAR, CON DOS O TRES DEDOS EN LOS FRENOS Y AL ARRANCAR DEBE SOSTENERSE CON UN PIE EN EL SUELO Y CON EL OTRO PUESTO EN EL PEDAL.  </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_post_1 == 'VERDADERO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pregunta_4_post_1 == 'FALSO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div><br>

                <div class="col-sm-8">
                    <label for="">CALIFICACIÓN </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->calificacion_post_1 }}"
                        readonly>
                </div>
            </div><br><br>

            <h5>EVALUACIÓN NIVEL 4</h5>
            <div class="row">
                <div class="col-sm-6">
                    <label for="">EVALUACIÓN DEL TALLER </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->evaluacion_taller_4 }}"
                        readonly>
                </div>
                <div class="col-sm-6">
                    <label for="">IMPORTANCIA DE LA INFORMACIÓN RECIBIDA </label>

                    <input class="form-control" type="text" value="{{ $registro[0]->importancia_informacion_4 }}"
                        readonly>
                </div>
            </div>

        </div>
    </div>
</div>












