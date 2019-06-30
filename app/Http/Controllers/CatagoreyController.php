<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
// use App\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class CatagoreyController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
    	return view('back.add_catagorey');
    }
    public function all_catagorey()
    {
        $this->AdminAuthCheck();
    	$all_catagorey_info = DB::table('catagorey')->get();
    	              $manage_catagorey = view('back.all_catagorey')
    	              ->with('all_catagorey_info',$all_catagorey_info );
                       return view('admin_layout')
                       ->with('back.all_catagorey',$manage_catagorey);






    	//return view('back.all_catagorey');
    }
    public function save_catagorey(Request $request)
    {
    	

    	   $data=array();
    	   $data['catagorey_id']          = $request->catagorey_id;
    	   $data['catagorey_name']        = $request->catagorey_name;
    	   $data['catagorey_desciption'] = $request->catagorey_desciption;
           $data['publication_status']    = $request->publication_status;

           DB::table('catagorey')->insert($data);
           Session::put('exception','Catagorey Added Sucessfully');
           return Redirect::to('/add_catagorey');


    }
    public function unactive_catagorey($catagorey_id)
    {

        DB::table('catagorey')
        ->where('catagorey_id',$catagorey_id)
        ->update(['publication_status' => 0]);
        Session::put('exception','Catagorey Unactive Successfully!!!');
        return Redirect::to('/all_catagorey');

    }
        public function active_catagorey($catagorey_id)
    {

        DB::table('catagorey')
        ->where('catagorey_id',$catagorey_id)
        ->update(['publication_status' => 1]);
        Session::put('exception','Catagorey Active Successfully!!!');
        return Redirect::to('/all_catagorey');

    }
    public function edit_catagorey($catagorey_id)
    {
        $this->AdminAuthCheck();
    	  $catagorey_info =  DB::table('catagorey')
    	  ->where('catagorey_id',$catagorey_id)
    	  ->first();

    	  $catagorey_info = view('back.edit_catagorey')
    	  ->with('catagorey_info',$catagorey_info);
    	  return view('admin_layout')
    	  ->with('back.edit_catagorey',$catagorey_info);
    }
     public function update_catagorey(Request $request,$catagorey_id)
    {
    	

    	   $data=array();
    	  
    	   $data['catagorey_name']         =  $request->catagorey_name;
    	   $data['catagorey_desciption']   =  $request->catagorey_desciption;
          

           DB::table('catagorey')
              ->where('catagorey_id',$catagorey_id)
              ->update($data);
           
              Session::put('exception','Catagorey Updated Sucessfully');
              return Redirect::to('/all_catagorey');


    }
    public function delete_catagorey($catagorey_id)
    {
    	DB::table('catagorey')
    	->where('catagorey_id',$catagorey_id)
    	->delete();

        Session::put('exception','Catagorey delete Sucessfully');
        return Redirect::to('/all_catagorey');



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
