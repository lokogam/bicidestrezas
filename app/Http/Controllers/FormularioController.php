<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use FPDF;
use PDF;

class FormularioController extends Controller
{
	public function pruebamail()
	{
		$fromEmail = "sgi@indoamericana.edu.co";
		$fromName = "Indoamericana";

		$email = "jdavid-1016@hotmail.com";

		$data = array(
			'nombre' => "Jose David Betancur Carmona",
			'email' => "jdavid-1016@hotmail.com",
			'password' => "1013644093"
		);

		Mail::send('emails.message-received', $data, function ($message) use ($fromName, $fromEmail, $email) {
			$message->subject('Felicitaciones, se ha inscrito con éxito al curso');
			$message->to("jbetancur@indoamericana.edu.co");
			$message->from($fromEmail, $fromName);
		});
	}

	public function formularioMantenimiento()
	{
		return view('/pages/mantenimiento');
	}


	//funcion para calcular el tiempo transcurrido de los soportes
	public function interval_date($init, $finish)
	{
		//formateamos las fechas a segundos tipo 1374998435
		$diferencia = strtotime($finish) - strtotime($init);
		$tiempo = $diferencia / 60;

		return $tiempo;
	}

	public function validar_documento($cons_documento, $tipo)
	{
		if ($tipo == 1){
			$cons_documento_acciones = DB::table('registros_acciones')
				->join("ciclistas", "ciclistas.id_registro", "=", "registros_acciones.id")
				->where('ciclistas.numero_documento', $cons_documento)
				->orderBy("registros_acciones.id", "DESC")
				->get();
	
			if (count($cons_documento_acciones) > 0) {
				$ultima_revision = date('Y-m-d', strtotime($cons_documento_acciones[0]->fecha));
				$fecha_actual    = date('Y-m-d');
	
				$fecha1 = date_create($ultima_revision);
				$fecha2 = date_create($fecha_actual);
				$dias   = date_diff($fecha1, $fecha2)->format('%a');
			} else {
				$dias = "No";
			}
		}else if ($tipo == 2){
			$cons_documento_formacion = DB::table('registros_formacion')
				->where('numero_documento', $cons_documento)
				->orderBy("id", "DESC")
				->get();
	
			if (count($cons_documento_formacion) > 0) {
				$ultima_revision = date('Y-m-d', strtotime($cons_documento_formacion[0]->fecha));
				$fecha_actual    = date('Y-m-d');
	
				$fecha1 = date_create($ultima_revision);
				$fecha2 = date_create($fecha_actual);
				$dias   = date_diff($fecha1, $fecha2)->format('%a');
			} else {
				$dias = "No";
			}
		}

		return $dias;
	}

	public function optimizar_imagen($origen, $destino, $calidad)
	{
		$info = getimagesize($origen);

		if ($info['mime'] == 'image/jpeg') {
			$imagen = imagecreatefromjpeg($origen);
		} else if ($info['mime'] == 'image/gif') {
			$imagen = imagecreatefromgif($origen);
		} else if ($info['mime'] == 'image/png') {
			$imagen = imagecreatefrompng($origen);
		}

		imagejpeg($imagen, $destino, $calidad);
	}


	//Funciones formulario acciones en vía
	public function formularioAcciones()
	{
		$puntos = DB::table('puntos')->orderby('nombre_punto', 'asc')->get();

		$usuario_punto = DB::table('puntos_users')->where('users_id', Auth::id())->count();

		$punto = DB::table('puntos')
			->leftjoin('puntos_users', 'puntos_users.puntos_id', '=', 'puntos.id')
			->where('puntos_users.users_id', Auth::id())
			->select('puntos.*')
			->get();

		return view('/formularioAcciones/ver_punto', [
			'puntos'        => $puntos,
			'usuario_punto' => $usuario_punto,
			'punto' 		=> $punto
		]);
	}

	public function consultarAcciones(Request $request)
	{
		$dias_documento = $this->validar_documento($request->input('numero_documento'),1);

		$numero_documento = $request->input('numero_documento');

		$registro = DB::table('registros_acciones')
			->join("ciclistas", "ciclistas.id_registro", "=", "registros_acciones.id")
			->where('ciclistas.numero_documento', $numero_documento)
			->get();

		$puntos = DB::table('puntos')->get();

		$encargados = DB::table('users')
			->join('role_user', 'role_user.user_id', '=', 'users.id')
			->join('roles', 'roles.id', '=', 'role_user.role_id')
			->leftjoin('puntos_users', 'users.id', '=', 'puntos_users.users_id')
			->leftjoin('puntos', 'puntos_users.puntos_id', '=', 'puntos.id')
			->where('role_user.role_id', '=', 2)
			->select('users.name', 'users.documento', 'users.id')
			->get();

		return view('/formularioAcciones/ver_formulario', [
			'registro'              => $registro,
			'numero_documento'      => $numero_documento,
			'puntos'                => $puntos,
			'encargados'            => $encargados,
			'dias_documento'        => $dias_documento,
			'save'                  => 0
		]);
	}

	public function guardarFormularioAcciones(Request $request)
	{
		$existe = DB::table('registros_acciones')
			->join("ciclistas", "ciclistas.id_registro", "=", "registros_acciones.id")
			->where('ciclistas.numero_documento', $request->input('numero_documento'))
			->get();

		if (count($existe) == 0) {
			$hora_inicio = date('H:i:s', strtotime($request->input('fecha_inicio')));

			$hora_finalizacion = date('H:i:s');

			$img      = $request->input('base64');
			$img      = str_replace('data:image/png;base64,', '', $img);
			$fileData = base64_decode($img);
			$fileName = 'acciones_' . $request->input('numero_documento') . '.png';

			file_put_contents('firmas/' . $fileName, $fileData);

			$usuario_punto = DB::table('puntos_users')->where('users_id', Auth::id())->get();

			DB::table('registros_acciones')->insert(array(array(
				'firma'					   => $fileName,
				'users_id'                 => Auth::id(),
				'fecha'                    => $request->input('fecha'),
				'jornada'                  => $request->input('jornada'),
				'hora_inicio'              => $hora_inicio,
				'hora_finalizacion'        => $hora_finalizacion,
				'id_punto'                 => $usuario_punto[0]->puntos_id,
				'encargado'                => $request->input('encargado'),
				'recomendaciones'          => $request->input('recomendaciones')
			)));

			$id_registro = DB::table('registros_acciones')
				->max('registros_acciones.id');

			DB::table('ciclistas')->insert(array(array(
				'id_registro'   	   => $id_registro,
				'nombre'               => $request->input('nombre'),
				'numero_documento'     => $request->input('numero_documento'),
				'numero_contacto'      => $request->input('numero_contacto'),
				'correo'               => $request->input('correo'),
				'edad' 				   => $request->input('edad'),
				'sexo' 				   => $request->input('sexo'),
				'genero' 			   => $request->input('genero'),
				'nivel_escolaridad'    => $request->input('nivel_escolaridad'),
				'poblacion_vulnerable' => $request->input('poblacion_vulnerable'),
				'anos_experiencia'     => $request->input('anos_experiencia'),
				'tiempo_uso'     	   => $request->input('tiempo_uso'),
				'temperatura_inicio'   => $request->input('temperatura_inicio'),
			)));

			DB::table('recorridos_documentacion')->insert(array(array(
				'id_registro' 		 => $id_registro,
				'tipo_viaje'         => $request->input('tipo_viaje'),
				'sitios_accidentes'  => $request->input('sitios_accidentes'),
				'tarjeta_propiedad'  => $request->input('tarjeta_propiedad'),
				'marcacion'          => $request->input('marcacion'),
			)));

			$subida_perdida_control        = $request->input('subida_perdida_control');
			$dedos_frenos      			   = $request->input('dedos_frenos');
			$pie_suelo_otro_pedal      	   = $request->input('pie_suelo_otro_pedal');
			$empuje_equilibrio      	   = $request->input('empuje_equilibrio');
			$levantar_mano_perdida_control = $request->input('levantar_mano_perdida_control');
			$conoce_senales_manuales       = $request->input('conoce_senales_manuales');
			$derrapa_frenado      		   = $request->input('derrapa_frenado');
			$posicion_cuerpo_frenado       = $request->input('posicion_cuerpo_frenado');
			$mira_atras      			   = $request->input('mira_atras');
			$equilibrio_mira_atras         = $request->input('equilibrio_mira_atras');
			$hombro_referencia      	   = $request->input('hombro_referencia');
			$mirada_frente      		   = $request->input('mirada_frente');
			$mantiene_equilibrio   		   = $request->input('mantiene_equilibrio');
			$pararse_pedales      		   = $request->input('pararse_pedales');
			$cuerpo_atras      		       = $request->input('cuerpo_atras');
			$levantar_rueda_delantera      = $request->input('levantar_rueda_delantera');
			$cuerpo_centrado      		   = $request->input('cuerpo_centrado');
			$apoyo_punta_pedales      	   = $request->input('apoyo_punta_pedales');
			$ajusta_altura_ciclista        = $request->input('ajusta_altura_ciclista');

			$resultados = [
				$subida_perdida_control,
				$dedos_frenos,
				$pie_suelo_otro_pedal,
				$empuje_equilibrio,
				$levantar_mano_perdida_control,
				$conoce_senales_manuales,
				$derrapa_frenado,
				$posicion_cuerpo_frenado,
				$mira_atras,
				$equilibrio_mira_atras,
				$hombro_referencia,
				$mirada_frente,
				$mantiene_equilibrio,
				$pararse_pedales,
				$cuerpo_atras,
				$levantar_rueda_delantera,
				$cuerpo_centrado,
				$apoyo_punta_pedales,
				$ajusta_altura_ciclista
			];

			$total = array_count_values($resultados);

			$calificacion_reto = '';

			if (in_array('SI', $resultados)) {
				if ($total['SI'] >= 15) {
					$calificacion_reto = 'EXPERTO';
				} elseif ($total['SI'] >= 8 && $total['SI'] <= 14) {
					$calificacion_reto = 'PRINCIPIANTE';
				} elseif ($total['SI'] <= 7) {
					$calificacion_reto = 'NOVATO';
				}
			} else {
				$calificacion_reto = 'NOVATO';
			}

			DB::table('resultados_retos')->insert(array(array(
				'id_registro'         			=> $id_registro,
				'subida_perdida_control'      	=> $subida_perdida_control,
				'dedos_frenos'      			=> $dedos_frenos,
				'pie_suelo_otro_pedal'      	=> $pie_suelo_otro_pedal,
				'empuje_equilibrio'      		=> $empuje_equilibrio,
				'levantar_mano_perdida_control' => $levantar_mano_perdida_control,
				'conoce_senales_manuales'      	=> $conoce_senales_manuales,
				'derrapa_frenado'      			=> $derrapa_frenado,
				'posicion_cuerpo_frenado'      	=> $posicion_cuerpo_frenado,
				'mira_atras'      				=> $mira_atras,
				'equilibrio_mira_atras'      	=> $equilibrio_mira_atras,
				'hombro_referencia'      		=> $hombro_referencia,
				'mirada_frente'      			=> $mirada_frente,
				'mantiene_equilibrio'      		=> $mantiene_equilibrio,
				'pararse_pedales'      			=> $pararse_pedales,
				'cuerpo_atras'      			=> $cuerpo_atras,
				'levantar_rueda_delantera'      => $levantar_rueda_delantera,
				'cuerpo_centrado'      			=> $cuerpo_centrado,
				'apoyo_punta_pedales'      		=> $apoyo_punta_pedales,
				'ajusta_altura_ciclista'      	=> $ajusta_altura_ciclista,
				'calificacion_reto'      		=> $calificacion_reto,
			)));

			DB::table('epps')->insert(array(array(
				'id_registro'   	   => $id_registro,
				'uso_casco'            => $request->input('uso_casco'),
				'uso_cinta_reflectiva' => $request->input('uso_cinta_reflectiva'),
				'uso_luz_delantera'    => $request->input('uso_luz_delantera'),
				'uso_luz_trasera'      => $request->input('uso_luz_trasera'),
				'uso_munequeras'       => $request->input('uso_munequeras'),
				'uso_rodilleras'       => $request->input('uso_rodilleras'),
				'uso_gafas'       	   => $request->input('uso_gafas'),
				'uso_pito'       	   => $request->input('uso_pito'),
				'uso_guantes'          => $request->input('uso_guantes'),
			)));

			if ($request->input('acepta_revision') == 'SI') {
				$sillin_rota_desliza      	    = $request->input('sillin_rota_desliza');
				$sillin_rota_desliza      	    = $request->input('sillin_rota_desliza');
				$sillin_roto_fisura      	    = $request->input('sillin_roto_fisura');
				$sillin_altura_cadera           = $request->input('sillin_altura_cadera');
				$poste_roto      			    = $request->input('poste_roto');
				$frenos_componentes_completos	= $request->input('frenos_componentes_completos');
				$frenos_desgastados      	    = $request->input('frenos_desgastados');
				$frenos_calibrados      	    = $request->input('frenos_calibrados');
				$cadena_rota_fisurada           = $request->input('cadena_rota_fisurada');
				$cadena_lubricacion      	    = $request->input('cadena_lubricacion');
				$cadena_desgaste      	   	    = $request->input('cadena_desgaste');
				$roturas_platos_pinones         = $request->input('roturas_platos_pinones');
				$roturas_bielas_pedales_centro  = $request->input('roturas_bielas_pedales_centro');
				$hace_cambios      	   		 	= $request->input('hace_cambios');
				$llantas_sentido_rotacion 	    = $request->input('llantas_sentido_rotacion');
				$llantas_fisuradas      	    = $request->input('llantas_fisuradas');
				$llantas_presion      	   		= $request->input('llantas_presion');
				$radios_rotos      	   		 	= $request->input('radios_rotos');
				$llantas_alineacion      	    = $request->input('llantas_alineacion');
				$rin_fisurado      	   		 	= $request->input('rin_fisurado');
				$direccion_gira      	   		= $request->input('direccion_gira');
				$direccion_rodamientos_juego    = $request->input('direccion_rodamientos_juego');
				$manillar_centrado      	    = $request->input('manillar_centrado');

				$revision = [
					$sillin_rota_desliza,
					$sillin_rota_desliza,
					$sillin_roto_fisura,
					$sillin_altura_cadera,
					$poste_roto,
					$frenos_componentes_completos,
					$frenos_desgastados,
					$frenos_calibrados,
					$cadena_rota_fisurada,
					$cadena_lubricacion,
					$cadena_desgaste,
					$roturas_platos_pinones,
					$roturas_bielas_pedales_centro,
					$hace_cambios,
					$llantas_sentido_rotacion,
					$llantas_fisuradas,
					$llantas_presion,
					$radios_rotos,
					$llantas_alineacion,
					$rin_fisurado,
					$direccion_gira,
					$direccion_rodamientos_juego,
					$manillar_centrado
				];

				$total = array_count_values($revision);

				$calificacion_revision = '';

				if (in_array('SI', $revision)) {
					if ($total['SI'] >= 17) {
						$calificacion_revision = 'BUENO';
					} elseif ($total['SI'] >= 12 && $total['SI'] <= 16) {
						$calificacion_revision = 'REGULAR';
					} elseif ($total['SI'] <= 11) {
						$calificacion_revision = 'MALO';
					}
				} else {
					$calificacion_revision = 'MALO';
				}

				DB::table('revisiones_mecanicas')->insert(array(array(
					'id_registro'			 		 => $id_registro,
					'sillin_rota_desliza'      	     => $sillin_rota_desliza,
					'sillin_rota_desliza'      	     => $sillin_rota_desliza,
					'sillin_roto_fisura'      	     => $sillin_roto_fisura,
					'sillin_altura_cadera'           => $sillin_altura_cadera,
					'poste_roto'      			     => $poste_roto,
					'frenos_componentes_completos'   => $frenos_componentes_completos,
					'frenos_desgastados'      	     => $frenos_desgastados,
					'frenos_calibrados'      	     => $frenos_calibrados,
					'cadena_rota_fisurada'           => $cadena_rota_fisurada,
					'cadena_lubricacion'      	     => $cadena_lubricacion,
					'cadena_desgaste'      	   	     => $cadena_desgaste,
					'roturas_platos_pinones'         => $roturas_platos_pinones,
					'roturas_bielas_pedales_centro'  => $roturas_bielas_pedales_centro,
					'hace_cambios'      	   		 => $hace_cambios,
					'llantas_sentido_rotacion' 	     => $llantas_sentido_rotacion,
					'llantas_fisuradas'      	     => $llantas_fisuradas,
					'llantas_presion'      	   		 => $llantas_presion,
					'radios_rotos'      	   		 => $radios_rotos,
					'llantas_alineacion'      	     => $llantas_alineacion,
					'rin_fisurado'      	   		 => $rin_fisurado,
					'direccion_gira'      	   		 => $direccion_gira,
					'direccion_rodamientos_juego'    => $direccion_rodamientos_juego,
					'manillar_centrado'      	     => $manillar_centrado,
					'calificacion_revision'          => $calificacion_revision,
				)));
			} else {
				$calificacion_revision = 'NO SE REALIZO REVISIÓN';
			}

			return redirect('formulario/acciones')
				->with('status', 1)
				->with('calificacion_reto', $calificacion_reto)
				->with('calificacion_revision', $calificacion_revision);
		}else {
			return redirect('formulario/acciones')
				->with('existe')
				->with('documento', $request->input('numero_documento'));
		}
	}

	public function guardarArchivos(Request $request)
	{
		$datos = DB::table('registros_acciones')
			->join('ciclistas', 'ciclistas.id_registro', 'registros_acciones.id')
			->join('puntos', 'puntos.id', 'registros_acciones.id_punto')
			->where('registros_acciones.id', $request->input('id_registro'))
			->get();

		$fecha_nueva = date('ymd', strtotime($datos[0]->fecha)); 

		if ($request->file('foto') != '') {
			$destinationPath = 'bicicletas/';
			$file          = $request->file('foto')->getClientOriginalName();
			$extension     = pathinfo($file, PATHINFO_EXTENSION);

			$filename      = $fecha_nueva.' F '.strtoupper($datos[0]->nombre_punto).' AV_'.$datos[0]->numero_documento.'.'.$extension;
			$nuevonombre = $fecha_nueva.' F '.strtoupper($datos[0]->nombre_punto).' AV_'.$datos[0]->numero_documento.'.jpg';

			$uploadSuccess = $request->file('foto')->move($destinationPath, $filename);

			if ($uploadSuccess) {
				$imagen = $this->optimizar_imagen($destinationPath . $filename, $destinationPath . $nuevonombre, 20);
			}

			DB::table('registros_acciones')->where('id', $request->input('id_registro'))->update(array(
				'foto' => $nuevonombre
			));
		}

		if ($request->file('file_video') != '') {
			$maxsize = 100242880; // 3MB

			$destinationPath = "videos/";
			$file = $request->file('file_video')->getClientOriginalName();
			$extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

			$filename = $fecha_nueva.' V '.strtoupper($datos[0]->nombre_punto)." AV_".$datos[0]->numero_documento.".".$extension;

			$extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");

			if (in_array($extension, $extensions_arr)) {
				if (($request->file('file_video')->getSize() >= $maxsize) || ($request->file('file_video')->getSize() == 0)) {
					echo "Archivo demasiado grande. El archivo debe ser menor que 3MB.";
				} else {
					if ($request->file('file_video')->move($destinationPath, $filename)) {
						DB::table('videos')->insert(array(array(
							'id_punto' 		  			=> $datos[0]->id_punto,
							'numero_documento_ciclista' => $datos[0]->numero_documento,
							'fecha' 		 			=> $datos[0]->fecha,
							'video' 		  			=> $filename
						)));
					}
				}
			} else {
				echo "La extension del archivo es invalido.";
			}
		}

		return redirect('admin/acciones');
	}


	//Funciones formulario formación completa
	public function formularioFormacion()
	{
		$puntos = DB::table('puntos')->orderby('nombre_punto', 'asc')->get();

		$usuario_punto = DB::table('puntos_users')->where('users_id', Auth::id())->count();

		$punto = DB::table('puntos')
			->leftjoin('puntos_users', 'puntos_users.puntos_id', '=', 'puntos.id')
			->where('puntos_users.users_id', Auth::id())
			->select('puntos.*')
			->get();

		return view('/formularioFormacion/ver_punto', [
			'puntos'        => $puntos,
			'usuario_punto' => $usuario_punto,
			'punto' 		=> $punto
		]);
	}

	public function consultarFormacion(Request $request)
	{
		$dias_documento = $this->validar_documento($request->input('numero_documento'),2);

		$numero_documento = $request->input('numero_documento');

		$registro = DB::table('registros_formacion')
			->join("ciclistas", "ciclistas.id_registro", "=", "registros_formacion.id")
			->where('ciclistas.numero_documento', $numero_documento)
			->get();

		$puntos = DB::table('puntos')->get();

		$encargados = DB::table('users')
			->join('role_user', 'role_user.user_id', '=', 'users.id')
			->join('roles', 'roles.id', '=', 'role_user.role_id')
			->leftjoin('puntos_users', 'users.id', '=', 'puntos_users.users_id')
			->leftjoin('puntos', 'puntos_users.puntos_id', '=', 'puntos.id')
			->where('role_user.role_id', '=', 2)
			->select('users.name', 'users.documento', 'users.id')
			->get();

		return view('/formularioFormacion/ver_formulario', [
			'registro'              => $registro,
			'numero_documento'      => $numero_documento,
			'puntos'                => $puntos,
			'encargados'            => $encargados,
			'dias_documento'        => $dias_documento,
			'save'                  => 0
		]);
	}

	public function guardarFormularioFormacion(Request $request)
	{
		$existe = DB::table('registros_formacion')
			->where('numero_documento', $request->input('numero_documento'))
			->get();

		if (count($existe) == 0) {
			$hora_inicio = date('H:i:s', strtotime($request->input('fecha_inicio')));

			$hora_finalizacion = date('H:i:s');

			$img      = $request->input('base64');
			$img      = str_replace('data:image/png;base64,', '', $img);
			$fileData = base64_decode($img);
			$fileName = 'formacion_' . $request->input('numero_documento') . '.png';

			file_put_contents('firmas/' . $fileName, $fileData);

			$usuario_punto = DB::table('puntos_users')->where('users_id', Auth::id())->get();

			DB::table('registros_formacion')->insert(array(array(
				'users_id'          => Auth::id(),
				'firma'				=> $fileName,
				'tipo_documento'    => $request->input('tipo_documento'),
				'numero_documento'  => $request->input('numero_documento'),
				'nombre'           	=> $request->input('nombre'),
				'nombre_entidad'    => $request->input('nombre_entidad'),
				'ciudad_residencia' => $request->input('ciudad_residencia'),
				'id_punto'          => $usuario_punto[0]->puntos_id,
				'fecha'             => date('Y-m-d'),
				'hora_inicio'       => $hora_inicio,
				'hora_finalizacion' => $hora_finalizacion,
			)));

			$id_registro = DB::table('registros_formacion')
				->max('id');

			DB::table('respuestas_preguntas')->insert(array(array(
				'id_registro'   	   	=> $id_registro,
				'bicicleta_es'          => $request->input('bicicleta_es'),
				'ciclista_es'     		=> $request->input('ciclista_es'),
				'norma_transito_1'      => $request->input('norma_transito_1'),
				'norma_transito_2'      => $request->input('norma_transito_2'),
				'norma_transito_3' 		=> $request->input('norma_transito_3'),
				'transito_cicloruta' 	=> $request->input('transito_cicloruta'),
				'espacio_publico' 		=> $request->input('espacio_publico'),
				'casco_uso'    			=> $request->input('casco_uso'),
				'girar_derecha' 		=> $request->input('girar_derecha'),
				'cuando_frena'     		=> $request->input('cuando_frena'),
				'puntos_ciegos'     	=> $request->input('puntos_ciegos'),
				'cruzar_obstaculo'   	=> $request->input('cruzar_obstaculo'),
				'disminuir_riesgo'   	=> $request->input('disminuir_riesgo'),
				'ciclista_evitar_res_1' => $request->input('ciclista_evitar_res_1'),
				'ciclista_evitar_res_2' => $request->input('ciclista_evitar_res_2'),
				'ciclista_evitar_res_3'	=> $request->input('ciclista_evitar_res_3'),
				'cotidianidad'   		=> $request->input('cotidianidad'),
				'cierres_ruedas'   		=> $request->input('cierres_ruedas'),
				'sistema_conducir'   	=> $request->input('sistema_conducir'),
				'antes_subir'   		=> $request->input('antes_subir'),
				'platos_pinones'   		=> $request->input('platos_pinones'),
				'antes_lubricar'   		=> $request->input('antes_lubricar'),
			)));

			return redirect('formulario/formacion')
				->with('status', 1);
				// ->with('calificacion_reto', $calificacion_reto)
				// ->with('calificacion_revision', $calificacion_revision);
		}else {
			return redirect('formulario/acciones')
				->with('existe')
				->with('documento', $request->input('numero_documento'));
		}
	}

	
	//Funciones puntos
	public function crearpuntocontrol(Request $request)
	{
		$nombre_punto    = $request->input('nuevo_pc');
		$ubicacion = $request->input('coordenadas');

		DB::table('puntos')->insert(array(array(
			'nombre_punto'    => $nombre_punto,
			'ubicacion' => $ubicacion,
			'created_at' => date('Y-m-d H:i:s')
		)));

		return back();
	}

	public function guardarpuntousuario(Request $request)
	{
		$cons = DB::table('puntos_users')->where('users_id', Auth::id())->get();

		if (count($cons) > 0) {
			DB::table('puntos_users')->where('users_id', Auth::id())->update(array(
				'puntos_id' => $request->input('pc')
			));
		} else {
			DB::table('puntos_users')->insert(array(array(
				'users_id' => Auth::id(),
				'puntos_id' => $request->input('pc')
			)));
		}

		return redirect('formulario/puntocambiado');
	}

	public function cambiarpc()
	{
		$puntos = DB::table('puntos')->orderby('nombre_punto', 'asc')->get();

		$usuario_punto = DB::table('puntos_users')->where('users_id', Auth::id())->count();

		$punto = DB::table('puntos')
			->leftjoin('puntos_users', 'puntos_users.puntos_id', '=', 'puntos.id')
			->where('puntos_users.users_id', Auth::id())
			->select('puntos.*')
			->get();

		return view('/pages/cambiar_punto', [
			'puntos'        => $puntos,
			'usuario_punto' => $usuario_punto,
			'punto' 		=> $punto
		]);
	}


	//Funcion para consultar certificado
	public function consultarCertificado()
	{
		return view('/pages/consultarCertificado', []);
	}

	public function verCertificado(Request $request)
	{
		$documento = $request->input('documento');

		$registro = DB::table('ciclistas')
			->join('registros_acciones', 'registros_acciones.id', '=', 'ciclistas.id_registro')
			->join('puntos', 'registros_acciones.id_punto', '=', 'puntos.id')
			->select("ciclistas.nombre", "ciclistas.numero_documento", "puntos.ciudad", "registros_acciones.fecha")
			->where("ciclistas.numero_documento", $documento)
			->get();

		if (count($registro) > 0) {

			$newDate = date("d/m/Y", strtotime($registro[0]->fecha));

			include('js/fpdf17/fpdf.php');
			$pdf = new FPDF('L', 'pt', 'letter');
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->Image('images/certificado.png', 1, 1, 790, 610, 'PNG');
			$pdf->SetFont('Arial', 'B', 23);
			$pdf->SetTextColor(0, 0, 0);
			$pdf->SetY(330);
			$pdf->SetX(150);
			$pdf->Cell(500, 30, utf8_decode($registro[0]->nombre), 0, 1, 'C');
			$pdf->SetFont('Arial', 'B', 17);
			$pdf->SetY(355);
			$pdf->SetX(150);
			$pdf->Cell(500, 30, "C.C. " . utf8_decode($registro[0]->numero_documento), 0, 1, 'C');
			$pdf->SetFont('Arial', 'B', 12);
			$pdf->SetY(439);
			$pdf->SetX(345);
			$pdf->Cell(110, 15, utf8_decode($registro[0]->ciudad), 0, 1, 'C');
			$pdf->SetFont('Arial', 'B', 11);
			$pdf->SetY(439);
			$pdf->SetX(520);
			$pdf->Cell(50, 15, $newDate, 0, 1, 'C');

			$pdf->Output("I", "Certificado_" . $registro[0]->numero_documento . ".pdf");
			exit;
		} else {

			return redirect('certificacion')
				->with('status', 1);
		}
	}

	public function certificadoMasivo(Request $request)
	{
		$punto       = $request->input('punto');
		$jornada     = $request->input('jornada');
		$fecha_desde = $request->input('fecha');
		$fecha_hasta = $request->input('fecha_hasta');

		if (isset($punto) && !empty($punto)) {
			$campop = 'registros_acciones.id_punto';
			$varp = '=';
			$signop = '' . $punto . '';
		} else {
			$campop = 'registros_acciones.id';
			$varp = '!=';
			$signop = '-3';
		}

		if (isset($jornada) && !empty($jornada)) {
			$campoj = 'registros_acciones.jornada';
			$varj = '=';
			$signoj = '' . $jornada . '';
		} else {
			$campoj = 'registros_acciones.id';
			$varj = '!=';
			$signoj = '-3';
		}

		if (isset($fecha_desde) && !empty($fecha_desde) && isset($fecha_hasta) && !empty($fecha_hasta)) {
			$campofR = 'registros_acciones.fecha';
			$signo1fR = '' . $fecha_desde . '';
			$signo2fR = '' . $fecha_hasta . '';
		} else {
			$fecha = strtotime('+1 day', strtotime(date('Y-m-d')));
			$fecha = date('Y-m-d', $fecha);

			$campofR = 'registros_acciones.fecha';
			$signo1fR = '2020-12-04';
			$signo2fR = $fecha;
		}


		$registros = DB::table('ciclistas')
			->join('registros_acciones', 'registros_acciones.id', '=', 'ciclistas.id_registro')
			->join('puntos', 'registros_acciones.id_punto', '=', 'puntos.id')
			->select("ciclistas.nombre", "ciclistas.numero_documento", "puntos.ciudad", "registros_acciones.fecha", "puntos.nombre_punto")
			->where($campop, $varp, $signop)
			->where($campoj, $varj, $signoj)
			->whereBetween($campofR, array($signo1fR, $signo2fR))
			->orderBy("registros_acciones.id", "ASC")
			->get();

		$fecha_nueva = date('ymd', strtotime($registros[0]->fecha)); 

        $nombre_pdf = $fecha_nueva.' CA '.utf8_decode(mb_strtoupper($registros[0]->nombre_punto)).'.pdf';

		include('js/fpdf17/fpdf.php');

		$pdf = new FPDF('L', 'pt', 'letter');
		$pdf->AliasNbPages();

		for ($i = 0; $i < count($registros); $i++) {
			$newDate = date("d/m/Y", strtotime($registros[$i]->fecha));

			$pdf->AddPage();
			$pdf->Image('images/certificado.png', 1, 1, 790, 610, 'PNG');
			$pdf->SetFont('Arial', 'B', 23);
			$pdf->SetTextColor(0, 0, 0);
			$pdf->SetY(330);
			$pdf->SetX(150);
			$pdf->Cell(500, 30, utf8_decode($registros[$i]->nombre), 0, 1, 'C');
			$pdf->SetFont('Arial', 'B', 17);
			$pdf->SetY(355);
			$pdf->SetX(150);
			$pdf->Cell(500, 30, "C.C. " . utf8_decode($registros[$i]->numero_documento), 0, 1, 'C');
			$pdf->SetFont('Arial', 'B', 12);
			$pdf->SetY(439);
			$pdf->SetX(345);
			$pdf->Cell(110, 15, utf8_decode($registros[$i]->ciudad), 0, 1, 'C');
			$pdf->SetFont('Arial', 'B', 11);
			$pdf->SetY(439);
			$pdf->SetX(520);
			$pdf->Cell(50, 15, $newDate, 0, 1, 'C');
		}

		$pdf->Output("I", $nombre_pdf);
	}
}
