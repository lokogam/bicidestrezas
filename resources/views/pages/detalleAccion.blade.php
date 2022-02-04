<div class="card" id="datos_registro">
    <div class="card-header">
        <h4 class="card-title">DATOS PRINCIPALES</h4>
    </div>

    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <label for="fecha">Fecha</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->fecha_registro }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="hora_inicio">Hora Inicio</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->hora_inicio }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="hora_finalizacion">Hora Finalización</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->hora_finalizacion }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="ubicacion_punto">Ubicación del punto</label>

                    <input class="form-control" type="text"
                        value="{{ $registro[0]->nombre_punto }} - {{ $registro[0]->ubicacion }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="encargado">Encargado</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->user_name }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" id="datos_bicicleta">
    <div class="card-header">
        <h4 class="card-title">CARGUE DE ARCHIVOS</h4>
    </div>

    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="foto"><b>Foto</b></label>

                        @if ($registro[0]->foto == '')
                            <center>
                                <h4>NO HAY IMAGEN DISPONIBLE</h4>
                            </center>
                        @else
                            <center>
                                <img style="width: 200px; heigth: 200px; border-radius: 8px;" src="{{ URL::to('bicicletas/' . $registro[0]->foto) }}">
                            </center>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="video"><b>Video</b></label>

                        @if ($registro[0]->video == '')
                            <center>
                                <h4>NO HAY VIDEO DISPONIBLE</h4>
                            </center>
                        @else
                            <center>
                                <video style="width: 200px; heigth: 200px;" src="{{ URL::to('videos/' . $registro[0]->video) }}" controls>
                            </center>
                        @endif
                    </div>
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
                    <label for="numero_documento">Cédula de ciudadanía</label>

                    <input class="form-control" type="number" value="{{ $registro[0]->numero_documento }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="numero_contacto">Número de celular</label>

                    <input class="form-control" type="number" value="{{ $registro[0]->numero_contacto }}" readonly>
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

                <div class="col-sm-6">
                    <label for="anos_experiencia">
                        Años de experiencia montando bicicleta
                    </label>

                    <input class="form-control" type="number" value="{{ $registro[0]->anos_experiencia }}"
                        readonly>
                </div>


                <div class="col-sm-6">
                    <label for="tiempo_uso">Tiempo de uso de la bicicleta al día (en minutos)</label>

                    <input class="form-control" type="number" value="{{ $registro[0]->tiempo_uso }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" id="datos_recorrido">
    <div class="card-header">
        <h4 class="card-title">DATOS SOBRE EL RECORRIDO</h4>
    </div>

    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <label for="tipo_viaje">Tipo de viaje</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->tipo_viaje }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="sitios_accidentes">
                        Sitios de accidentalidad identificados por el ciclista (procurar identificar
                        dirección)
                    </label>

                    <textarea class="form-control" readonly>{{ $registro[0]->sitios_accidentes }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" id="datos_reto">
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
                                        <input type="radio"
                                            {{ $registro[0]->subida_perdida_control == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->subida_perdida_control == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->subida_perdida_control == 'NA' ? 'checked' : 'disabled' }}>
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
                                        <input type="radio"
                                            {{ $registro[0]->dedos_frenos == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->dedos_frenos == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->dedos_frenos == 'NA' ? 'checked' : 'disabled' }}>
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
                                        <input type="radio"
                                            {{ $registro[0]->pie_suelo_otro_pedal == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pie_suelo_otro_pedal == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pie_suelo_otro_pedal == 'NA' ? 'checked' : 'disabled' }}>
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
                                        <input type="radio"
                                            {{ $registro[0]->empuje_equilibrio == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->empuje_equilibrio == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->empuje_equilibrio == 'NA' ? 'checked' : 'disabled' }}>
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
                                        <input type="radio"
                                            {{ $registro[0]->levantar_mano_perdida_control == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->levantar_mano_perdida_control == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->levantar_mano_perdida_control == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>6. Conoce las señales manuales.</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->conoce_senales_manuales == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->conoce_senales_manuales == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->conoce_senales_manuales == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>7. Al frenar no derrapa (bloquea) las ruedas.</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->derrapa_frenado == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->derrapa_frenado == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->derrapa_frenado == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>8. Posiciona el cuerpo hacia atrás cuando frena.</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->posicion_cuerpo_frenado == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->posicion_cuerpo_frenado == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->posicion_cuerpo_frenado == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>9. Es capaz de mirar hacia atrás.</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->mira_atras == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->mira_atras == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->mira_atras == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>10. Mantiene el equilibrio al mirar hacia atrás.</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->equilibrio_mira_atras == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->equilibrio_mira_atras == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->equilibrio_mira_atras == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>11. Tiene como punto de referencia el hombro izquierdo.</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->hombro_referencia == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->hombro_referencia == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->hombro_referencia == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>12. Proyecta la mirada al frente.</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->mirada_frente == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->mirada_frente == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->mirada_frente == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>13. Mantiene el equilibrio.</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->mantiene_equilibrio == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->mantiene_equilibrio == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->mantiene_equilibrio == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>14. Pararse en pedales previo al subir o al descenso.</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pararse_pedales == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pararse_pedales == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->pararse_pedales == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>15. Llevar el cuerpo hacia atrás.</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->cuerpo_atras == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->cuerpo_atras == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->cuerpo_atras == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>16. Levantar la rueda delantera.</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->levantar_rueda_delantera == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->levantar_rueda_delantera == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->levantar_rueda_delantera == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>17. Mantiene el cuerpo centrado en la bicicleta </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->cuerpo_centrado == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->cuerpo_centrado == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->cuerpo_centrado == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>18. Apoya la media punta del pie en los pedales </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->apoyo_punta_pedales == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->apoyo_punta_pedales == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->apoyo_punta_pedales == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>19. La bicicleta se ajusta a la altura del ciclista.</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->ajusta_altura_ciclista == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->ajusta_altura_ciclista == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->ajusta_altura_ciclista == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            
            <div class="row">
                <div class="col-sm-6">
                    <label for="calificacion_reto">Calificación del reto</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->calificacion_reto }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" id="datos_documentacion">
    <div class="card-header">
        <h4 class="card-title">DATOS DE LA REVISIÓN DOCUMENTAL</h4>
    </div>

    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <label for="tarjeta_propiedad">Tarjeta de propiedad</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->tarjeta_propiedad }}"
                        readonly>
                </div>

                <div class="col-sm-6">
                    <label for="marcacion">Marcación</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->marcacion }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" id="datos_epp">
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
                                        <input type="radio"
                                            {{ $registro[0]->uso_casco == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_casco == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_casco == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Uso cintas reflectivas</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_cinta_reflectiva == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_cinta_reflectiva == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_cinta_reflectiva == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Uso de luz proyectiva delantera</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_luz_delantera == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_luz_delantera == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_luz_delantera == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Uso de luz reflectora trasera</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_luz_trasera == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_luz_trasera == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_luz_trasera == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Uso de muñequeras</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_munequeras == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_munequeras == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_munequeras == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Uso de rodilleras</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_rodilleras == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_rodilleras == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_rodilleras == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Uso de gafas</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_gafas == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_gafas == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_gafas == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Uso de pito</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_pito == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_pito == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_pito == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Uso de guantes</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_guantes == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_guantes == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio"
                                            {{ $registro[0]->uso_guantes == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card" id="datos_revision">
    <div class="card-header">
        <h4 class="card-title">DATOS DE LA REVISIÓN DE LA BICICLETA</h4>
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
                                    <center>No rota, ni se desliza hacia arriba</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="sillin_rota_desliza"
                                            {{ $registro[0]->sillin_rota_desliza == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="sillin_rota_desliza"
                                            {{ $registro[0]->sillin_rota_desliza == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="sillin_rota_desliza"
                                            {{ $registro[0]->sillin_rota_desliza == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>No está roto, ni fisurado</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="sillin_roto_fisura"
                                            {{ $registro[0]->sillin_roto_fisura == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="sillin_roto_fisura"
                                            {{ $registro[0]->sillin_roto_fisura == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="sillin_roto_fisura"
                                            {{ $registro[0]->sillin_roto_fisura == 'NA' ? 'checked' : 'disabled' }}>
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
                                        <input type="radio" name="sillin_altura_cadera"
                                            {{ $registro[0]->sillin_altura_cadera == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="sillin_altura_cadera"
                                            {{ $registro[0]->sillin_altura_cadera == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="sillin_altura_cadera"
                                            {{ $registro[0]->sillin_altura_cadera == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>El poste no está roto</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="poste_roto"
                                            {{ $registro[0]->poste_roto == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="poste_roto"
                                            {{ $registro[0]->poste_roto == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="poste_roto"
                                            {{ $registro[0]->poste_roto == 'NA' ? 'checked' : 'disabled' }}>
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
                                        <input type="radio" name="frenos_componentes_completos"
                                            {{ $registro[0]->frenos_componentes_completos == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="frenos_componentes_completos"
                                            {{ $registro[0]->frenos_componentes_completos == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="frenos_componentes_completos"
                                            {{ $registro[0]->frenos_componentes_completos == 'NA' ? 'checked' : 'disabled' }}>
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
                                        <input type="radio" name="frenos_desgastados"
                                            {{ $registro[0]->frenos_desgastados == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="frenos_desgastados"
                                            {{ $registro[0]->frenos_desgastados == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="frenos_desgastados"
                                            {{ $registro[0]->frenos_desgastados == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Los frenos no están calibrados o largos</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="frenos_calibrados"
                                            {{ $registro[0]->frenos_calibrados == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="frenos_calibrados"
                                            {{ $registro[0]->frenos_calibrados == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="frenos_calibrados"
                                            {{ $registro[0]->frenos_calibrados == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>No está rota, fisurada o doblada</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="cadena_rota_fisurada"
                                            {{ $registro[0]->cadena_rota_fisurada == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="cadena_rota_fisurada"
                                            {{ $registro[0]->cadena_rota_fisurada == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="cadena_rota_fisurada"
                                            {{ $registro[0]->cadena_rota_fisurada == 'NA' ? 'checked' : 'disabled' }}>
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
                                        <input type="radio" name="cadena_lubricacion"
                                            {{ $registro[0]->cadena_lubricacion == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="cadena_lubricacion"
                                            {{ $registro[0]->cadena_lubricacion == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="cadena_lubricacion"
                                            {{ $registro[0]->cadena_lubricacion == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Los eslabones no están desgastados</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="cadena_desgaste"
                                            {{ $registro[0]->cadena_desgaste == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="cadena_desgaste"
                                            {{ $registro[0]->cadena_desgaste == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="cadena_desgaste"
                                            {{ $registro[0]->cadena_desgaste == 'NA' ? 'checked' : 'disabled' }}>
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
                                        <input type="radio" name="roturas_platos_pinones"
                                            {{ $registro[0]->roturas_platos_pinones == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="roturas_platos_pinones"
                                            {{ $registro[0]->roturas_platos_pinones == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="roturas_platos_pinones"
                                            {{ $registro[0]->roturas_platos_pinones == 'NA' ? 'checked' : 'disabled' }}>
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
                                        <input type="radio" name="roturas_bielas_pedales_centro"
                                            {{ $registro[0]->roturas_bielas_pedales_centro == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="roturas_bielas_pedales_centro"
                                            {{ $registro[0]->roturas_bielas_pedales_centro == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="roturas_bielas_pedales_centro"
                                            {{ $registro[0]->roturas_bielas_pedales_centro == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Se hacen los cambios</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="hace_cambios"
                                            {{ $registro[0]->hace_cambios == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="hace_cambios"
                                            {{ $registro[0]->hace_cambios == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="hace_cambios"
                                            {{ $registro[0]->hace_cambios == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Sentido de rotación adecuado</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="llantas_sentido_rotacion"
                                            {{ $registro[0]->llantas_sentido_rotacion == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="llantas_sentido_rotacion"
                                            {{ $registro[0]->llantas_sentido_rotacion == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="llantas_sentido_rotacion"
                                            {{ $registro[0]->llantas_sentido_rotacion == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Sin fisuras, huevos, la guía no se encuentra expuesta.</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="llantas_fisuradas"
                                            {{ $registro[0]->llantas_fisuradas == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="llantas_fisuradas"
                                            {{ $registro[0]->llantas_fisuradas == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="llantas_fisuradas"
                                            {{ $registro[0]->llantas_fisuradas == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Presión acorde a lo establecido en la coraza,</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="llantas_presion"
                                            {{ $registro[0]->llantas_presion == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="llantas_presion"
                                            {{ $registro[0]->llantas_presion == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="llantas_presion"
                                            {{ $registro[0]->llantas_presion == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Radios están completos, no rotos o doblados</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="radios_rotos"
                                            {{ $registro[0]->radios_rotos == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="radios_rotos"
                                            {{ $registro[0]->radios_rotos == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="radios_rotos"
                                            {{ $registro[0]->radios_rotos == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Ajuste y alineación de la llanta </center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="llantas_alineacion"
                                            {{ $registro[0]->llantas_alineacion == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="llantas_alineacion"
                                            {{ $registro[0]->llantas_alineacion == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="llantas_alineacion"
                                            {{ $registro[0]->llantas_alineacion == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Rin se encuentra sin fisuras, desgastados, doblados</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="rin_fisurado"
                                            {{ $registro[0]->rin_fisurado == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="rin_fisurado"
                                            {{ $registro[0]->rin_fisurado == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="rin_fisurado"
                                            {{ $registro[0]->rin_fisurado == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Gira sin fricción o resistencia</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="direccion_gira"
                                            {{ $registro[0]->direccion_gira == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="direccion_gira"
                                            {{ $registro[0]->direccion_gira == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="direccion_gira"
                                            {{ $registro[0]->direccion_gira == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Rodamientos sin juego</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="direccion_rodamientos_juego"
                                            {{ $registro[0]->direccion_rodamientos_juego == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="direccion_rodamientos_juego"
                                            {{ $registro[0]->direccion_rodamientos_juego == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="direccion_rodamientos_juego"
                                            {{ $registro[0]->direccion_rodamientos_juego == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <center>Manillar centrado y debidamente ajustado</center>
                                </th>

                                <td>
                                    <center>
                                        <input type="radio" name="manillar_centrado"
                                            {{ $registro[0]->manillar_centrado == 'SI' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="manillar_centrado"
                                            {{ $registro[0]->manillar_centrado == 'NO' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <input type="radio" name="manillar_centrado"
                                            {{ $registro[0]->manillar_centrado == 'NA' ? 'checked' : 'disabled' }}>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-6">
                    <label for="calificacion_revision">Calificación de la revisión mecánica</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->calificacion_revision }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="card" id="datos_evaluacion">
    <div class="card-header">
        <h4 class="card-title">EVALUACIÓN DEL TALLER</h4>
    </div>

    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <label for="evaluacion_taller">Evaluación del taller de 1 a 5.</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->evaluacion_taller }}" readonly>
                </div>

                <div class="col-sm-6">
                    <label for="importancia_informacion">Importancia de la información recibida de 1 a 5.</label>

                    <input class="form-control" type="text" value="{{ $registro[0]->importancia_informacion }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div> --}}
