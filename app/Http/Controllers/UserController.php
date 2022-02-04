<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function usuario()
	{
		$formadores = DB::table('users')
			->join('role_user', 'role_user.user_id', '=', 'users.id')
			->join('roles', 'roles.id', '=', 'role_user.role_id')
			->leftjoin('puntos_users', 'users.id', '=', 'puntos_users.users_id')
			->leftjoin('puntos', 'puntos_users.puntos_id', '=', 'puntos.id')
			->where('role_user.role_id', 3)
			->select('users.*', 'roles.name as rol', 'puntos.nombre_punto', 'puntos.ubicacion')
			->get();

		$admins = DB::table('users')
			->join('role_user', 'role_user.user_id', '=', 'users.id')
			->join('roles', 'roles.id', '=', 'role_user.role_id')
			->leftjoin('puntos_users', 'users.id', '=', 'puntos_users.users_id')
			->leftjoin('puntos', 'puntos_users.puntos_id', '=', 'puntos.id')
			->where('role_user.role_id', 1)
			->select('users.*', 'roles.name as rol', 'puntos.nombre_punto', 'puntos.ubicacion')
			->get();

		$permisos = DB::table('roles')->get();

		return view('usuario/ver_usuario', [
			"formadores" => $formadores,
			"admins"     => $admins,
			"permisos"   => $permisos
		]);
	}

	public function guardarusuario(Request $request)
	{
		DB::table('users')->insert(array(array(
			'name'      => $request->input('nombre'),
			'documento' => $request->input('documento'),
			'email'     => $request->input('email'),
			'password'  => Hash::make($request->input('documento'))
		)));

		$ultimo_usuario = DB::table('users')->max('id');

		DB::table('role_user')->insert(array(array(
			'user_id' => $ultimo_usuario,
			'role_id' => $request->input('rol')
		)));

		return redirect('usuario');
	}
}
