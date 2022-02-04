<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleTecnico
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()){
            return redirect('login');
        }

        $role = DB::table('role_user')
            ->select('role_id')
            ->where( 'user_id','=', Auth::id())
            ->where( 'role_id','=', 2)
            ->get();

        $role_id = $role[0]->role_id;
        
        if($role_id  == 2){
            return $next($request);
        }else {
            return redirect('/');
        }
    }
}
