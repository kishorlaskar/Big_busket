<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
// use App\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();


class BrandController extends Controller
{
  



    public function add_brand()
    {
            $this->AdminAuthCheck();
        	return view('back.add_brand');
    }
    public function all_brand()
    {
        $this->AdminAuthCheck();
    	$all_brand_info = DB::table('manufacture')->get();
    	              $manage_brand = view('back.all_brand')
    	              ->with('all_brand_info',$all_brand_info );
                       return view('admin_layout')
                       ->with('back.all_brand',$manage_brand);






    	//return view('back.all_catagorey');
    }
    public function save_brand(Request $request)
    {
    	
           
    	   $data=array();
    	   $data['manufacture_id']          = $request->manufacture_id;
    	   $data['manufacture_name']        = $request->manufacture_name;
    	   $data['manufacture_description'] = $request->manufacture_description;
           $data['publication_status']= $request->publication_status;

           DB::table('manufacture')->insert($data);
           Session::put('exception','Brand Added Sucessfully');
           return Redirect::to('/add_brand');


    }
    public function unactive_brand($manufacture_id)
    {

        DB::table('manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->update(['publication_status' => 0]);
        Session::put('exception','Brand Unactive Successfully!!!');
        return Redirect::to('/all_brand');

    }
        public function active_brand($manufacture_id)
    {

        DB::table('manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->update(['publication_status' => 1]);
        Session::put('exception','Brand Active Successfully!!!');
        return Redirect::to('/all_brand');

    }
    public function edit_brand($manufacture_id)
    {
          $this->AdminAuthCheck();
    	  $brand_info =  DB::table('manufacture')
    	  ->where('manufacture_id',$manufacture_id)
    	  ->first();

    	  $brand_info = view('back.edit_brand')
    	  ->with('brand_info',$brand_info);
    	  return view('admin_layout')
    	  ->with('back.edit_brand',$brand_info);
    }
     public function update_brand(Request $request,$manufacture_id)
    {
    	

    	   $data=array();
    	  
    	   $data['manufacture_name']          =  $request->manufacture_name;
    	   $data['manufacture_description']   =  $request->manufacture_description;
          

           DB::table('manufacture')
              ->where('manufacture_id',$manufacture_id)
              ->update($data);
           
              Session::put('exception','Brand Updated Sucessfully');
              return Redirect::to('/all_brand');


    }
    public function delete_brand($manufacture_id)
    {
    	DB::table('manufacture')
    	->where('manufacture_id',$manufacture_id)
    	->delete();

        Session::put('exception','Brand delete Sucessfully');
        return Redirect::to('/all_brand');



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


