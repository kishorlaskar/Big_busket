<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
//use App\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class ProductController extends Controller
{
    public function add_product()
    {
    	$this->AdminAuthCheck();
    	return view ('back.add_product');
    }
    public function save_product(Request $request)
    {
    	$data=array();
    	$data['product_name']=$request->product_name;
    	$data['catagorey_id']=$request->catagorey_id;
    	$data['manufacture_id']=$request->manufacture_id;
    	$data['product_short_description']=$request->product_short_description;
    	$data['product_long_description']=$request->product_long_description;
    	$data['product_price']=$request->product_price;
    	$data['product_size']=$request->product_size;
    	$data['product_color']=$request->product_color;
    	$data['publication_status']=$request->publication_status;
    	$image=$request->file('product_image');
    	if($image)
    	{
    		$image_name=str_random(20);
    		$ext=strtolower($image->getClientOriginalExtension());
    		$image_full_name = $image_name.'.'.$ext;
    		$upload_path='image/';
    		$image_url=$upload_path.$image_full_name;
    		$success=$image->move($upload_path,$image_full_name);
    		if($success)
    		{
    			$data['product_image'] = $image_url;
    			DB::table('product')->insert($data);
    			Session::put('exception','product Added Succesfully');
    			return Redirect::to('/add_product');

    		}

    	}
    	$data['product_image']='';
    	DB::table('product')->insert($data);
    	Session::put('exception','poduct added without images');
    	return Redirect::to('/add_product');









    }
    public function all_product()
    {

        return view('back.all_product');
    }
//............................................................
    public function all_product_by_uve(){
        $all_product_info = DB::table('product')
            ->join('catagorey','product.catagorey_id','=','catagorey.catagorey_id')
            ->join('manufacture','product.manufacture_id','=','manufacture.manufacture_id')
            ->select('product.*','catagorey.catagorey_name','manufacture.manufacture_name')
            ->get();

     return response()->json(["all_product_info"=>$all_product_info]);
       // return $all_product_info;  
    }
//................................................................

     public function unactive_product($product_id)
    {

        DB::table('product')
        ->where('product_id',$product_id)
        ->update(['publication_status' => 0]);
        Session::put('exception','Product Unactive Successfully!!!');
        return Redirect::to('/all_product');

    }
        public function active_product($product_id)
    {

        DB::table('product')
        ->where('product_id',$product_id)
        ->update(['publication_status' => 1]);
        Session::put('exception','Product Active Successfully!!!');
        return Redirect::to('/all_product');

    }
    public function edit_product($product_id)
    {     


          $this->AdminAuthCheck();
    	  $product_info =  DB::table('product')
    	  ->where('product_id',$product_id)
    	  ->first();

    	  $product_info = view('back.edit_product')
    	  ->with('product_info',$product_info);
    	  return view('admin_layout')
    	  ->with('back.edit_product',$product_info);
    }
     public function update_product(Request $request,$product_id)
    {
          

    	   $data=array();
    	  
    	   $data['product_name']=$request->product_name;
    	   

    	   $data['product_price']=$request->product_price;
    	   
    	   $data['product_size']=$request->product_size;
    	   $data['product_color']=$request->product_color;
    	   $data['product_price']=$request->product_price;
    	   $img=$request->file('product_image');
    	   //$data['product_image']='';

    	if($img)
    	{
    		$image_name=str_random(20);
    		$ext=strtolower($img->getClientOriginalExtension());
    		$image_full_name = $image_name.'.'.$ext;
    		$upload_path='img/';
    		$image_url=$upload_path.$image_full_name;
    		$success=$img->move($upload_path,$image_full_name);
    		if($success)
    		{
    			$data['product_image'] = $image_url;
    		    DB::table('product')->where('product_id',$product_id)->update($data);
           
             
           
              Session::put('exception','product Updated Sucessfully');
              return Redirect::to('/all_product');
    			
    		}

    	}
    
    	    	      DB::table('product')
              ->where('product_id',$product_id)
              ->update($data);
           
              Session::put('exception','product Updated Sucessfully');
              return Redirect::to('/all_product');


    }
    public function delete_product($product_id)
    {
    	DB::table('product')
    	->where('product_id',$product_id)
    	->delete();

        Session::put('exception','Product delete Sucessfully');
        return Redirect::to('/all_product');



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
