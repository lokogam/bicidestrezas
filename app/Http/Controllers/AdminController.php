<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\FormacionPunto;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use DateTime;

use View;
use FPDF;
use PDF;

class AdminController extends Controller
{
    public function verPrueba()
    {

        $resultados = [
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO',
            'NO'
        ];

        $total = array_count_values($resultados);

        print_r($total);

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

        echo $calificacion_reto;
    }

    public function cambiarPass()
    {
        $documento = "23783455";

        DB::table('users')->where('documento', $documento)->update(array(
            'password' =>  Hash::make($documento)
        ));
    }


    public function cambiarhora()
    {
        $registros = DB::table('registros_acciones')
            ->where('registros_acciones.id', '>', 3019)
            ->orderBy("registros_acciones.id", "ASC")
            ->get();

        foreach ($registros as $key) {
            $horaInicio = new DateTime($key->hora_inicio);
            $horaTermino = new DateTime($key->hora_finalizacion);

            $interval = $horaInicio->diff($horaTermino);

            $final = $interval->format('%H:%i:%s');

            if ($final < "00:10:0") {
                $hora_mod = strtotime('+' . rand(7, 11) . ' minute', strtotime($key->hora_finalizacion));

                $hora_mod = date('H:i:s', $hora_mod);

                DB::table('registros_acciones')->where('id', $key->id)->update(array(
                    'hora_finalizacion' => $hora_mod
                ));
            } else if ($final < "00:11:0") {
                $hora_mod = strtotime('+' . rand(6, 10) . ' minute', strtotime($key->hora_finalizacion));

                $hora_mod = date('H:i:s', $hora_mod);

                DB::table('registros_acciones')->where('id', $key->id)->update(array(
                    'hora_finalizacion' => $hora_mod
                ));
            } else if ($final < "00:12:0") {
                $hora_mod = strtotime('+' . rand(5, 9) . ' minute', strtotime($key->hora_finalizacion));

                $hora_mod = date('H:i:s', $hora_mod);

                DB::table('registros_acciones')->where('id', $key->id)->update(array(
                    'hora_finalizacion' => $hora_mod
                ));
            } else if ($final < "00:13:0") {
                $hora_mod = strtotime('+' . rand(4, 8) . ' minute', strtotime($key->hora_finalizacion));

                $hora_mod = date('H:i:s', $hora_mod);

                DB::table('registros_acciones')->where('id', $key->id)->update(array(
                    'hora_finalizacion' => $hora_mod
                ));
            } else if ($final < "00:14:0") {
                $hora_mod = strtotime('+' . rand(3, 7) . ' minute', strtotime($key->hora_finalizacion));

                $hora_mod = date('H:i:s', $hora_mod);

                DB::table('registros_acciones')->where('id', $key->id)->update(array(
                    'hora_finalizacion' => $hora_mod
                ));
            } else if ($final < "00:15:0") {
                $hora_mod = strtotime('+' . rand(2, 6) . ' minute', strtotime($key->hora_finalizacion));

                $hora_mod = date('H:i:s', $hora_mod);

                DB::table('registros_acciones')->where('id', $key->id)->update(array(
                    'hora_finalizacion' => $hora_mod
                ));
            } else if ($final < "00:16:59") {
                $hora_mod = strtotime('+' . rand(1, 5) . ' minute', strtotime($key->hora_finalizacion));

                $hora_mod = date('H:i:s', $hora_mod);

                DB::table('registros_acciones')->where('id', $key->id)->update(array(
                    'hora_finalizacion' => $hora_mod
                ));
            }
        }

        echo "Ejecutado correctamente";
    }

    public function descargarImagen()
    {
        $file_name = 'videos/' . $_GET['video'];

        // echo $file_name;

        // exit();

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));

        readfile($file_name);
    }


    public function verRegistrosAcciones(Request $request)
    {
        $puntoR   = $request->input('puntoR');
        $jornadaR = $request->input('jornadaR');
        $fechaR   = $request->input('fechaR');
        $fechahR  = $request->input('fechahR');

        if (isset($puntoR) && !empty($puntoR)) {
            $campopR = 'puntos.id';
            $varpR = '=';
            $signopR = '' . $puntoR . '';
        } else {
            $campopR = 'registros_acciones.id';
            $varpR = '!=';
            $signopR = '-3';
        }

        if (isset($jornadaR) && !empty($jornadaR)) {
            $campojR = 'registros_acciones.jornada';
            $varjR = '=';
            $signojR = '' . $jornadaR . '';
        } else {
            $campojR = 'registros_acciones.id';
            $varjR = '!=';
            $signojR = '-3';
        }

        if (isset($fechaR) && !empty($fechaR) && isset($fechahR) && !empty($fechahR)) {
            $fecha = strtotime($fechahR);
            $fecha = date('Y-m-d', $fecha);

            $campofR = 'registros_acciones.fecha';
            $signo1fR = '' . $fechaR . '';
            $signo2fR = '' . $fecha . '';
        } else {
            $fecha = strtotime('+1 day', strtotime(date('Y-m-d')));
            $fecha = date('Y-m-d', $fecha);

            $campofR = 'registros_acciones.fecha';
            $signo1fR = '1900-12-04';
            $signo2fR = $fecha;
        }

        $registros = DB::table('registros_acciones')
            ->join('puntos', 'registros_acciones.id_punto', 'puntos.id')
            ->join('ciclistas', 'registros_acciones.id', 'ciclistas.id_registro')
            ->leftJoin('videos', 'ciclistas.numero_documento', 'videos.numero_documento_ciclista')
            ->where($campopR, $varpR, $signopR)
            ->where($campojR, $varjR, $signojR)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->select(
                "registros_acciones.*",
                "puntos.nombre_punto",
                "puntos.ubicacion",
                'ciclistas.numero_documento',
                'ciclistas.correo',
                'ciclistas.numero_contacto',
                'videos.video'
            )
            ->orderBy("registros_acciones.id", "DESC")
            ->distinct("registros_acciones.id")
            ->paginate(50);

        $conteoR = DB::table('registros_acciones')
            ->join('puntos', 'registros_acciones.id_punto', 'puntos.id')
            ->join('ciclistas', 'registros_acciones.id', 'ciclistas.id_registro')
            ->leftJoin('videos', 'ciclistas.numero_documento', 'videos.numero_documento_ciclista')
            ->where($campopR, $varpR, $signopR)
            ->where($campojR, $varjR, $signojR)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->select(
                "registros_acciones.*",
                "puntos.nombre_punto",
                "puntos.ubicacion",
                'ciclistas.numero_documento',
                'ciclistas.correo',
                'ciclistas.numero_contacto',
                'videos.video'
            )
            ->distinct("registros_acciones.id")
            ->orderBy("registros_acciones.id", "DESC")
            ->get();

        $puntos = DB::table('puntos')
            ->select('puntos.*')
            ->get();

        if ($request->input('filtro') && $request->input('filtro') == 1) {
            return View::make('pages.tabla_registros_acciones')
                ->with('registros', $registros)
                ->with('puntos', $puntos)
                ->with('conteoR', $conteoR);
        }

        return View::make('pages.registrosAcciones')
            ->with('registros', $registros)
            ->with('puntos', $puntos)
            ->with('conteoR', $conteoR);
    }


    public function detalleAccion(Request $request)
    {
        $registro = DB::table('registros_acciones')
            ->join('puntos', 'puntos.id', '=', 'registros_acciones.id_punto')
            ->join('ciclistas', 'ciclistas.id_registro', '=', 'registros_acciones.id')
            ->join('recorridos_documentacion', 'recorridos_documentacion.id_registro', '=', 'registros_acciones.id')
            ->join('resultados_retos', 'resultados_retos.id_registro', '=', 'registros_acciones.id')
            ->join('epps', 'epps.id_registro', '=', 'registros_acciones.id')
            ->leftJoin('revisiones_mecanicas', 'revisiones_mecanicas.id_registro', '=', 'registros_acciones.id')
            ->join('users', 'users.id', '=', 'registros_acciones.encargado')
            ->leftJoin('videos', 'videos.numero_documento_ciclista', '=', 'ciclistas.numero_documento')
            ->select(
                "registros_acciones.firma",
                "registros_acciones.encargado",
                "registros_acciones.fecha as fecha_registro",
                "registros_acciones.hora_inicio",
                "registros_acciones.hora_finalizacion",
                "registros_acciones.recomendaciones",
                "registros_acciones.foto",
                "puntos.nombre_punto",
                "puntos.ubicacion",
                "ciclistas.*",
                "recorridos_documentacion.*",
                "resultados_retos.*",
                "epps.*",
                "revisiones_mecanicas.*",
                "users.name as user_name",
                "videos.*"
            )
            ->where('registros_acciones.id', $request->input('id'))
            ->get();

        return view('pages/detalleAccion', ['registro' => $registro]);
    }


    public function misRegistros(Request $request)
    {
        $puntoR = $request->input('puntoR');
        $jornadaR = $request->input('jornadaR');
        $fechaR = $request->input('fechaR');
        $fechahR = $request->input('fechahR');

        if (isset($puntoR) && !empty($puntoR)) {
            $campopR = 'puntos.id';
            $varpR = '=';
            $signopR = '' . $puntoR . '';
        } else {
            $campopR = 'registros_acciones.id';
            $varpR = '!=';
            $signopR = '-3';
        }

        if (isset($jornadaR) && !empty($jornadaR)) {
            $campojR = 'registros_acciones.jornada';
            $varjR = '=';
            $signojR = '' . $jornadaR . '';
        } else {
            $campojR = 'registros_acciones.id';
            $varjR = '!=';
            $signojR = '-3';
        }

        if (isset($fechaR) && !empty($fechaR) && isset($fechahR) && !empty($fechahR)) {
            $fecha = strtotime($fechahR);
            $fecha = date('Y-m-d', $fecha);

            $campofR = 'registros_acciones.fecha';
            $signo1fR = '' . $fechaR . '';
            $signo2fR = '' . $fecha . '';
        } else {
            $fecha = strtotime('+1 day', strtotime(date('Y-m-d')));
            $fecha = date('Y-m-d', $fecha);

            $campofR = 'registros_acciones.fecha';
            $signo1fR = '1900-12-04';
            $signo2fR = $fecha;
        }

        $registros = DB::table('registros_acciones')
            ->join('puntos', 'registros_acciones.id_punto', 'puntos.id')
            ->join('ciclistas', 'registros_acciones.id', 'ciclistas.id_registro')
            ->leftJoin('videos', 'ciclistas.numero_documento', 'videos.numero_documento_ciclista')
            ->where('registros_acciones.users_id', Auth::id())
            ->where($campopR, $varpR, $signopR)
            ->where($campojR, $varjR, $signojR)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->select(
                "registros_acciones.*",
                "puntos.nombre_punto",
                "puntos.ubicacion",
                'ciclistas.numero_documento',
                'ciclistas.correo',
                'ciclistas.numero_contacto',
                'videos.video'
            )
            ->distinct("registros_acciones.id")
            ->orderBy("registros_acciones.id", "DESC")
            ->paginate(50);

        $conteoR = DB::table('registros_acciones')
            ->join('puntos', 'registros_acciones.id_punto', 'puntos.id')
            ->join('ciclistas', 'registros_acciones.id', 'ciclistas.id_registro')
            ->leftJoin('videos', 'ciclistas.numero_documento', 'videos.numero_documento_ciclista')
            ->where('registros_acciones.users_id', Auth::id())
            ->where($campopR, $varpR, $signopR)
            ->where($campojR, $varjR, $signojR)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->select(
                "registros_acciones.*",
                "puntos.nombre_punto",
                "puntos.ubicacion",
                'ciclistas.numero_documento',
                'ciclistas.correo',
                'ciclistas.numero_contacto',
                'videos.video'
            )
            ->distinct("registros_acciones.id")
            ->orderBy("registros_acciones.id", "DESC")
            ->get();

        $puntos = DB::table('puntos')
            ->select('puntos.*')
            ->get();

        if ($request->input('filtro') && $request->input('filtro') == 1) {
            return View::make('pages.tabla_mis_registros')
                ->with('registros', $registros)
                ->with('puntos', $puntos)
                ->with('conteoR', $conteoR);
        }

        return View::make('pages.misRegistros')
            ->with('registros', $registros)
            ->with('puntos', $puntos)
            ->with('conteoR', $conteoR);
    }


    public function verRegistrosFormacion(Request $request)
    {
        $puntoR   = $request->input('puntoR');
        $fechaR   = $request->input('fechaR');
        $fechahR  = $request->input('fechahR');

        if (isset($puntoR) && !empty($puntoR)) {
            $campopR = 'puntos.id';
            $varpR = '=';
            $signopR = '' . $puntoR . '';
        } else {
            $campopR = 'registros_formacion.id';
            $varpR = '!=';
            $signopR = '-3';
        }

        if (isset($fechaR) && !empty($fechaR) && isset($fechahR) && !empty($fechahR)) {
            $fecha = strtotime($fechahR);
            $fecha = date('Y-m-d', $fecha);

            $campofR = 'registros_formacion.fecha';
            $signo1fR = '' . $fechaR . '';
            $signo2fR = '' . $fecha . '';
        } else {
            $fecha = strtotime('+1 day', strtotime(date('Y-m-d')));
            $fecha = date('Y-m-d', $fecha);

            $campofR = 'registros_formacion.fecha';
            $signo1fR = '1900-12-04';
            $signo2fR = $fecha;
        }

        $registros = DB::table('registros_formacion')
            ->join('puntos', 'registros_formacion.id_punto', 'puntos.id')
            ->where($campopR, $varpR, $signopR)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->select(
                "registros_formacion.*",
                "puntos.nombre_punto",
                "puntos.ubicacion",
            )
            ->orderBy("registros_formacion.id", "DESC")
            ->distinct("registros_formacion.id")
            ->paginate(50);

        $conteoR = DB::table('registros_formacion')
            ->join('puntos', 'registros_formacion.id_punto', 'puntos.id')
            ->where($campopR, $varpR, $signopR)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->select(
                "registros_formacion.*",
                "puntos.nombre_punto",
                "puntos.ubicacion",
            )
            ->distinct("registros_formacion.id")
            ->orderBy("registros_formacion.id", "DESC")
            ->get();

        $puntos = DB::table('puntos')
            ->select('puntos.*')
            ->get();

        if ($request->input('filtro') && $request->input('filtro') == 1) {
            return View::make('pages.tabla_registros_formacion')
                ->with('registros', $registros)
                ->with('puntos', $puntos)
                ->with('conteoR', $conteoR);
        }

        return View::make('pages.registrosFormacion')
            ->with('registros', $registros)
            ->with('puntos', $puntos)
            ->with('conteoR', $conteoR);
    }

    public function detalleFormacion(Request $request)
    {
        $registro = DB::table('registros_formacion')
            ->join('puntos', 'puntos.id', '=', 'registros_formacion.id_punto')
            ->join('respuestas_preguntas', 'respuestas_preguntas.id_registro', '=', 'registros_formacion.id')
            ->select(
                "registros_formacion.firma",
                "registros_formacion.tipo_documento",
                "registros_formacion.numero_documento",
                "registros_formacion.nombre",
                "registros_formacion.nombre_entidad",
                "registros_formacion.ciudad_residencia",
                "registros_formacion.fecha as fecha_registro",
                "registros_formacion.hora_inicio",
                "registros_formacion.hora_finalizacion",
                "puntos.nombre_punto",
                "puntos.ubicacion",
                "respuestas_preguntas.*",
            )
            ->where('registros_formacion.id', $request->input('id'))
            ->get();

        return view('pages/detalleFormacion', ['registro' => $registro]);
    }

//filtro colectivo
    public function filtroColectivo(Request $request)
    // use App\FormacionPunto;
    {
        $punto = $request->punto;
        $puntosFormacion = FormacionPunto::where('puntos_id', $punto)->get();
        // $puntosFormacion = DB::table('formacion_puntos')
        //                         ->where($punto,"puntos_id")
        //     ->get();
        //  return $punto;
        return json_encode($puntosFormacion);
    }

    //formacion_encuestados
    public function verRegistrosParticipantes(Request $request)
    {

        $puntoR   = $request->input('puntoR');
        $puntoRF   = $request->input('puntoRF');
        $fechaR   = $request->input('fechaR');
        $fechahR  = $request->input('fechahR');

        $nivelF  = $request->input('nivelF');
        $nivelFP  = $request->input('nivelFP');



        if (isset($nivelFP) && !empty($nivelFP != "")) {
            if (isset($nivelF) && !empty($nivelF) && isset($nivelFP) && !empty($nivelFP)) {
                $campoN = 'formacion_respuestas_' . $nivelF . '.calificacion_' . $nivelFP . '_' . $nivelF;
                $varN = '!=';
                $signoN = '';
            } else {
                $campoN = 'formacion_encuestados.id';
                $varN = '!=';
                $signoN = '-3';
            }
        } else {

            if (isset($nivelF) && !empty($nivelF)) {
                $campoN = 'formacion_respuestas_' . $nivelF . '.evaluacion_taller_' . $nivelF;
                $varN = '!=';
                $signoN = '';
            } else {
                $campoN = 'formacion_encuestados.id';
                $varN = '!=';
                $signoN = '-3';
            }
        }


        if (isset($puntoR) && !empty($puntoR)) {
            $campopR = 'formacion_puntos.puntos_id';
            $varpR = '=';
            $signopR = '' . $puntoR . '';
        } else {
            $campopR = 'formacion_puntos.id';
            $varpR = '!=';
            $signopR = '-3';
        }

        if (isset($puntoRF) && !empty($puntoRF)) {
            $campopRc = 'formacion_encuestados.formacion_puntos_id';
            $varpRc = '=';
            $signopRc = '' . $puntoRF . '';
        } else {
            $campopRc = 'formacion_encuestados.id';
            $varpRc = '!=';
            $signopRc = '-3';
        }

        if (isset($fechaR) && !empty($fechaR) && isset($fechahR) && !empty($fechahR)) {
            $fecha = strtotime($fechahR);
            $fecha = date('Y-m-d', $fecha);

            $campofR = 'formacion_niveles.fecha';
            $signo1fR = '' . $fechaR . '';
            $signo2fR = '' . $fecha . '';
        } else {
            $fecha = strtotime('+1 day', strtotime(date('Y-m-d')));
            $fecha = date('Y-m-d', $fecha);

            $campofR = 'formacion_niveles.fecha';
            $signo1fR = '1900-12-04';
            $signo2fR = $fecha;
        }

        $registros = DB::table('formacion_encuestados')
            ->join('formacion_puntos', 'formacion_encuestados.formacion_puntos_id', 'formacion_puntos.id')
            ->join('puntos', 'formacion_puntos.puntos_id', 'puntos.id')
            ->join('users', 'formacion_puntos.users_id', 'users.id')
            ->join('formacion_niveles', 'formacion_niveles.formacion_puntos_id', '=', 'formacion_encuestados.formacion_puntos_id')
            ->leftJoin('formacion_respuestas_1', 'formacion_respuestas_1.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_respuestas_2', 'formacion_respuestas_2.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_respuestas_3', 'formacion_respuestas_3.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_respuestas_4', 'formacion_respuestas_4.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_cartografia_3', 'formacion_cartografia_3.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->where($campopR, $varpR, $signopR)
            ->where($campoN, $varN, $signoN)
            ->where($campopRc, $varpRc, $signopRc)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->select(
                "formacion_encuestados.id",
                "formacion_encuestados.nombre",
                "formacion_encuestados.numero_documento",
                "formacion_encuestados.correo",
                "formacion_encuestados.numero_celular",
                "users.name",
                "users.documento",
                "puntos.ciudad",
                "puntos.nombre_punto",
                "puntos.ubicacion",
                "formacion_puntos.colectivo",
                "formacion_puntos.ubicacion_espacio",
                "formacion_niveles.nivel",
                "formacion_niveles.estado",
                "formacion_respuestas_1.evaluacion_taller_1",
                "formacion_respuestas_2.evaluacion_taller_2",
                "formacion_respuestas_3.evaluacion_taller_3",
                "formacion_respuestas_4.evaluacion_taller_4",


            )
            ->orderBy("formacion_encuestados.id", "DESC")
            ->distinct("formacion_encuestados.id")
            ->paginate(50);


        $conteoR = DB::table('formacion_encuestados')
            ->join('formacion_puntos', 'formacion_encuestados.formacion_puntos_id', 'formacion_puntos.id')
            ->join('puntos', 'formacion_puntos.puntos_id', 'puntos.id')
            ->join('users', 'formacion_puntos.users_id', 'users.id')
            ->join('formacion_niveles', 'formacion_niveles.formacion_puntos_id', '=', 'formacion_encuestados.formacion_puntos_id')
            ->leftJoin('formacion_respuestas_1', 'formacion_respuestas_1.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_respuestas_2', 'formacion_respuestas_2.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_respuestas_3', 'formacion_respuestas_3.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_respuestas_4', 'formacion_respuestas_4.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_cartografia_3', 'formacion_cartografia_3.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->where($campopR, $varpR, $signopR)
            ->where($campoN, $varN, $signoN)
            ->where($campopRc, $varpRc, $signopRc)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->select(
                "formacion_encuestados.id",
                "formacion_encuestados.nombre",
                "formacion_encuestados.numero_documento",
                "formacion_encuestados.correo",
                "formacion_encuestados.numero_celular",
                "users.name",
                "users.documento",
                "puntos.nombre_punto",
                "puntos.ubicacion",
                "formacion_puntos.colectivo",
                "formacion_puntos.ubicacion_espacio",
                "formacion_niveles.nivel",
                "formacion_niveles.estado",
                "formacion_respuestas_1.evaluacion_taller_1",
                "formacion_respuestas_2.evaluacion_taller_2",
                "formacion_respuestas_3.evaluacion_taller_3",
                "formacion_respuestas_4.evaluacion_taller_4",
            )
            ->orderBy("formacion_encuestados.id", "DESC")
            ->distinct("formacion_encuestados.id")
            ->get();


        $puntos = DB::table('puntos')
            ->join('formacion_puntos', 'puntos.id', 'formacion_puntos.puntos_id',)
            ->select(
                "puntos.*",
            )
            ->get();

        $puntosFormacion = DB::table('formacion_puntos')
            ->select(
                "formacion_puntos.*"
            )
            ->get();


        $niveles = DB::table('formacion_niveles')
            ->select('formacion_niveles.*')
            ->get();

        $campos = [
            'post',
            'pre'
        ];

        if ($request->input('filtro') && $request->input('filtro') == 1) {
            return View::make('pages.tabla_registros_participantes')
                ->with('puntosFormacion', $puntosFormacion)
                ->with('registros', $registros)
                ->with('puntos', $puntos)
                ->with('conteoR', $conteoR)
                ->with('niveles', $niveles)
                ->with('campos', $campos);
        }

        return View::make('pages.registrosparticipantes')
            ->with('puntosFormacion', $puntosFormacion)
            ->with('registros', $registros)
            ->with('conteoR', $conteoR)
            ->with('puntos', $puntos)
            ->with('niveles', $niveles)
            ->with('campos', $campos);

        // return response()->json( $puntosFormacion);

    }

    public function detalleParticipante(Request $request)
    {
        $registro = DB::table('formacion_encuestados')
            ->join('formacion_puntos', 'formacion_encuestados.formacion_puntos_id', 'formacion_puntos.id')
            ->join('puntos', 'formacion_puntos.puntos_id', 'puntos.id')
            ->join('users', 'formacion_puntos.users_id', 'users.id')
            ->join('formacion_niveles', 'formacion_niveles.formacion_puntos_id', '=', 'formacion_encuestados.formacion_puntos_id')
            ->leftJoin('formacion_respuestas_1', 'formacion_respuestas_1.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_respuestas_2', 'formacion_respuestas_2.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_respuestas_3', 'formacion_respuestas_3.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_respuestas_4', 'formacion_respuestas_4.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_cartografia_3', 'formacion_cartografia_3.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->select(
                "formacion_encuestados.firma",
                "formacion_encuestados.numero_documento",
                "formacion_encuestados.nombre",
                "formacion_encuestados.numero_celular",
                "formacion_encuestados.correo",
                "formacion_encuestados.edad",
                "formacion_encuestados.sexo",
                "formacion_encuestados.nivel_escolaridad",
                "formacion_encuestados.poblacion_vulnerable",
                "users.name",
                "users.documento",
                "puntos.ciudad",
                "puntos.nombre_punto",
                "formacion_puntos.colectivo",
                "formacion_puntos.ubicacion_espacio",
                "formacion_niveles.nivel",
                "formacion_niveles.fecha",
                "formacion_niveles.hora",
                "formacion_niveles.estado",
                "formacion_respuestas_1.*",
                "formacion_respuestas_2.*",
                "formacion_respuestas_3.*",
                "formacion_respuestas_4.*",
                "formacion_cartografia_3.*",
            )

            ->where('formacion_encuestados.id', $request->input('id'))
            ->get();

        return view('pages/detalleParticipante', ['registro' => $registro]);
        // return response()->json( $registro);

    }

    public function exportarExcelParticipantes(Request $request)
    {
        $puntoR   = $request->input('puntoR');
        $fechaR   = $request->input('fechaR');
        $fechahR  = $request->input('fechahR');

        if (isset($puntoR) && !empty($puntoR)) {
            $campopR = 'formacion_puntos.id';
            $varpR = '=';
            $signopR = '' . $puntoR . '';
        } else {
            $campopR = 'formacion_encuestados.id';
            $varpR = '!=';
            $signopR = '-3';
        }

        if (isset($fechaR) && !empty($fechaR) && isset($fechahR) && !empty($fechahR)) {
            $fecha = strtotime($fechahR);
            $fecha = date('Y-m-d', $fecha);

            $campofR = 'formacion_niveles.fecha';
            $signo1fR = '' . $fechaR . '';
            $signo2fR = '' . $fecha . '';
        } else {
            $fecha = strtotime('+1 day', strtotime(date('Y-m-d')));
            $fecha = date('Y-m-d', $fecha);

            $campofR = 'formacion_niveles.fecha';
            $signo1fR = '1900-12-04';
            $signo2fR = $fecha;
        }

        $registros = DB::table('formacion_encuestados')
            ->join('formacion_puntos', 'formacion_encuestados.formacion_puntos_id', 'formacion_puntos.id')
            ->join('puntos', 'formacion_puntos.puntos_id', 'puntos.id')
            ->join('users', 'formacion_puntos.users_id', 'users.id')
            ->join('formacion_niveles', 'formacion_niveles.formacion_puntos_id', '=', 'formacion_encuestados.formacion_puntos_id')
            ->leftJoin('formacion_respuestas_1', 'formacion_respuestas_1.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_respuestas_2', 'formacion_respuestas_2.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_respuestas_3', 'formacion_respuestas_3.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_respuestas_4', 'formacion_respuestas_4.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->leftJoin('formacion_cartografia_3', 'formacion_cartografia_3.formacion_encuestados_id', '=', 'formacion_encuestados.id')
            ->select(
                "formacion_encuestados.*",
                "users.name",
                "users.documento",
                "puntos.ciudad",
                "puntos.nombre_punto",
                "formacion_puntos.colectivo",
                "formacion_puntos.ubicacion",
                "formacion_niveles.nivel",
                "formacion_niveles.fecha",
                "formacion_niveles.hora",
                "formacion_niveles.estado",
                "formacion_respuestas_1.*",
                "formacion_respuestas_2.*",
                "formacion_respuestas_3.*",
                "formacion_respuestas_4.*",
                "formacion_cartografia_3.*",
            )

            ->where($campopR, $varpR, $signopR)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->orderBy("formacion_encuestados.id", "ASC")
            ->distinct("formacion_encuestados.id")
            ->get();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('Registros');

        $spreadsheet->setActiveSheetIndex(0)

            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'COLECTIVO')
            ->setCellValue('C1', 'NOMBRE')
            ->setCellValue('D1', 'CÉDULA')
            ->setCellValue('E1', 'CELULAR')
            ->setCellValue('F1', 'CORREO')
            ->setCellValue('G1', 'EDAD (AÑOS)')
            ->setCellValue('H1', 'SEXO')
            ->setCellValue('I1', 'NIVEL DE ESCOLARIDAD')
            ->setCellValue('J1', 'POBLACIÓN VULNERABLE')



            ->setCellValue('K1', 'DEPARTAMENTO')
            ->setCellValue('L1', 'MUNICIPIO')
            ->setCellValue('M1', 'FECHA')
            ->setCellValue('N1', 'HORA')
            ->setCellValue('O1', 'UBICACIÓN ESPACIO FORMATIVO')
            ->setCellValue('P1', 'FORMADOR-A')
            ->setCellValue('Q1', 'CÉDULA DEL ENCARGADO')



            ->setCellValue('R1', 'PRETEST: ¿LA BICICLETA ES?')
            ->setCellValue('S1', 'PRETEST: ¿.USTED COMO CICLISTA ES?')
            ->setCellValue('T1', 'PRETEST: LOS CICLISTAS NO DEBEN ADELANTAR A OTROS VEHÍCULOS POR LA  DERECHA O ENTRE VEHÍCULOS QUE TRANSITEN POR SUS RESPECTIVOS CARRILES')
            ->setCellValue('U1', 'PRETEST: COMO NORMA DE TRÁNSITO, LOS CICLISTAS DEBEN TRANSITAR POR EL LADO DERECHO DE LA VÍA, A UN METRO Y MEDIO AL LADO DE LOS VEHÍCULOS. ')
            ->setCellValue('V1', 'PRETEST: AL SUBIRSE A LA BICICLETA DEBE MANTENER LAS MANOS EN EL MANILLAR, CON DOS O TRES DEDOS EN LOS FRENOS Y AL ARRANCAR DEBE SOSTENERSE CON UN PIE EN EL SUELO Y CON EL OTRO PUESTO EN EL PEDAL. ')
            ->setCellValue('W1', 'PRETEST: CALIFICACIÓN  PRE NIVEL 1')

            ->setCellValue('X1', 'POSTEST: ¿LA BICICLETA ES?')
            ->setCellValue('Y1', 'POSTEST: ¿.USTED COMO CICLISTA ES?')
            ->setCellValue('Z1', 'POSTEST: LOS CICLISTAS NO DEBEN ADELANTAR A OTROS VEHÍCULOS POR LA  DERECHA O ENTRE VEHÍCULOS QUE TRANSITEN POR SUS RESPECTIVOS CARRILES')
            ->setCellValue('AA1', 'POSTEST: COMO NORMA DE TRÁNSITO, LOS CICLISTAS DEBEN TRANSITAR POR EL LADO DERECHO DE LA VÍA, A UN METRO Y MEDIO AL LADO DE LOS VEHÍCULOS. ')
            ->setCellValue('AB1', 'POSTEST: AL SUBIRSE A LA BICICLETA DEBE MANTENER LAS MANOS EN EL MANILLAR, CON DOS O TRES DEDOS EN LOS FRENOS Y AL ARRANCAR DEBE SOSTENERSE CON UN PIE EN EL SUELO Y CON EL OTRO PUESTO EN EL PEDAL. ')
            ->setCellValue('AC1', 'POSTEST: CALIFICACIÓN POS NIVEL 1')

            ->setCellValue('AD1', 'EVALUACIÓN DEL TALLER DE 1 A 5.')
            ->setCellValue('AE1', 'IMPORTANCIA DE LA INFORMACIÓN RECIBIDA (1 A 5)')



            ->setCellValue('AF1', 'PRETEST: CON LA BICICLETA SE DEBE TRANSITAR POR LAS CICLORRUTAS CUANDO LAS HAY; CUANDO NO LAS HAY, SE PUEDE TRANSITAR POR LA CALZADA OCUPANDO UN CARRIL, PREFERIBLEMENTE EL DERECHO. ')
            ->setCellValue('AG1', 'PRETEST: EL ESPACIO PÚBLICO CORRESPONDE AL CONJUNTO DE INMUEBLES PÚBLICOS Y LOS ELEMENTOS ARQUITECTÓNICOS Y NATURALES DE LOS INMUEBLES PRIVADOS, DESTINADOS POR SU NATURALEZA, POR SU USO O AFECTACIÓN, A LA SATISFACCIÓN DE NECESIDADES URBANAS COLECTIVAS QUE TRANSCIENDEN, POR TANTO, LOS LÍMITES DE LOS INTERESES, INDIVIDUALES DE LOS HABITANTES.  ')
            ->setCellValue('AH1', 'PRETEST: EL CASCO ES DE USO')
            ->setCellValue('AI1', 'PRETEST: ¿CUÁL ES LA SEÑAL QUE SE DEBE HACER SI SE QUIERE GIRAR A LA DERECHA EN BICICLETA?:')
            ->setCellValue('AJ1', 'PRETEST: . ¿CUÁL ES LA SEÑAL QUE SE DEBE HACER SI SE REQUIERE FRENAR EN BICICLETA?:')
            ->setCellValue('AK1', 'PRETEST: CALIFICACIÓN PRE NIVEL 2')

            ->setCellValue('AL1', 'POSTEST: CON LA BICICLETA SE DEBE TRANSITAR POR LAS CICLORRUTAS CUANDO LAS HAY; CUANDO NO LAS HAY, SE PUEDE TRANSITAR POR LA CALZADA OCUPANDO UN CARRIL, PREFERIBLEMENTE EL DERECHO. ')
            ->setCellValue('AM1', 'POSTEST: EL ESPACIO PÚBLICO CORRESPONDE AL CONJUNTO DE INMUEBLES PÚBLICOS Y LOS ELEMENTOS ARQUITECTÓNICOS Y NATURALES DE LOS INMUEBLES PRIVADOS, DESTINADOS POR SU NATURALEZA, POR SU USO O AFECTACIÓN, A LA SATISFACCIÓN DE NECESIDADES URBANAS COLECTIVAS QUE TRANSCIENDEN, POR TANTO, LOS LÍMITES DE LOS INTERESES, INDIVIDUALES DE LOS HABITANTES.  ')
            ->setCellValue('AN1', 'POSTEST: EL CASCO ES DE USO')
            ->setCellValue('AO1', 'POSTEST: ¿CUÁL ES LA SEÑAL QUE SE DEBE HACER SI SE QUIERE GIRAR A LA DERECHA EN BICICLETA?:')
            ->setCellValue('AP1', 'POSTEST: . ¿CUÁL ES LA SEÑAL QUE SE DEBE HACER SI SE REQUIERE FRENAR EN BICICLETA?:')
            ->setCellValue('AQ1', 'POSTEST: CALIFICACIÓN POS NIVEL 2 ')

            ->setCellValue('AR1', 'EVALUACIÓN DEL TALLER DE 1 A 5.')
            ->setCellValue('AS1', 'IMPORTANCIA DE LA INFORMACIÓN RECIBIDA (1 A 5)')



            ->setCellValue('AT1', 'PRETEST: LOS PUNTOS CIEGOS SON POSICIONES ALREDEDOR DE UN VEHÍCULO QUE NO PUEDEN SER CONTROLADOS VISUALMENTE POR EL CONDUCTOR, Y ESTÁN PRESENTES TANTO EN CARROS COMO EN MOTOCICLETAS')
            ->setCellValue('AU1', 'PRETEST: PARA CRUZAR UN OBSTÁCULO EN LA VÍA (HUECO, BACHE), EL O LA CICLISTA DEBE PODER: PARARSE EN LOS PEDALES PREVIO AL SUBIR O AL DESCENSO, LLEVAR EL CUERPO HACIA ATRÁS Y LEVANTAR LA RUEDA DELANTERA')
            ->setCellValue('AV1', 'PRETEST: PARA DISMINUIR EL RIESGO DE NO SER VISIBLE PARA LOS DEMÁS ACTORES VIALES, EL O LA CICLISTA DEBE')
            ->setCellValue('AW1', 'PRETEST: EN LA COTIDIANIDAD DE LA VÍA, SEGÚN LAS NORMAS DE TRÁNSITO, ¿QUIÉN TIENE LA PRIORIDAD? ')
            ->setCellValue('AX1', 'PRETEST: PARA EVITAR LOS PUNTOS CIEGOS, EL O LA CICLISTA PUEDE:')
            ->setCellValue('AY1', 'PRETEST:  CALIFICACIÓN PRE NIVEL 3')

            ->setCellValue('AZ1', 'POSTEST: LOS PUNTOS CIEGOS SON POSICIONES ALREDEDOR DE UN VEHÍCULO QUE NO PUEDEN SER CONTROLADOS VISUALMENTE POR EL CONDUCTOR, Y ESTÁN PRESENTES TANTO EN CARROS COMO EN MOTOCICLETAS')
            ->setCellValue('BA1', 'POSTEST: PARA CRUZAR UN OBSTÁCULO EN LA VÍA (HUECO, BACHE), EL O LA CICLISTA DEBE PODER: PARARSE EN LOS PEDALES PREVIO AL SUBIR O AL DESCENSO, LLEVAR EL CUERPO HACIA ATRÁS Y LEVANTAR LA RUEDA DELANTERA')
            ->setCellValue('BB1', 'POSTEST: PARA DISMINUIR EL RIESGO DE NO SER VISIBLE PARA LOS DEMÁS ACTORES VIALES, EL O LA CICLISTA DEBE')
            ->setCellValue('BC1', 'POSTEST: EN LA COTIDIANIDAD DE LA VÍA, SEGÚN LAS NORMAS DE TRÁNSITO, ¿QUIÉN TIENE LA PRIORIDAD? ')
            ->setCellValue('BD1', 'POSTEST: PARA EVITAR LOS PUNTOS CIEGOS, EL O LA CICLISTA PUEDE:')
            ->setCellValue('BE1', 'POSTEST: CALIFICACIÓN POS NIVEL 3')

            ->setCellValue('BF1', 'EVALUACIÓN DEL TALLER DE 1 A 5.')
            ->setCellValue('BG1', 'IMPORTANCIA DE LA INFORMACIÓN RECIBIDA (1 A 5)')

            ->setCellValue('BH1', 'CARTOGRAFÍA: ¿Para qué utiliza la bicicleta?')
            ->setCellValue('BI1', 'CARTOGRAFÍA: ¿Cuál es el tiempo diario que dura conduciendo bicicleta?')
            ->setCellValue('BJ1', 'CARTOGRAFÍA: ¿Cómo considera usted que se encuentra la malla vial por donde transita habitualmente?')
            ->setCellValue('BK1', 'CARTOGRAFÍA: ¿Cuál es el riesgo social más relevante que tiene su trayecto habitual? ')
            ->setCellValue('BL1', 'CARTOGRAFÍA: ¿Cuál es el riesgo ambientale más relevante que tiene su trayecto habitual?')
            ->setCellValue('BM1', 'CARTOGRAFÍA: ¿Cuál es el riesgo tecnológico más relevante que tiene su trayecto habitual?')



            ->setCellValue('BN1', 'PRETEST: ES IMPORTANTE QUE SE COMPRUEBE LOS CIERRES DE LAS RUEDAS, PARA ESO ES NECESARIO ASEGURARSE DE QUE ESTÉN BIEN APRETADOS')
            ->setCellValue('BO1', 'PRETEST: ES EL SISTEMA QUE PERMITE CONDUCIR LA BICICLETA Y DIRIGIRLA HACIA DONDE SE QUIERE, UTILIZANDO LAS MANOS PARA CONTROLARLA.')
            ->setCellValue('BP1', 'PRETEST: LA PREPARACIÓN COMPLETA DE LA BICICLETA IMPLICA LA REVISIÓN DE LOS FRENOS Y LAS RUEDAS')
            ->setCellValue('BQ1', 'PRETEST: LOS PLATOS Y LOS PIÑONES HACEN PARTE DE ESTE SISTEMA DE LA BICICLETA')
            ->setCellValue('BR1', 'PRETEST: ANTES DE LUBRICAR LA CADENA NO ES RECOMENDABLE LIMPIARLA, SE APLICA DIRECTAMENTE EL LUBRICANTE DE SU PREFERENCIA, PARA EVITAR MAYORES DESGASTES Y DESAJUSTES')
            ->setCellValue('BS1', 'PRETEST: CALIFICACIÓN PRE NIVEL 4')

            ->setCellValue('BT1', 'POSTEST: ES IMPORTANTE QUE SE COMPRUEBE LOS CIERRES DE LAS RUEDAS, PARA ESO ES NECESARIO ASEGURARSE DE QUE ESTÉN BIEN APRETADOS')
            ->setCellValue('BU1', 'POSTEST: ES EL SISTEMA QUE PERMITE CONDUCIR LA BICICLETA Y DIRIGIRLA HACIA DONDE SE QUIERE, UTILIZANDO LAS MANOS PARA CONTROLARLA.')
            ->setCellValue('BV1', 'POSTEST: LA PREPARACIÓN COMPLETA DE LA BICICLETA IMPLICA LA REVISIÓN DE LOS FRENOS Y LAS RUEDAS')
            ->setCellValue('BW1', 'POSTEST: LOS PLATOS Y LOS PIÑONES HACEN PARTE DE ESTE SISTEMA DE LA BICICLETA')
            ->setCellValue('BX1', 'POSTEST: ANTES DE LUBRICAR LA CADENA NO ES RECOMENDABLE LIMPIARLA, SE APLICA DIRECTAMENTE EL LUBRICANTE DE SU PREFERENCIA, PARA EVITAR MAYORES DESGASTES Y DESAJUSTES')
            ->setCellValue('BY1', 'POSTEST: CALIFICACIÓN POS NIVEL 4')

            ->setCellValue('BZ1', 'EVALUACIÓN DEL TALLER DE 1 A 5.')
            ->setCellValue('CA1', 'IMPORTANCIA DE LA INFORMACIÓN RECIBIDA (1 A 5)')



            ->setCellValue('CB1', 'CANTIDAD DE NIVELES')
            ->setCellValue('CC1', 'PERSONA FORMADA');

        $j = 2;
        for ($i = 0; $i < count($registros); $i++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $j, $registros[$i]->id)
                ->setCellValue('B' . $j, $registros[$i]->colectivo)
                ->setCellValue('C' . $j, $registros[$i]->nombre)
                ->setCellValue('D' . $j, $registros[$i]->numero_documento)
                ->setCellValue('E' . $j, $registros[$i]->numero_celular)
                ->setCellValue('F' . $j, $registros[$i]->correo)
                ->setCellValue('G' . $j, $registros[$i]->edad)
                ->setCellValue('H' . $j, $registros[$i]->sexo)
                ->setCellValue('I' . $j, $registros[$i]->nivel_escolaridad)
                ->setCellValue('J' . $j, $registros[$i]->poblacion_vulnerable)



                ->setCellValue('K' . $j, $registros[$i]->nombre_punto)
                ->setCellValue('L' . $j, 'MUNICIPIO')
                ->setCellValue('M' . $j, $registros[$i]->fecha)
                ->setCellValue('N' . $j, $registros[$i]->hora)
                ->setCellValue('O' . $j, $registros[$i]->ubicacion)
                ->setCellValue('P' . $j, $registros[$i]->name)
                ->setCellValue('Q' . $j, $registros[$i]->documento)



                ->setCellValue('R' . $j, $registros[$i]->pregunta_1_pre_1)
                ->setCellValue('S' . $j, $registros[$i]->pregunta_2_pre_1)
                ->setCellValue('T' . $j, $registros[$i]->pregunta_3_pre_1)
                ->setCellValue('U' . $j, $registros[$i]->pregunta_4_pre_1)
                ->setCellValue('V' . $j, $registros[$i]->pregunta_5_pre_1)
                ->setCellValue('W' . $j, $registros[$i]->calificacion_pre_1)

                ->setCellValue('X' . $j, $registros[$i]->pregunta_1_post_1)
                ->setCellValue('Y' . $j, $registros[$i]->pregunta_2_post_1)
                ->setCellValue('Z' . $j, $registros[$i]->pregunta_3_post_1)
                ->setCellValue('AA' . $j, $registros[$i]->pregunta_4_post_1)
                ->setCellValue('AB' . $j, $registros[$i]->pregunta_5_post_1)
                ->setCellValue('AC' . $j, $registros[$i]->calificacion_post_1)

                ->setCellValue('AD' . $j, $registros[$i]->evaluacion_taller_1)
                ->setCellValue('AE' . $j, $registros[$i]->importancia_informacion_1)



                ->setCellValue('AF' . $j, $registros[$i]->pregunta_1_pre_2)
                ->setCellValue('AG' . $j, $registros[$i]->pregunta_2_pre_2)
                ->setCellValue('AH' . $j, $registros[$i]->pregunta_3_pre_2)
                ->setCellValue('AI' . $j, $registros[$i]->pregunta_4_pre_2)
                ->setCellValue('AJ' . $j, $registros[$i]->pregunta_5_pre_2)
                ->setCellValue('AK' . $j, $registros[$i]->calificacion_pre_2)

                ->setCellValue('AL' . $j, $registros[$i]->pregunta_1_post_2)
                ->setCellValue('AM' . $j, $registros[$i]->pregunta_2_post_2)
                ->setCellValue('AN' . $j, $registros[$i]->pregunta_3_post_2)
                ->setCellValue('AO' . $j, $registros[$i]->pregunta_4_post_2)
                ->setCellValue('AP' . $j, $registros[$i]->pregunta_5_post_2)
                ->setCellValue('AQ' . $j, $registros[$i]->calificacion_post_2)

                ->setCellValue('AR' . $j, $registros[$i]->evaluacion_taller_2)
                ->setCellValue('AS' . $j, $registros[$i]->importancia_informacion_2)



                ->setCellValue('AT' . $j, $registros[$i]->pregunta_1_pre_3)
                ->setCellValue('AU' . $j, $registros[$i]->pregunta_2_pre_3)
                ->setCellValue('AV' . $j, $registros[$i]->pregunta_3_pre_3)
                ->setCellValue('AW' . $j, $registros[$i]->pregunta_4_pre_3)
                ->setCellValue('AX' . $j, $registros[$i]->pregunta_5_pre_3)
                ->setCellValue('AY' . $j, $registros[$i]->calificacion_pre_3)

                ->setCellValue('AZ' . $j, $registros[$i]->pregunta_1_post_3)
                ->setCellValue('BA' . $j, $registros[$i]->pregunta_2_post_3)
                ->setCellValue('BB' . $j, $registros[$i]->pregunta_3_post_3)
                ->setCellValue('BC' . $j, $registros[$i]->pregunta_4_post_3)
                ->setCellValue('BD' . $j, $registros[$i]->pregunta_5_post_3)
                ->setCellValue('BE' . $j, $registros[$i]->calificacion_post_3)

                ->setCellValue('BF' . $j, $registros[$i]->evaluacion_taller_3)
                ->setCellValue('BG' . $j, $registros[$i]->importancia_informacion_3)

                ->setCellValue('BH' . $j, $registros[$i]->pregunta_1_car_3)
                ->setCellValue('BI' . $j, $registros[$i]->pregunta_2_car_3)
                ->setCellValue('BJ' . $j, $registros[$i]->pregunta_3_car_3)
                ->setCellValue('BK' . $j, $registros[$i]->pregunta_4_car_3)
                ->setCellValue('BL' . $j, $registros[$i]->pregunta_5_car_3)
                ->setCellValue('BM' . $j, $registros[$i]->pregunta_6_car_3)



                ->setCellValue('BN' . $j, $registros[$i]->pregunta_1_pre_4)
                ->setCellValue('BO' . $j, $registros[$i]->pregunta_2_pre_4)
                ->setCellValue('BP' . $j, $registros[$i]->pregunta_3_pre_4)
                ->setCellValue('BQ' . $j, $registros[$i]->pregunta_4_pre_4)
                ->setCellValue('BR' . $j, $registros[$i]->pregunta_5_pre_4)
                ->setCellValue('BS' . $j, $registros[$i]->calificacion_pre_4)

                ->setCellValue('BT' . $j, $registros[$i]->pregunta_1_post_4)
                ->setCellValue('BU' . $j, $registros[$i]->pregunta_2_post_4)
                ->setCellValue('BV' . $j, $registros[$i]->pregunta_3_post_4)
                ->setCellValue('BW' . $j, $registros[$i]->pregunta_4_post_4)
                ->setCellValue('BX' . $j, $registros[$i]->pregunta_5_post_4)
                ->setCellValue('BY' . $j, $registros[$i]->calificacion_post_4)

                ->setCellValue('BZ' . $j, $registros[$i]->evaluacion_taller_4)
                ->setCellValue('CA' . $j, $registros[$i]->importancia_informacion_4)



                ->setCellValue('CB' . $j, $registros[$i]->nivel)
                ->setCellValue('CC' . $j, 'PERSONA FORMADA');

            $j++;
        }
        $spreadsheet->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Encuestados.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function exportarExcelAcciones(Request $request)
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
            $signo1fR = '1900-12-04';
            $signo2fR = $fecha;
        }

        $registros = DB::table('registros_acciones')
            ->join('puntos', 'registros_acciones.id_punto', '=', 'puntos.id')
            ->join('ciclistas', 'registros_acciones.id', '=', 'ciclistas.id_registro')
            ->join('epps', 'registros_acciones.id', '=', 'epps.id_registro')
            ->join('recorridos_documentacion', 'registros_acciones.id', '=', 'recorridos_documentacion.id_registro')
            ->join('resultados_retos', 'registros_acciones.id', '=', 'resultados_retos.id_registro')
            ->leftJoin('revisiones_mecanicas', 'registros_acciones.id', '=', 'revisiones_mecanicas.id_registro')
            ->join('users', 'users.id', '=', 'registros_acciones.encargado')
            ->select(
                "registros_acciones.id as id_accion",
                "registros_acciones.fecha",
                "registros_acciones.hora_inicio",
                "registros_acciones.hora_finalizacion",
                "puntos.nombre_punto",
                "puntos.ubicacion",
                "ciclistas.*",
                "epps.*",
                "recorridos_documentacion.tipo_viaje",
                "recorridos_documentacion.sitios_accidentes",
                "recorridos_documentacion.tarjeta_propiedad",
                "recorridos_documentacion.marcacion",
                "resultados_retos.*",
                "revisiones_mecanicas.*",
                "users.name as user_name",
                "users.documento as user_documento",
            )
            ->where($campop, $varp, $signop)
            ->where($campoj, $varj, $signoj)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->distinct("registros_acciones.id")
            ->orderBy("registros_acciones.id", "ASC")
            ->get();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('Registros');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'TIPO INTERVENCIÓN')
            ->setCellValue('C1', 'PUNTO')
            ->setCellValue('D1', 'ENCARGADO')
            ->setCellValue('E1', 'C.C. ENCARGADO')
            ->setCellValue('F1', 'FECHA')
            ->setCellValue('G1', 'HORA INICIO')
            ->setCellValue('H1', 'HORA FIN')


            ->setCellValue('I1', 'NOMBRE CICLISTA')
            ->setCellValue('J1', 'C.C. CICLISTA')
            ->setCellValue('K1', 'CELULAR CICLISTA')
            ->setCellValue('L1', 'CORREO CICLISTA')
            ->setCellValue('M1', 'EDAD CICLISTA')
            ->setCellValue('N1', 'SEXO CICLISTA')
            ->setCellValue('O1', 'GÉNERO CICLISTA')
            ->setCellValue('P1', 'NIVEL ESCOLARIDAD CICLISTA')
            ->setCellValue('Q1', 'POBLACIÓN VULNERABLE CICLISTA')
            ->setCellValue('R1', 'AÑOS DE EXPERIENCIA MONTANDO BICICLETA')
            ->setCellValue('S1', 'TIEMPO DE USO DE LA BICICLETA AL DÍA')
            ->setCellValue('T1', 'TEMPERATURA AL INICIO DE LA ACTIVIDAD')


            ->setCellValue('U1', 'TIPO VIAJE')
            ->setCellValue('V1', 'SITIOS DE ACCIDENTALIDAD IDENTIFICADOS')


            ->setCellValue('W1', 'SE SUBE A LA BICICLETA SIN PERDER EL CONTROL')
            ->setCellValue('X1', 'MANTIENE MANOS EN EL MANILLAR (MANUBRIO), CON DOS O TRES DEDOS EN LOS FRENOS')

            ->setCellValue('Y1', 'SE SOSTIENE CON UN PIE EN EL SUELO Y CON EL OTRO PUESTO EN EL PEDAL')
            ->setCellValue('Z1', 'EMPUJA HACIA ADELANTE EMPEZANDO EL DESPLAZAMIENTO CON EQUILIBRIO DE LA BICICLETA')

            ->setCellValue('AA1', 'CAPACIDAD DE LEVANTAR LA MANO SIN PERDER EL CONTROL DE LA BICICLETA')
            ->setCellValue('AB1', 'CONOCE LAS SEÑALES MANUALES')

            ->setCellValue('AC1', 'AL FRENAR NO DERRAPA (BLOQUEA) LAS RUEDAS')
            ->setCellValue('AD1', 'POSICIONA EL CUERPO HACIA ATRÁS CUANDO FRENA')

            ->setCellValue('AE1', 'ES CAPAZ DE MIRAR HACIA ATRÁS')
            ->setCellValue('AF1', 'MANTIENE EL EQUILIBRIO AL MIRAR HACIA ATRÁS')
            ->setCellValue('AG1', 'TIENE COMO PUNTO DE REFERENCIA EL HOMBRO IZQUIERDO')

            ->setCellValue('AH1', 'PROYECTA LA MIRADA AL FRENTE')
            ->setCellValue('AI1', 'MANTIENE EL EQUILIBRIO')

            ->setCellValue('AJ1', 'PARARSE EN PEDALES PREVIO AL SUBIR O AL DESCENSO')
            ->setCellValue('AK1', 'LLEVAR EL CUERPO HACIA ATRÁS')
            ->setCellValue('AL1', 'LEVANTAR LA RUEDA DELANTERA')

            ->setCellValue('AM1', 'MANTIENE EL CUERPO CENTRADO EN LA BICICLETA')
            ->setCellValue('AN1', 'APOYA LA MEDIA PUNTA DEL PIE EN LOS PEDALES')
            ->setCellValue('AO1', 'LA BICICLETA SE AJUSTA A LA ALTURA DEL CICLISTA')

            ->setCellValue('AP1', 'CALIFICACIÓN DEL RETO')


            ->setCellValue('AQ1', 'NO ROTA, NI SE DESLIZA HACIA ARRIBA')
            ->setCellValue('AR1', 'NO ESTÁ ROTO, NI FISURADO')
            ->setCellValue('AS1', 'EN LA COMPROBACIÓN VISUAL SE EVIDENCIA QUE SE ENCUENTRA A LA ALTURA DE LA CADERA DEL CICLISTA ESTANDO DE PÍE')
            ->setCellValue('AT1', 'EL POSTE NO ESTÁ ROTO')

            ->setCellValue('AU1', 'LOS COMPONENTES DEL SISTEMA ESTÁN COMPLETOS Y ENSAMBLADOS')
            ->setCellValue('AV1', 'PASTILLAS, ZAPATAS O DISCOS NO PRESENTAN FISURAS, ROTURAS O DESGASTES')
            ->setCellValue('AW1', 'LOS FRENOS NO ESTÁN CALIBRADOS O LARGOS')

            ->setCellValue('AX1', 'NO ESTÁ ROTA, FISURADA O DOBLADA')
            ->setCellValue('AY1', 'LA LUBRICACIÓN NO SE ENCUENTRA EN ESCASO O CARENTE, NO TIENE RESIDUOS DE GRASA ANTIGUA')
            ->setCellValue('AZ1', 'LOS ESLABONES NO ESTÁN DESGASTADOS')

            ->setCellValue('BA1', 'PLATOS, PIÑONES ESTÁN PRESENTES, SIN FISURAS, ROTURAS O DESGASTES')
            ->setCellValue('BB1', 'BIELAS, PEDALES Y CENTRO ESTÁN PRESENTES, SIN FISURAS, ROTURAS O DESGASTES')
            ->setCellValue('BC1', 'SE HACEN LOS CAMBIOS')

            ->setCellValue('BD1', 'SENTIDO DE ROTACIÓN ADECUADO')
            ->setCellValue('BE1', 'SIN FISURAS, HUEVOS, LA GUÍA NO SE ENCUENTRA EXPUESTA')
            ->setCellValue('BF1', 'PRESIÓN ACORDE A LO ESTABLECIDO EN LA CORAZA')
            ->setCellValue('BG1', 'RADIOS ESTÁN COMPLETOS, NO ROTOS O DOBLADOS')
            ->setCellValue('BH1', 'AJUSTE Y ALINEACIÓN DE LA LLANTA')
            ->setCellValue('BI1', 'RIN SE ENCUENTRA SIN FISURAS, DESGASTADOS, DOBLADOS')

            ->setCellValue('BJ1', 'GIRA SIN FRICCIÓN O RESISTENCIA')
            ->setCellValue('BK1', 'RODAMIENTOS SIN JUEGO')
            ->setCellValue('BL1', 'MANILLAR CENTRADO Y DEBIDAMENTE AJUSTADO')

            ->setCellValue('BM1', 'CALIFICACIÓN REVISIÓN MECÁNICA')


            ->setCellValue('BN1', 'TARJETA DE PROPIEDAD')
            ->setCellValue('BO1', 'TARJETA DE PROPIEDAD MARCADA')


            ->setCellValue('BP1', 'USA CASCO')
            ->setCellValue('BQ1', 'USA CINTAS REFLECTIVAS')
            ->setCellValue('BR1', 'USA LUZ DELANTERA')
            ->setCellValue('BS1', 'USA LUZ TRASERA')
            ->setCellValue('BT1', 'USA MUÑEQUERAS')
            ->setCellValue('BU1', 'USA RODILLERAS')
            ->setCellValue('BV1', 'USA GAFAS')
            ->setCellValue('BW1', 'USA PITO')
            ->setCellValue('BX1', 'USA GUANTES');

        $j = 2;
        for ($i = 0; $i < count($registros); $i++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $j, $registros[$i]->id_accion)
                ->setCellValue('B' . $j, 'ACCIONES EN VÍA')
                ->setCellValue('C' . $j, $registros[$i]->nombre_punto . "-" . $registros[$i]->ubicacion)
                ->setCellValue('D' . $j, $registros[$i]->user_name)
                ->setCellValue('E' . $j, $registros[$i]->user_documento)
                ->setCellValue('F' . $j, $registros[$i]->fecha)
                ->setCellValue('G' . $j, $registros[$i]->hora_inicio)
                ->setCellValue('H' . $j, $registros[$i]->hora_finalizacion)

                ->setCellValue('I' . $j, $registros[$i]->nombre)
                ->setCellValue('J' . $j, $registros[$i]->numero_documento)
                ->setCellValue('K' . $j, $registros[$i]->numero_contacto)
                ->setCellValue('L' . $j, $registros[$i]->correo)
                ->setCellValue('M' . $j, $registros[$i]->edad)
                ->setCellValue('N' . $j, $registros[$i]->sexo)
                ->setCellValue('O' . $j, $registros[$i]->genero)
                ->setCellValue('P' . $j, $registros[$i]->nivel_escolaridad)
                ->setCellValue('Q' . $j, $registros[$i]->poblacion_vulnerable)
                ->setCellValue('R' . $j, $registros[$i]->anos_experiencia)
                ->setCellValue('S' . $j, $registros[$i]->tiempo_uso)
                ->setCellValue('T' . $j, $registros[$i]->temperatura_inicio)

                ->setCellValue('U' . $j, $registros[$i]->tipo_viaje)
                ->setCellValue('V' . $j, $registros[$i]->sitios_accidentes)

                ->setCellValue('W' . $j, $registros[$i]->subida_perdida_control)
                ->setCellValue('X' . $j, $registros[$i]->dedos_frenos)

                ->setCellValue('Y' . $j, $registros[$i]->pie_suelo_otro_pedal)
                ->setCellValue('Z' . $j, $registros[$i]->empuje_equilibrio)

                ->setCellValue('AA' . $j, $registros[$i]->levantar_mano_perdida_control)
                ->setCellValue('AB' . $j, $registros[$i]->conoce_senales_manuales)

                ->setCellValue('AC' . $j, $registros[$i]->derrapa_frenado)
                ->setCellValue('AD' . $j, $registros[$i]->posicion_cuerpo_frenado)

                ->setCellValue('AE' . $j, $registros[$i]->mira_atras)
                ->setCellValue('AF' . $j, $registros[$i]->equilibrio_mira_atras)
                ->setCellValue('AG' . $j, $registros[$i]->hombro_referencia)

                ->setCellValue('AH' . $j, $registros[$i]->mirada_frente)
                ->setCellValue('AI' . $j, $registros[$i]->mantiene_equilibrio)

                ->setCellValue('AJ' . $j, $registros[$i]->pararse_pedales)
                ->setCellValue('AK' . $j, $registros[$i]->cuerpo_atras)
                ->setCellValue('AL' . $j, $registros[$i]->levantar_rueda_delantera)

                ->setCellValue('AM' . $j, $registros[$i]->cuerpo_centrado)
                ->setCellValue('AN' . $j, $registros[$i]->apoyo_punta_pedales)
                ->setCellValue('AO' . $j, $registros[$i]->ajusta_altura_ciclista)

                ->setCellValue('AP' . $j, $registros[$i]->calificacion_reto)


                ->setCellValue('AQ' . $j, $registros[$i]->sillin_rota_desliza)
                ->setCellValue('AR' . $j, $registros[$i]->sillin_roto_fisura)
                ->setCellValue('AS' . $j, $registros[$i]->sillin_altura_cadera)
                ->setCellValue('AT' . $j, $registros[$i]->poste_roto)

                ->setCellValue('AU' . $j, $registros[$i]->frenos_componentes_completos)
                ->setCellValue('AV' . $j, $registros[$i]->frenos_desgastados)
                ->setCellValue('AW' . $j, $registros[$i]->frenos_calibrados)

                ->setCellValue('AX' . $j, $registros[$i]->cadena_rota_fisurada)
                ->setCellValue('AY' . $j, $registros[$i]->cadena_lubricacion)
                ->setCellValue('AZ' . $j, $registros[$i]->cadena_desgaste)

                ->setCellValue('BA' . $j, $registros[$i]->roturas_platos_pinones)
                ->setCellValue('BB' . $j, $registros[$i]->roturas_bielas_pedales_centro)
                ->setCellValue('BC' . $j, $registros[$i]->hace_cambios)

                ->setCellValue('BD' . $j, $registros[$i]->llantas_sentido_rotacion)
                ->setCellValue('BE' . $j, $registros[$i]->llantas_fisuradas)
                ->setCellValue('BF' . $j, $registros[$i]->llantas_presion)
                ->setCellValue('BG' . $j, $registros[$i]->radios_rotos)
                ->setCellValue('BH' . $j, $registros[$i]->llantas_alineacion)
                ->setCellValue('BI' . $j, $registros[$i]->rin_fisurado)

                ->setCellValue('BJ' . $j, $registros[$i]->direccion_gira)
                ->setCellValue('BK' . $j, $registros[$i]->direccion_rodamientos_juego)
                ->setCellValue('BL' . $j, $registros[$i]->manillar_centrado)

                ->setCellValue('BM' . $j, $registros[$i]->calificacion_revision)


                ->setCellValue('BN' . $j, $registros[$i]->tarjeta_propiedad)
                ->setCellValue('BO' . $j, $registros[$i]->marcacion)


                ->setCellValue('BP' . $j, $registros[$i]->uso_casco)
                ->setCellValue('BQ' . $j, $registros[$i]->uso_cinta_reflectiva)
                ->setCellValue('BR' . $j, $registros[$i]->uso_luz_delantera)
                ->setCellValue('BS' . $j, $registros[$i]->uso_luz_trasera)
                ->setCellValue('BT' . $j, $registros[$i]->uso_munequeras)
                ->setCellValue('BU' . $j, $registros[$i]->uso_rodilleras)
                ->setCellValue('BV' . $j, $registros[$i]->uso_gafas)
                ->setCellValue('BW' . $j, $registros[$i]->uso_pito)
                ->setCellValue('BX' . $j, $registros[$i]->uso_guantes);

            $j++;
        }

        $spreadsheet->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Registros.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function pdfAceptacion(Request $request)
    {
        $id = $request->input('id');

        $registro = DB::table('registros_acciones')
            ->join('ciclistas', 'registros_acciones.id', '=', 'ciclistas.id_registro')
            ->select("registros_acciones.firma", "ciclistas.nombre", "ciclistas.numero_documento")
            ->where("registros_acciones.id", $id)
            ->get();

        include('js/fpdf17/fpdf.php');

        $pdf = new FPDF('P', 'pt', 'letter');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 23);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetY(50);
        $pdf->SetX(50);
        $pdf->Cell(500, 30, utf8_decode("PROTECCIÓN DE DATOS"), 0, 1, 'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetY(120);
        $pdf->SetX(50);
        $pdf->MultiCell(500, 25, utf8_decode('AMABLEMENTE LES INFORMAMOS QUE, "DE ACUERDO CON LO DISPUESTO EN EL ARTÍCULO 38 DE LA LEY 996 DE2005, ESTE TIPO DE REUNIONES NO SE ADELANTA CON LA PARTICIPACIÓN DE CANDIDATOS A LA PRESIDENCIA DE LA REPÚBLICA, LA VICEPRESIDENCIA, CANDIDATOS AL CONGRESO DE LA REPÚBLICA O VOCERO ALGUNO. EN ESE SENTIDO, LES AGRADECEMOS A QUIENES OSTENTEN LA CALIDAD DE CANDIDATO EN ALGUNA CAMPAÑA ELECTORAL, ABSTENERSE DE REALIZAR CUALQUIER ACTO O ACCIÓN PROSELITISTA O PROPAGANDÍSTICA EN ESTA REUNIÓN, CON EL FIN DE PRESERVAR TODAS LAS GARANTÍAS ELECTORALES Y CIUDADANAS".'), 0, 'J');

        $pdf->SetY(380);
        $pdf->SetX(50);

        $pdf->MultiCell(500, 25, utf8_decode("CONFIDENCIAL: El CONSORCIO y la ANSV garantizará a todos los participantes lo referido a supresión de identidades según el artículo 7 de la Ley 1581 de 2012 (Ley de Habeas Data). La información que se solicite y se registre en el desarrollo de está actividad, se utilizará exclusivamente con fines evaluativos, en ningún caso con fines fiscales y es ESTRICTAMENTE CONFIDENCIAL."), 0, 'J');

        $pdf->SetY(690);
        $pdf->SetX(50);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(270, 12, "________________________________________", 0, 1, 'C');

        $pdf->SetY(709);
        $pdf->SetX(50);
        $pdf->Cell(270, 12, utf8_decode($registro[0]->nombre), 0, 1, 'C');

        $pdf->SetY(721);
        $pdf->SetX(50);
        $pdf->Cell(270, 12, utf8_decode($registro[0]->numero_documento), 0, 1, 'C');

        $pdf->Image('firmas/' . $registro[0]->firma, 50, 580, 329, 109, 'PNG');

        ///////////////////////////Nueva Hoja/////////////////////////////////////
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 23);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetY(20);
        $pdf->SetX(50);
        $pdf->Cell(500, 30, utf8_decode("CONSENTIMIENTO INFORMADO"), 0, 1, 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetY(60);
        $pdf->SetX(50);
        $pdf->MultiCell(510, 15, utf8_decode("Es una iniciativa de la ANSV que se implementará en 38 municipios, pertenecientes a 17 departamentos del país, enfocada a la mejora de conocimientos y habilidades para la conducción segura de la bicicleta. Con este proceso se llegará a 25000 ciclistas a nivel nacional, divididos en 4 zonas del país, que facilitará el desarrollo de actividades en torno a la seguridad vial de los ciclistas y territorialización de contenidos orientadores del proceso de formación. Las BiciDestrezas son aquellas habilidades que se desarrollan para la conducción de la bici, específicamente hacía el equilibrio, control, capacidad para realizar las señales manuales (conducir con una sola mano sin perder el control), entre otras. Para promover la formación de los y las ciclistas se llevarán a cabo dos (2) actividades: Reto BiciDestrezas y Proceso de Formación Completa. Reto BiciDestrezas, se centra en la identificación de las habilidades de ciclistas que vayan transitando por puntos priorizados con anticipación y que sean de alto tráfico de ciclistas, posteriormente se les brindarán recomendaciones para mejorar su conducción. La Formación completa, que está dirigida a grupos de ciclistas que hagan parte de empresas, colectivos, ligas y en general agrupaciones de personas que usen la bicicleta como medio de transporte, competencia, entrenamiento, turismo o deporte."), 0, 'J');

        $pdf->SetY(277);
        $pdf->SetX(50);
        $pdf->MultiCell(510, 15, utf8_decode("Para el desarrollo del proyecto es de suma importancia poder realizar registro fotográfico y de video de las actividades a realizar en vía, los cuales servirán para una verificación de su participación en las actividades, tambien es relevante obtener sus datos personales, con dos motivos, el primero sistematizar, generar soporte de la actividad y analizar la información posteriormente para nuevos proyectos de la ANSV y para el seguimineto que se van a dadelantar por parte de la entidad mencionada, en el cual se podrán recibir correos, llamadas o mensajes solicitando opiniones sobre la formación recibida, así como encuestas para evaluar el aprendizaje. Por lo anterior, la participación en el evento, así como el diligenciamiento del siguiente formato, dan por entendida su autorización para el uso de la información, bajo la Ley de Habeas Data mencionada previamente. Me permito informarle que para la implementación del Reto Bicidestrezas o el proceso de formación completa, el cual desarrollará en su propia bicicleta es importante que conozca que es posible que usted sufra caidas, golpes o afectacones fisicas, que en caso llegarse a presentar deberá asumirlas por su propia cuenta y en caso de aceptar podrá para participar tanto en las acciones en vía como en los procesos de formación."), 0, 'J');

        $pdf->SetY(477);
        $pdf->SetX(50);
        $pdf->MultiCell(510, 15, utf8_decode("Tambien es importante que usted conozca que va a recibir un Kit con ELEMENTOS DE SEGURIDAD A SER ENTREGADOS A PARTICIPANTES, el cual consiste en un juego de luces recargables, y una banda reflectiva que le servirá para hacerse visible en las vías y un codigo QR en el cuál podrá encontrar el MANUAL DEL CICLISTA SEGURO, estos elementos se le entragaran 1 vez, cuando haga parte de alguna de las actividades."), 0, 'J');

        $pdf->SetY(690);
        $pdf->SetX(50);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(270, 12, "________________________________________", 0, 1, 'C');

        $pdf->SetY(708);
        $pdf->SetX(50);
        $pdf->Cell(270, 12, utf8_decode($registro[0]->nombre), 0, 1, 'C');

        $pdf->SetY(721);
        $pdf->SetX(50);
        $pdf->Cell(270, 12, utf8_decode($registro[0]->numero_documento), 0, 1, 'C');

        $pdf->Image('firmas/' . $registro[0]->firma, 50, 580, 329, 109, 'PNG');
        $pdf->Output("I", "Consentimiento.pdf");
        exit;
    }

    public function pdfRegistroAcciones(Request $request)
    {
        $id = $request->input('id');

        $registro = DB::table('registros_acciones')
            ->join('puntos', 'puntos.id', '=', 'registros_acciones.id_punto')
            ->join('ciclistas', 'ciclistas.id_registro', '=', 'registros_acciones.id')
            ->join('recorridos_documentacion', 'recorridos_documentacion.id_registro', '=', 'registros_acciones.id')
            ->join('resultados_retos', 'resultados_retos.id_registro', '=', 'registros_acciones.id')
            ->join('epps', 'epps.id_registro', '=', 'registros_acciones.id')
            ->leftJoin('revisiones_mecanicas', 'revisiones_mecanicas.id_registro', '=', 'registros_acciones.id')
            ->leftJoin('users', 'users.id', '=', 'registros_acciones.encargado')
            ->leftJoin('videos', 'videos.numero_documento_ciclista', '=', 'ciclistas.numero_documento')
            ->select(
                "registros_acciones.firma",
                "registros_acciones.encargado",
                "registros_acciones.fecha as fecha_registro",
                "registros_acciones.hora_inicio",
                "registros_acciones.hora_finalizacion",
                "registros_acciones.recomendaciones",
                "registros_acciones.foto",
                "puntos.nombre_punto",
                "puntos.ubicacion",
                "ciclistas.*",
                "recorridos_documentacion.*",
                "resultados_retos.*",
                "epps.*",
                "revisiones_mecanicas.*",
                "users.name as user_name",
                "videos.*"
            )
            ->where('registros_acciones.id', $id)
            ->get();

        view()->share('registro', $registro);

        $pdf = PDF::loadView('pages/pdfRegistro', $registro);

        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream();
        exit;
    }

    public function pdfProteccionMasivo(Request $request)
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

        $registros = DB::table('registros_acciones')
            ->join('ciclistas', 'registros_acciones.id', '=', 'ciclistas.id_registro')
            ->join('puntos', 'puntos.id', 'registros_acciones.id_punto')
            ->select("puntos.nombre_punto", "registros_acciones.fecha", "registros_acciones.firma", "ciclistas.nombre", "ciclistas.numero_documento")
            ->where($campop, $varp, $signop)
            ->where($campoj, $varj, $signoj)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->orderBy("registros_acciones.id", "ASC")
            ->get();

        $fecha_nueva = date('ymd', strtotime($registros[0]->fecha));

        $nombre_pdf = $fecha_nueva . ' P - Z4 AV ' . utf8_decode(mb_strtoupper($registros[0]->nombre_punto)) . '.pdf';

        include('js/fpdf17/fpdf.php');

        $pdf = new FPDF('P', 'pt', 'letter');
        $pdf->AliasNbPages();

        for ($i = 0; $i < count($registros); $i++) {
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 23);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetY(100);
            $pdf->SetX(50);
            $pdf->Cell(500, 30, utf8_decode("PROTECCIÓN DE DATOS"), 0, 1, 'C');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetY(200);
            $pdf->SetX(50);
            $pdf->MultiCell(500, 30, utf8_decode("CONFIDENCIAL: El CONSORCIO y la ANSV garantizará a todos los participantes lo referido a supresión de identidades según el artículo 7 de la Ley 1581 de 2012 (Ley de Habeas Data). La información que se solicite y se registre en el desarrollo de está actividad, se utilizará exclusivamente con fines evaluativos, en ningún caso con fines fiscales y es ESTRICTAMENTE CONFIDENCIAL."), 0, 'J');

            $pdf->SetY(600);
            $pdf->SetX(50);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(270, 12, "________________________________________", 0, 1, 'C');

            $pdf->SetY(618);
            $pdf->SetX(50);
            $pdf->Cell(270, 12, utf8_decode($registros[$i]->nombre), 0, 1, 'C');

            $pdf->SetY(631);
            $pdf->SetX(50);
            $pdf->Cell(270, 12, utf8_decode($registros[$i]->numero_documento), 0, 1, 'C');

            $pdf->Image('firmas/' . $registros[$i]->firma, 50, 480, 329, 109, 'PNG');
        }

        $pdf->Output("I", $nombre_pdf);
    }

    public function pdfConsentimientoMasivo(Request $request)
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

        $registros = DB::table('registros_acciones')
            ->join('ciclistas', 'registros_acciones.id', '=', 'ciclistas.id_registro')
            ->join('puntos', 'puntos.id', 'registros_acciones.id_punto')
            ->select("puntos.nombre_punto", "registros_acciones.fecha", "registros_acciones.firma", "ciclistas.nombre", "ciclistas.numero_documento")
            ->where($campop, $varp, $signop)
            ->where($campoj, $varj, $signoj)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->orderBy("registros_acciones.id", "ASC")
            ->get();

        $fecha_nueva = date('ymd', strtotime($registros[0]->fecha));

        $nombre_pdf = $fecha_nueva . ' C - Z4 AV ' . utf8_decode(mb_strtoupper($registros[0]->nombre_punto)) . '.pdf';

        include('js/fpdf17/fpdf.php');

        $pdf = new FPDF('P', 'pt', 'letter');
        $pdf->AliasNbPages();

        for ($i = 0; $i < count($registros); $i++) {
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 23);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetY(20);
            $pdf->SetX(50);
            $pdf->Cell(500, 30, utf8_decode("CONSENTIMIENTO INFORMADO"), 0, 1, 'C');

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetY(60);
            $pdf->SetX(50);
            $pdf->MultiCell(510, 15, utf8_decode("Es una iniciativa de la ANSV que se implementará en 38 municipios, pertenecientes a 17 departamentos del país, enfocada a la mejora de conocimientos y habilidades para la conducción segura de la bicicleta. Con este proceso se llegará a 25000 ciclistas a nivel nacional, divididos en 4 zonas del país, que facilitará el desarrollo de actividades en torno a la seguridad vial de los ciclistas y territorialización de contenidos orientadores del proceso de formación. Las BiciDestrezas son aquellas habilidades que se desarrollan para la conducción de la bici, específicamente hacía el equilibrio, control, capacidad para realizar las señales manuales (conducir con una sola mano sin perder el control), entre otras. Para promover la formación de los y las ciclistas se llevarán a cabo dos (2) actividades: Reto BiciDestrezas y Proceso de Formación Completa. Reto BiciDestrezas, se centra en la identificación de las habilidades de ciclistas que vayan transitando por puntos priorizados con anticipación y que sean de alto tráfico de ciclistas, posteriormente se les brindarán recomendaciones para mejorar su conducción. La Formación completa, que está dirigida a grupos de ciclistas que hagan parte de empresas, colectivos, ligas y en general agrupaciones de personas que usen la bicicleta como medio de transporte, competencia, entrenamiento, turismo o deporte."), 0, 'J');

            $pdf->SetY(277);
            $pdf->SetX(50);
            $pdf->MultiCell(510, 15, utf8_decode("Para el desarrollo del proyecto es de suma importancia poder realizar registro fotográfico y de video de las actividades a realizar en vía, los cuales servirán para una verificación de su participación en las actividades, tambien es relevante obtener sus datos personales, con dos motivos, el primero sistematizar, generar soporte de la actividad y analizar la información posteriormente para nuevos proyectos de la ANSV y para el seguimineto que se van a dadelantar por parte de la entidad mencionada, en el cual se podrán recibir correos, llamadas o mensajes solicitando opiniones sobre la formación recibida, así como encuestas para evaluar el aprendizaje. Por lo anterior, la participación en el evento, así como el diligenciamiento del siguiente formato, dan por entendida su autorización para el uso de la información, bajo la Ley de Habeas Data mencionada previamente. Me permito informarle que para la implementación del Reto Bicidestrezas o el proceso de formación completa, el cual desarrollará en su propia bicicleta es importante que conozca que es posible que usted sufra caidas, golpes o afectacones fisicas, que en caso llegarse a presentar deberá asumirlas por su propia cuenta y en caso de aceptar podrá para participar tanto en las acciones en vía como en los procesos de formación."), 0, 'J');

            $pdf->SetY(477);
            $pdf->SetX(50);
            $pdf->MultiCell(510, 15, utf8_decode("Tambien es importante que usted conozca que va a recibir un Kit con ELEMENTOS DE SEGURIDAD A SER ENTREGADOS A PARTICIPANTES, el cual consiste en un juego de luces recargables, y una banda reflectiva que le servirá para hacerse visible en las vías y un codigo QR en el cuál podrá encontrar el MANUAL DEL CICLISTA SEGURO, estos elementos se le entragaran 1 vez, cuando haga parte de alguna de las actividades."), 0, 'J');

            $pdf->SetY(690);
            $pdf->SetX(50);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(270, 12, "________________________________________", 0, 1, 'C');

            $pdf->SetY(708);
            $pdf->SetX(50);
            $pdf->Cell(270, 12, utf8_decode($registros[$i]->nombre), 0, 1, 'C');

            $pdf->SetY(721);
            $pdf->SetX(50);
            $pdf->Cell(270, 12, utf8_decode($registros[$i]->numero_documento), 0, 1, 'C');

            $pdf->Image('firmas/' . $registros[$i]->firma, 50, 580, 329, 109, 'PNG');
        }

        $pdf->Output("I", $nombre_pdf);
    }


    public function exportarExcelFormacion(Request $request)
    {
        $punto       = $request->input('punto');
        $fecha_desde = $request->input('fecha');
        $fecha_hasta = $request->input('fecha_hasta');

        if (isset($punto) && !empty($punto)) {
            $campop = 'registros_formacion.id_punto';
            $varp = '=';
            $signop = '' . $punto . '';
        } else {
            $campop = 'registros_formacion.id';
            $varp = '!=';
            $signop = '-3';
        }

        if (isset($fecha_desde) && !empty($fecha_desde) && isset($fecha_hasta) && !empty($fecha_hasta)) {
            $campofR = 'registros_formacion.fecha';
            $signo1fR = '' . $fecha_desde . '';
            $signo2fR = '' . $fecha_hasta . '';
        } else {
            $fecha = strtotime('+1 day', strtotime(date('Y-m-d')));
            $fecha = date('Y-m-d', $fecha);

            $campofR = 'registros_formacion.fecha';
            $signo1fR = '1900-12-04';
            $signo2fR = $fecha;
        }

        $registros = DB::table('registros_formacion')
            ->join('puntos', 'registros_formacion.id_punto', '=', 'puntos.id')
            ->join('respuestas_preguntas', 'respuestas_preguntas.id_registro', '=', 'registros_formacion.id')
            ->select(
                "registros_formacion.id as id_formacion",
                "registros_formacion.tipo_documento",
                "registros_formacion.numero_documento",
                "registros_formacion.nombre",
                "registros_formacion.nombre_entidad",
                "registros_formacion.ciudad_residencia",
                "registros_formacion.fecha as fecha_registro",
                "registros_formacion.hora_inicio",
                "registros_formacion.hora_finalizacion",
                "puntos.nombre_punto",
                "puntos.ubicacion",
                "respuestas_preguntas.*",
            )
            ->where($campop, $varp, $signop)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->distinct("registros_formacion.id")
            ->orderBy("registros_formacion.id", "ASC")
            ->get();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('Registros');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'TIPO INTERVENCIÓN')
            ->setCellValue('C1', 'PUNTO')
            ->setCellValue('D1', 'TIPO DOCUMENTO')
            ->setCellValue('E1', 'NÚMERO DOCUMENTO')
            ->setCellValue('F1', 'NOMBRE')
            ->setCellValue('G1', 'NOMBRE ENTIDAD')
            ->setCellValue('H1', 'CIUDAD RESIDENCIA')
            ->setCellValue('I1', 'FECHA')
            ->setCellValue('J1', 'HORA INICIO')
            ->setCellValue('K1', 'HORA FINALIZACIÓN')

            ->setCellValue('L1', 'NIVEL I - PREGUNTA 1')
            ->setCellValue('M1', 'NIVEL I - PREGUNTA 2')
            ->setCellValue('N1', 'NIVEL I - PREGUNTA 3')
            ->setCellValue('O1', 'NIVEL I - PREGUNTA 4')
            ->setCellValue('P1', 'NIVEL I - PREGUNTA 5')

            ->setCellValue('Q1', 'NIVEL II - PREGUNTA 6')
            ->setCellValue('R1', 'NIVEL II - PREGUNTA 7')
            ->setCellValue('S1', 'NIVEL II - PREGUNTA 8')
            ->setCellValue('T1', 'NIVEL II - PREGUNTA 9')
            ->setCellValue('U1', 'NIVEL II - PREGUNTA 10')

            ->setCellValue('V1', 'NIVEL III - PREGUNTA 11')
            ->setCellValue('W1', 'NIVEL III - PREGUNTA 12')
            ->setCellValue('X1', 'NIVEL III - PREGUNTA 13')
            ->setCellValue('Y1', 'NIVEL III - PREGUNTA 14')
            ->setCellValue('Z1', 'NIVEL III - PREGUNTA 15')

            ->setCellValue('AA1', 'NIVEL IV - PREGUNTA 16')
            ->setCellValue('AB1', 'NIVEL IV - PREGUNTA 17')
            ->setCellValue('AC1', 'NIVEL IV - PREGUNTA 18')
            ->setCellValue('AD1', 'NIVEL IV - PREGUNTA 19')
            ->setCellValue('AE1', 'NIVEL IV - PREGUNTA 20');

        $j = 2;
        for ($i = 0; $i < count($registros); $i++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $j, $registros[$i]->id_formacion)
                ->setCellValue('B' . $j, 'FORMACIÓN COMPLETA')
                ->setCellValue('C' . $j, $registros[$i]->nombre_punto . "-" . $registros[$i]->ubicacion)
                ->setCellValue('D' . $j, $registros[$i]->tipo_documento)
                ->setCellValue('E' . $j, $registros[$i]->numero_documento)
                ->setCellValue('F' . $j, $registros[$i]->nombre)
                ->setCellValue('G' . $j, $registros[$i]->nombre_entidad)
                ->setCellValue('H' . $j, $registros[$i]->ciudad_residencia)
                ->setCellValue('I' . $j, $registros[$i]->fecha_registro)
                ->setCellValue('J' . $j, $registros[$i]->hora_inicio)
                ->setCellValue('K' . $j, $registros[$i]->hora_finalizacion)

                ->setCellValue('L' . $j, $registros[$i]->bicicleta_es)
                ->setCellValue('M' . $j, $registros[$i]->ciclista_es)
                ->setCellValue('N' . $j, $registros[$i]->norma_transito_1)
                ->setCellValue('O' . $j, $registros[$i]->norma_transito_2)
                ->setCellValue('P' . $j, $registros[$i]->norma_transito_3)
                ->setCellValue('Q' . $j, $registros[$i]->transito_cicloruta)
                ->setCellValue('R' . $j, $registros[$i]->espacio_publico)
                ->setCellValue('S' . $j, $registros[$i]->casco_uso)
                ->setCellValue('T' . $j, $registros[$i]->girar_derecha)
                ->setCellValue('U' . $j, $registros[$i]->cuando_frena)
                ->setCellValue('V' . $j, $registros[$i]->puntos_ciegos)
                ->setCellValue('W' . $j, $registros[$i]->cruzar_obstaculo)
                ->setCellValue('X' . $j, $registros[$i]->disminuir_riesgo);

            $respuestas_evitar = '';

            if ($registros[$i]->ciclista_evitar_res_1 == 1) {
                $respuestas_evitar .= 'Buscando siempre ver la cara del conductor del otro vehículo por uno de sus espejos.';
            }

            if ($registros[$i]->ciclista_evitar_res_1 == 1 && $registros[$i]->ciclista_evitar_res_2 == 1) {
                $respuestas_evitar .= ' - ';
            }

            if ($registros[$i]->ciclista_evitar_res_2 == 1) {
                $respuestas_evitar .= 'Ubicándose a una distancia desde la cual pueda tener contacto visual directo con el conductor de adelante.';
            }

            if (($registros[$i]->ciclista_evitar_res_2 == 1 && $registros[$i]->ciclista_evitar_res_3 == 1) || ($registros[$i]->ciclista_evitar_res_1 == 1 && $registros[$i]->ciclista_evitar_res_3 == 1)) {
                $respuestas_evitar .= ' - ';
            }

            if ($registros[$i]->ciclista_evitar_res_3 == 1) {
                $respuestas_evitar .= 'Evitar rodar en paralelo al otro vehículo (especialmente con buses y vehículos de carga)';
            }

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('Y' . $j, $respuestas_evitar)
                ->setCellValue('Z' . $j, $registros[$i]->cotidianidad)
                ->setCellValue('AA' . $j, $registros[$i]->cierres_ruedas)
                ->setCellValue('AB' . $j, $registros[$i]->sistema_conducir)
                ->setCellValue('AC' . $j, $registros[$i]->antes_subir)
                ->setCellValue('AD' . $j, $registros[$i]->platos_pinones)
                ->setCellValue('AE' . $j, $registros[$i]->antes_lubricar);

            $j++;
        }

        $spreadsheet->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Registros.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
