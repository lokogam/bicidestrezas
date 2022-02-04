<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Alignment;

use FPDF;
use PDF;

class InventarioController extends Controller
{
    public function selected_municipio(Request $request)
    {
        $municipios = DB::table('municipios')->where('id_depto', $request->input('id'))->orderby('nombre_mpio', 'ASC')->get();

        echo "<option value='0'>Seleccione una opcion</option>";

        foreach ($municipios as $municipio) {
            echo "<option value='" . $municipio->id . "'>" . $municipio->nombre_mpio . "</option>";
        }
    }

    public function formInventario()
    {
        $id_usuario = Auth::user()->id;

        $punto_user = DB::table('puntos_users')->where('users_id', $id_usuario)->get();

        if (count($punto_user) == 0) {
            return redirect('/formulario/acciones');
        }

        $departamentos = DB::table('departamentos')->get();

        $municipios = DB::table('municipios')->get();

        $puntos = DB::table('puntos')->get();

        $especificaciones = DB::table('chequeo_items')->where('chequeo_categorias_id', 1)->where('status', 1)->get();

        $elementos_revision = DB::table('chequeo_items')->where('chequeo_categorias_id', 2)->where('status', 1)->get();

        $elementos_reto = DB::table('chequeo_items')->where('chequeo_categorias_id', 3)->where('status', 1)->get();

        $elementos_adicionales = DB::table('chequeo_items')->where('chequeo_categorias_id', 4)->where('status', 1)->get();

        $permisos = DB::table('chequeo_items')->where('chequeo_categorias_id', 5)->where('status', 1)->get();

        $elementos_gestion = DB::table('chequeo_items')->where('chequeo_categorias_id', 6)->where('status', 1)->get();

        $control_asistencia = DB::table('chequeo_items')->where('chequeo_categorias_id', 7)->where('status', 1)->get();

        $kit_higiene = DB::table('chequeo_items')->where('chequeo_categorias_id', 8)->where('status', 1)->get();

        return view('inventario/formulario_inventario', [
            "departamentos" => $departamentos,
            "municipios" => $municipios,
            "puntos" => $puntos,
            "especificaciones" => $especificaciones,
            "elementos_revision" => $elementos_revision,
            "elementos_reto" => $elementos_reto,
            "elementos_adicionales" => $elementos_adicionales,
            "permisos" => $permisos,
            "elementos_gestion" => $elementos_gestion,
            "control_asistencia" => $control_asistencia,
            "kit_higiene" => $kit_higiene
        ]);
    }

    public function guardarInventario(Request $request)
    {
        $img      = $request->input('base64');
        $img      = str_replace('data:image/png;base64,', '', $img);
        $fileData = base64_decode($img);
        $fileName = 'chequeo_' . $request->input('fecha') . '_' . $request->input('ubicacion_punto') . '_' . Auth::id() . '.png';

        file_put_contents('firmas/' . $fileName, $fileData);

        DB::table('chequeo_registros')->insert(array(array(
            'fecha'            => $request->input('fecha'),
            'hora'             => date('H:i:s'),
            'hora_desde'       => $request->input('hora_desde') . $request->input('minutos_desde'),
            'hora_hasta'       => $request->input('hora_hasta') . $request->input('minutos_hasta'),
            'puntos_id'        => $request->input('ubicacion_punto'),
            'users_id'         => Auth::id(),
            'firma'            => $fileName,
            'nombre_tecnico'   => $request->input('nombre_tecnico'),
        )));

        $cons_inventario = DB::table('chequeo_registros')
            ->where('users_id', Auth::id())
            ->max('id');

        $especificaciones = DB::table('chequeo_items')->where('chequeo_categorias_id', 1)->where('status', 1)->get();

        for ($i = 0; $i <= count($especificaciones) - 1; $i++) {
            DB::table('chequeo_respuestas')->insert(array(array(
                'chequeo_items_id'     => $especificaciones[$i]->id,
                'chequeo_registros_id' => $cons_inventario,
                'respuesta'            => $request->input('especificacion' . $especificaciones[$i]->id),
                'observacion'          => $request->input('especificacion_observacion' . $especificaciones[$i]->id)
            )));
        }

        $elementos_revision = DB::table('chequeo_items')->where('chequeo_categorias_id', 2)->where('status', 1)->get();

        for ($i = 0; $i <= count($elementos_revision) - 1; $i++) {
            DB::table('chequeo_respuestas')->insert(array(array(
                'chequeo_items_id'     => $elementos_revision[$i]->id,
                'chequeo_registros_id' => $cons_inventario,
                'respuesta'            => $request->input('elemento_revision' . $elementos_revision[$i]->id),
                'observacion'          => $request->input('elemento_revision_observacion' . $elementos_revision[$i]->id)
            )));
        }

        $elementos_reto = DB::table('chequeo_items')->where('chequeo_categorias_id', 3)->where('status', 1)->get();

        for ($i = 0; $i <= count($elementos_reto) - 1; $i++) {
            DB::table('chequeo_respuestas')->insert(array(array(
                'chequeo_items_id'     => $elementos_reto[$i]->id,
                'chequeo_registros_id' => $cons_inventario,
                'respuesta'            => $request->input('elemento_reto' . $elementos_reto[$i]->id),
                'observacion'          => $request->input('elemento_reto_observacion' . $elementos_reto[$i]->id)
            )));
        }

        $elementos_adicionales = DB::table('chequeo_items')->where('chequeo_categorias_id', 4)->where('status', 1)->get();

        for ($i = 0; $i <= count($elementos_adicionales) - 1; $i++) {
            DB::table('chequeo_respuestas')->insert(array(array(
                'chequeo_items_id'     => $elementos_adicionales[$i]->id,
                'chequeo_registros_id' => $cons_inventario,
                'respuesta'            => $request->input('elemento_adicional' . $elementos_adicionales[$i]->id),
                'observacion'          => $request->input('elemento_adicional_observacion' . $elementos_adicionales[$i]->id)
            )));
        }

        $permisos = DB::table('chequeo_items')->where('chequeo_categorias_id', 5)->where('status', 1)->get();

        for ($i = 0; $i <= count($permisos) - 1; $i++) {
            DB::table('chequeo_respuestas')->insert(array(array(
                'chequeo_items_id'     => $permisos[$i]->id,
                'chequeo_registros_id' => $cons_inventario,
                'respuesta'            => $request->input('permiso' . $permisos[$i]->id),
                'observacion'          => $request->input('permiso_observacion' . $permisos[$i]->id)
            )));
        }

        $elementos_gestion = DB::table('chequeo_items')->where('chequeo_categorias_id', 6)->where('status', 1)->get();

        for ($i = 0; $i <= count($elementos_gestion) - 1; $i++) {
            DB::table('chequeo_respuestas')->insert(array(array(
                'chequeo_items_id'     => $elementos_gestion[$i]->id,
                'chequeo_registros_id' => $cons_inventario,
                'respuesta'            => $request->input('elemento_gestion' . $elementos_gestion[$i]->id),
                'observacion'          => $request->input('elemento_gestion_observacion' . $elementos_gestion[$i]->id)
            )));
        }

        $control_asistencia = DB::table('chequeo_items')->where('chequeo_categorias_id', 7)->where('status', 1)->get();

        for ($i = 0; $i <= count($control_asistencia) - 1; $i++) {
            DB::table('chequeo_respuestas')->insert(array(array(
                'chequeo_items_id'     => $control_asistencia[$i]->id,
                'chequeo_registros_id' => $cons_inventario,
                'respuesta'            => $request->input('control_asistencia' . $control_asistencia[$i]->id),
                'observacion'          => $request->input('control_asistencia_observacion' . $control_asistencia[$i]->id)
            )));
        }

        $kit_higiene = DB::table('chequeo_items')->where('chequeo_categorias_id', 8)->where('status', 1)->get();

        for ($i = 0; $i <= count($kit_higiene) - 1; $i++) {
            DB::table('chequeo_respuestas')->insert(array(array(
                'chequeo_items_id'     => $kit_higiene[$i]->id,
                'chequeo_registros_id' => $cons_inventario,
                'respuesta'            => $request->input('kit_higiene' . $kit_higiene[$i]->id),
                'observacion'          => $request->input('kit_higiene_observacion' . $kit_higiene[$i]->id)
            )));
        }

        return redirect('chequeo/guardado');
    }

    public function verInventario(Request $request)
    {
        $puntoC = $request->input('puntoC');
        $fechaC = $request->input('fechaC');

        if (isset($puntoC) && !empty($puntoC)) {
            $campopC = 'chequeo_registros.puntos_id';
            $varpC = '=';
            $signopC = '' . $puntoC . '';
        } else {
            $campopC = 'chequeo_registros.id';
            $varpC = '!=';
            $signopC = '-3';
        }

        if (isset($fechaC) && !empty($fechaC)) {
            $campofC = 'chequeo_registros.fecha';
            $varfC = 'LIKE';
            $signofC = '%' . $fechaC . '%';
        } else {
            $campofC = 'chequeo_registros.id';
            $varfC = '!=';
            $signofC = '-3';
        }

        $puntos = DB::table('puntos')->get();

        $inventario = DB::table('chequeo_registros')
            ->join('users', 'users.id', '=', 'chequeo_registros.users_id')
            ->join('puntos', 'puntos.id', '=', 'chequeo_registros.puntos_id')
            ->where($campopC, $varpC, $signopC)
            ->where($campofC, $varfC, $signofC)
            ->select('chequeo_registros.*', 'users.name', 'puntos.nombre_punto', 'puntos.ubicacion')
            ->orderby('chequeo_registros.id', 'desc')
            ->paginate(14);

        $conteoC = DB::table('chequeo_registros')
            ->join('users', 'users.id', '=', 'chequeo_registros.users_id')
            ->join('puntos', 'puntos.id', '=', 'chequeo_registros.puntos_id')
            ->where($campopC, $varpC, $signopC)
            ->where($campofC, $varfC, $signofC)
            ->select('chequeo_registros.*', 'users.name', 'puntos.nombre_punto', 'puntos.ubicacion')
            ->get();

        if ($request->input('filtro') && $request->input('filtro') == 1) {
            return view('inventario.tabla_inventario')
                ->with('inventario', $inventario)
                ->with('puntos', $puntos)
                ->with('conteoC', $conteoC);
        }

        return view('inventario/ver_inventario', [
            'inventario' => $inventario,
            'conteoC'    => $conteoC,
            'puntos'     => $puntos
        ]);
    }

    public function detalleInventario(Request $request)
    {
        $chequeo_registros = DB::table('chequeo_registros')
            ->join('puntos', 'puntos.id', '=', 'chequeo_registros.puntos_id')
            ->join('users', 'users.id', '=', 'chequeo_registros.users_id')
            ->select('chequeo_registros.*', 'users.name', 'puntos.nombre_punto', 'puntos.ubicacion')
            ->where('chequeo_registros.id', $request->input('id'))->get();

        $especificaciones = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 1)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        $elementos_revision = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 2)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        $elementos_reto = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 3)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        $elementos_adicionales = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 4)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        $permisos = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 5)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        $elementos_gestion = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 6)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();


        $control_asistencia = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 7)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        $kit_higiene = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 8)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        return view('inventario/detalle_inventario', [
            'chequeo_registros' => $chequeo_registros,
            'especificaciones'  => $especificaciones,
            'elementos_revision' => $elementos_revision,
            'elementos_reto' => $elementos_reto,
            'elementos_adicionales' => $elementos_adicionales,
            'permisos' => $permisos,
            'elementos_gestion' => $elementos_gestion,
            'control_asistencia' => $control_asistencia,
            'kit_higiene' => $kit_higiene
        ]);
    }

    public function exportarExcelInventario(Request $request)
    {
        $punto       = $request->input('punto');
        $fecha_desde = $request->input('fecha');
        $fecha_hasta = $request->input('fecha_hasta');

        if (isset($punto) && !empty($punto)) {
            $campop = 'chequeo_registros.puntos_id';
            $varp = '=';
            $signop = '' . $punto . '';
        } else {
            $campop = 'chequeo_registros.id';
            $varp = '!=';
            $signop = '-3';
        }

        if (isset($fecha_desde) && !empty($fecha_desde) && isset($fecha_hasta) && !empty($fecha_hasta)) {
            $fecha = strtotime('+1 day', strtotime($fecha_hasta));
            $fecha = date('Y-m-d', $fecha);

            $campofR = 'chequeo_registros.fecha';
            $signo1fR = '' . $fecha_desde . '';
            $signo2fR = '' . $fecha . '';
        } else {
            $fecha = strtotime('+1 day', strtotime(date('Y-m-d')));
            $fecha = date('Y-m-d', $fecha);

            $campofR = 'chequeo_registros.fecha';
            $signo1fR = '1900-12-04';
            $signo2fR = $fecha;
        }

        $registros = DB::table('chequeo_registros')
            ->join('puntos', 'chequeo_registros.puntos_id', '=', 'puntos.id')
            ->join('users', 'chequeo_registros.users_id', '=', 'users.id')
            ->where($campop, $varp, $signop)
            ->whereBetween($campofR, array($signo1fR, $signo2fR))
            ->select(
                "chequeo_registros.id",
                "chequeo_registros.fecha",
                "chequeo_registros.hora",
                "chequeo_registros.hora_desde",
                "chequeo_registros.hora_hasta",
                "puntos.nombre_punto",
                "puntos.ubicacion",
                "users.name",
            )
            ->orderBy("chequeo_registros.id", "ASC")
            ->get();


        $especificaciones = DB::table('chequeo_items')->where('chequeo_categorias_id', 1)->where('status', 1)->get();

        $elementos_revision = DB::table('chequeo_items')->where('chequeo_categorias_id', 2)->where('status', 1)->get();

        $elementos_reto = DB::table('chequeo_items')->where('chequeo_categorias_id', 3)->where('status', 1)->get();

        $elementos_adicionales = DB::table('chequeo_items')->where('chequeo_categorias_id', 4)->where('status', 1)->get();

        $permisos = DB::table('chequeo_items')->where('chequeo_categorias_id', 5)->where('status', 1)->get();

        $elementos_gestion = DB::table('chequeo_items')->where('chequeo_categorias_id', 6)->where('status', 1)->get();


        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('Registros Lista de Chequeo');

        $spreadsheet->setActiveSheetIndex(0)->mergeCells("A1:F1");

        $estilo_encabezados = array(
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            )
        );

        $spreadsheet->setActiveSheetIndex(0)->setCellValue("A1", 'DATOS LISTA CHEQUEO');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'ID')
            ->setCellValue('B2', 'FECHA')
            ->setCellValue('C2', 'HORA DESDE')
            ->setCellValue('D2', 'HORA HASTA')
            ->setCellValue('E2', 'PUNTO')
            ->setCellValue('F2', 'USUARIO');

        $s = 'G';

        for ($n = 0; $n < count($especificaciones); $n++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($s . '2', strtoupper($especificaciones[$n]->item));

            if ($n < count($especificaciones)) {
                $merge_especificaciones = $s . '1';
            }

            ++$s;
        }

        $spreadsheet->setActiveSheetIndex(0)->mergeCells("G1:" . $merge_especificaciones);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue("G1", 'ESPECIFICACIONES LOGÍSTICAS PARA LAS ACCIONES EN VÍA');


        $merge_revision_1 = $s . "1";

        for ($n = 0; $n < count($elementos_revision); $n++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($s . '2', strtoupper($elementos_revision[$n]->item));

            if ($n < count($elementos_revision)) {
                $merge_revision_2 = $s . '1';
            }

            ++$s;
        }

        $spreadsheet->setActiveSheetIndex(0)->mergeCells($merge_revision_1 . ":" . $merge_revision_2);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue($merge_revision_1, 'ELEMENTOS REVISIÓN MECÁNICA');


        $merge_reto_1 = $s . "1";

        for ($n = 0; $n < count($elementos_reto); $n++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($s . '2', strtoupper($elementos_reto[$n]->item));

            if ($n < count($elementos_reto)) {
                $merge_reto_2 = $s . '1';
            }

            ++$s;
        }

        $spreadsheet->setActiveSheetIndex(0)->mergeCells($merge_reto_1 . ":" . $merge_reto_2);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue($merge_reto_1, 'ELEMENTOS RETO');


        $merge_adicionales_1 = $s . "1";

        for ($n = 0; $n < count($elementos_adicionales); $n++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($s . '2', strtoupper($elementos_adicionales[$n]->item));

            if ($n < count($elementos_adicionales)) {
                $merge_adicionales_2 = $s . '1';
            }

            ++$s;
        }

        $spreadsheet->setActiveSheetIndex(0)->mergeCells($merge_adicionales_1 . ":" . $merge_adicionales_2);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue($merge_adicionales_1, 'ELEMENTOS ADICIONALES');


        $merge_permisos_1 = $s . "1";

        for ($n = 0; $n < count($permisos); $n++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($s . '2', strtoupper($permisos[$n]->item));

            if ($n < count($permisos)) {
                $merge_permisos_2 = $s . '1';
            }

            ++$s;
        }

        $spreadsheet->setActiveSheetIndex(0)->mergeCells($merge_permisos_1 . ":" . $merge_permisos_2);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue($merge_permisos_1, 'PERMISOS');


        $merge_gestion_1 = $s . "1";

        for ($n = 0; $n < count($elementos_gestion); $n++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($s . '2', strtoupper($elementos_gestion[$n]->item));

            if ($n < count($elementos_gestion)) {
                $merge_gestion_2 = $s . '1';
            }

            ++$s;
        }

        $spreadsheet->setActiveSheetIndex(0)->mergeCells($merge_gestion_1 . ":" . $merge_gestion_2);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue($merge_gestion_1, 'ELEMENTOS DE GESTIÓN DE RIESGOS');


        $spreadsheet->setActiveSheetIndex(0)->getStyle('A1:' . $s . '1')->applyFromArray($estilo_encabezados);

        $total_items = count($especificaciones) + count($elementos_revision) + count($elementos_reto) + count($elementos_adicionales) + count($permisos) + count($elementos_gestion);


        $j = 3;

        for ($i = 0; $i < count($registros); $i++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $j, $registros[$i]->id)
                ->setCellValue('B' . $j, $registros[$i]->fecha)
                ->setCellValue('C' . $j, $registros[$i]->hora_desde)
                ->setCellValue('D' . $j, $registros[$i]->hora_hasta)
                ->setCellValue('E' . $j, $registros[$i]->nombre_punto . "-" . $registros[$i]->ubicacion)
                ->setCellValue('F' . $j, $registros[$i]->name);

            $registro_respuestas = DB::table('chequeo_respuestas')->where('chequeo_registros_id', $registros[$i]->id)->get();

            $s = 'G';

            for ($n = 0; $n < $total_items; $n++) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($s . $j, $registro_respuestas[$n]->respuesta . '-' . $registro_respuestas[$n]->observacion);

                ++$s;
            }

            $j++;
        }

        $spreadsheet->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Registros.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function pdfRegistroInventario(Request $request)
    {
        $chequeo_registros = DB::table('chequeo_registros')
            ->join('puntos', 'puntos.id', '=', 'chequeo_registros.puntos_id')
            ->join('users', 'users.id', '=', 'chequeo_registros.users_id')
            ->select('chequeo_registros.*', 'users.name', 'users.documento', 'puntos.nombre_punto', 'puntos.ubicacion')
            ->where('chequeo_registros.id', $request->input('id'))->get();

        $especificaciones = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 1)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        $elementos_revision = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 2)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        $elementos_reto = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 3)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        $elementos_adicionales = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 4)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        $permisos = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 5)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        $elementos_gestion = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 6)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();


        $control_asistencia = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 7)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        $kit_higiene = DB::table('chequeo_respuestas')
            ->join('chequeo_items', 'chequeo_items.id', '=', 'chequeo_respuestas.chequeo_items_id')
            ->where('chequeo_registros_id', $request->input('id'))
            ->where('chequeo_items.chequeo_categorias_id', 8)
            ->select('chequeo_respuestas.*', 'chequeo_items.item')
            ->get();

        view()->share('chequeo_registros', $chequeo_registros);
        view()->share('especificaciones', $especificaciones);
        view()->share('elementos_revision', $elementos_revision);
        view()->share('elementos_reto', $elementos_reto);
        view()->share('elementos_adicionales', $elementos_adicionales);
        view()->share('permisos', $permisos);
        view()->share('elementos_gestion', $elementos_gestion);
        view()->share('control_asistencia', $control_asistencia);
        view()->share('kit_higiene', $kit_higiene);

        $pdf = PDF::loadView('inventario/pdfRegistro', $chequeo_registros);

        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream();
        exit;
    }

    public function pdfChequeos(Request $request)
    {
        $puntoC = $request->input('punto');
        $fechaC = $request->input('fecha');

        if (isset($puntoC) && !empty($puntoC)) {
            $campopC = 'chequeo_registros.puntos_id';
            $varpC = '=';
            $signopC = '' . $puntoC . '';
        } else {
            $campopC = 'chequeo_registros.id';
            $varpC = '!=';
            $signopC = '-3';
        }

        if (isset($fechaC) && !empty($fechaC)) {
            $campofC = 'chequeo_registros.fecha';
            $varfC = 'LIKE';
            $signofC = '%' . $fechaC . '%';
        } else {
            $campofC = 'chequeo_registros.id';
            $varfC = '!=';
            $signofC = '-3';
        }

        $inventario = DB::table('chequeo_registros')
            ->join('users', 'users.id', '=', 'chequeo_registros.users_id')
            ->join('puntos', 'puntos.id', '=', 'chequeo_registros.puntos_id')
            ->where($campopC, $varpC, $signopC)
            ->where($campofC, $varfC, $signofC)
            ->select('chequeo_registros.*', 'users.name', 'users.documento', 'puntos.nombre_punto', 'puntos.ubicacion')
            ->orderby('chequeo_registros.id', 'desc')
            ->get();

        $fecha_nueva = date('ymd', strtotime($inventario[0]->fecha)); 

        $nombre_pdf = $fecha_nueva.' RD Z4 AV '.utf8_decode(mb_strtoupper($inventario[0]->nombre_punto)).'.pdf';

        view()->share('chequeos_registros', $inventario);

        $pdf = PDF::loadView('inventario/pdfRegistros', $inventario);

        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream($nombre_pdf);
        exit;
    }
}
