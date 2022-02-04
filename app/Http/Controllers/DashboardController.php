<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Url;

class DashboardController extends Controller
{
    // Dashboard - Analytics
    public function dashboardAnalytics(){
        $cons = DB::table('role_user')->where('user_id', Auth::user()->id)->where('role_id',1)->get();

        if (count($cons)>0) {
        	return redirect('admin/acciones');
        }else{
        	$cons_2 = DB::table('role_user')->where('user_id', Auth::user()->id)->where('role_id',3)->get();
        	
        	if (count($cons_2)>0) {
        		return redirect('formulario/acciones');
        	}

        	return redirect('formulario/acciones');
        }

    }

}

