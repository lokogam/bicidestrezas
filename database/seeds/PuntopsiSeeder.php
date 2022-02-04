<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PuntopsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $punto = new Formulario();

		$punto->nombre_psi    = 'medellin';
		$punto->ubicacion_psi = '123123';
		$punto->status        = '1'

		$punto->save();
    }
}
