<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
//use App\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class SuperAdminController extends Controller
{
   public function index()
   {
   	$this->AdminAuthCheck();
   	return view('back.dashboard');
   }



    public function logout()
   {

    	Session::flush();
    	return Redirect::to('/aa');
    }
    public function AdminAuthCheck()
    {
    	$admin_id=Session::get('admin_id');
    	if($admin_id)
    	{
    		return;
    	}
    	else
    	{
    		return Redirect::to('/aa')->send();

    	}
    }
}
