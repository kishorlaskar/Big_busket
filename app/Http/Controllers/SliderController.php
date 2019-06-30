<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
//use App\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class SliderController extends Controller
{
    public function add_slider()
    {

        $this->AdminAuthCheck();
    	return view('back.add_slider');
    	
    }
     public function all_slider()
    {
        $this->AdminAuthCheck();
    	$all_slider = DB::table('slider')->get();
    	              $manage_slider = view('back.all_slider')
    	              ->with('all_slider',$all_slider);
                       return view('admin_layout')
                       ->with('back.all_slider',$manage_slider);






    	//return view('back.all_catagorey');
    }
   public function save_slider(Request $request)
    {
    	$data=array();
    	$data['status']=$request->status;
    	$image=$request->file('slider_image');
    	if($image)
    	{
    		$image_name=str_random(20);
    		$ext=strtolower($image->getClientOriginalExtension());
    		$image_full_name = $image_name.'.'.$ext;
    		$upload_path='slider/';
    		$image_url=$upload_path.$image_full_name;
    		$success=$image->move($upload_path,$image_full_name);
    		if($success)
    		{
    			$data['slider_image'] = $image_url;
    			DB::table('slider')->insert($data);
    			Session::put('exception','Slider Added Succesfully');
    			return Redirect::to('/add_slider');

    		}

    	}
    	$data['slider_image']='';
    	DB::table('slider')->insert($data);
    	Session::put('exception','Slider added without images');
    	return Redirect::to('/add_slider');
    }

    public function unactive_slider($slider_id)
    {

        DB::table('slider')
        ->where('slider_id',$slider_id)
        ->update(['status' => 0]);
        Session::put('exception','Slider Unactive Successfully!!!');
        return Redirect::to('/all_slider');

    }
        public function active_slider($slider_id)
    {

        DB::table('slider')
        ->where('slider_id',$slider_id)
        ->update(['status' => 1]);
        Session::put('exception','Slider Active Successfully!!!');
        return Redirect::to('/all_slider');

    }
        public function delete_slider($slider_id)
    {
    	DB::table('slider')
    	->where('slider_id',$slider_id)
    	->delete();

        Session::put('exception','Slider delete Sucessfully');
        return Redirect::to('/all_slider');



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
