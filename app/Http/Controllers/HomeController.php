<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
session_start();

class HomeController extends Controller
{
    public function index()
    {
         
            $all_published_product = DB::table('product')
            ->join('catagorey','product.catagorey_id','=','catagorey.catagorey_id')
            ->join('manufacture','product.manufacture_id','=','manufacture.manufacture_id')
            ->select('product.*','catagorey.catagorey_name','manufacture.manufacture_name')
              ->limit(9)
    	    ->get();
           $manage_published_product = view('pages.home')
           ->with('all_published_product',$all_published_product);
           return view('layout')
          ->with('pages.home',$manage_published_product);




    	//return view ('pages.home');
    }


   
    public function show_product_by_catagorey($catagorey_id)
    {
         
 $product_by_catagorey= DB::table('product')
            ->join('catagorey','product.catagorey_id','=','catagorey.catagorey_id')
            
            ->select('product.*','catagorey.catagorey_name')
            ->where('catagorey.catagorey_id',$catagorey_id)
            ->where('product.publication_status',1)
            ->limit(18)
    	    ->get();
           $manage_product_by_catagorey=view('pages.catagorey_by_product')
           ->with('product_by_catagorey',$product_by_catagorey);
           return view('layout')
          ->with('pages.catagorey_by_product',$manage_product_by_catagorey);




    	//return view ('pages.home');
    }
    public function show_product_by_brand($manufacture_id)
    {
         
 $product_by_brand= DB::table('product')
             ->join('catagorey','product.catagorey_id','=','catagorey.catagorey_id')
            ->join('manufacture','product.manufacture_id','=','manufacture.manufacture_id')
            
            ->select('product.*','catagorey.catagorey_name','manufacture.manufacture_name')
            ->where('manufacture.manufacture_id',$manufacture_id)
            ->where('product.publication_status',1)
            ->limit(18)
    	    ->get();
           $manage_product_by_manufacture=view('pages.manufacture_by_product')
           ->with('product_by_brand',$product_by_brand);
           return view('layout')
          ->with('pages.manufacture_by_product',$manage_product_by_manufacture);




    	//return view ('pages.home');
    }
    public function product_details_by_id($product_id)
    {
    	$product_by_details= DB::table('product')
             ->join('catagorey','product.catagorey_id','=','catagorey.catagorey_id')
            ->join('manufacture','product.manufacture_id','=','manufacture.manufacture_id')
            
            ->select('product.*','catagorey.catagorey_name','manufacture.manufacture_name')
            ->where('product.product_id',$product_id)
            ->where('product.publication_status',1)
            ->limit(18)
    	    ->first();
           $manage_product_by_details=view('pages.product_details')
           ->with('product_by_details',$product_by_details);
           return view('layout')
          ->with('pages.product_details',$manage_product_by_details);

    }
    public function blog()
    {
      return view('pages.blog');
    }
    public function contact()
    {
      return view('pages.contact');
    }
}
