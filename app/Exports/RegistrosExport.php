<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class RegistrosExport implements FromCollection,WithHeadings
{

    public function headings():array
    {
        return[
            
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $registros = DB::table('registros')
                    ->join('tipo_vehiculos', 'registros.tipo_vehiculos_id', '=', 'tipo_vehiculos.id')
                    ->select("registros.*", "tipo_vehiculos.tipo")
                    ->get()->toArray();
                    
        return collect($registros);
    }
}
