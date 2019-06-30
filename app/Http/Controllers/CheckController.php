<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
//use App\Http\Request;
use Cart;
use Illuminate\Support\Facades\Redirect;
use Session;

class CheckController extends Controller
{
    public function login_check()
    {
    	return view('pages.login');
    }
    public function customer_registation(Request $request)
    {
       $data = array();

       $data['customer_name']=$request->customer_name;
       $data['customer_email']=$request->customer_email;
       $data['customer_password']= md5($request->customer_password);
       $data['customer_mobile']=$request->customer_mobile;

        $customer_id = DB::table('customer')
                     ->insertGetId($data);

                     Session::put('customer_id',$customer_id);
                     Session::put('customer_name',$request->customer_name);
                     Return redirect('/checkout');

    }
    public function checkout()
    {
    	return view('pages.checkout');
    }
    public  function save_shipping_details(Request $request)
    {
      $data = array();

       $data['shipping_email']=$request->shipping_email;
       $data['shipping_firstname']=$request->shipping_firstname;
       $data['shipping_lastname']=$request->shipping_lastname;
       $data['shipping_mobile']=$request->shipping_mobile;
   //    $data['shipping_email']=$request->shipping_email;
       $data['shipping_address']=$request->shipping_address;
       $data['shipping_city']=$request->shipping_city;


       $shipping_id = DB::table('shipping')
                     ->insertGetId($data);
                     Session::put('shipping_id',$shipping_id);
                     Return Redirect::to('/customer_payment');





       
         


    }
    public function customer_logout()
    {
      Session::flush();
      return Redirect::to('/');
    }
    public function customer_login(Request $request)
    {
      $customer_email= $request->customer_email; 
      $customer_password = md5($request->customer_password);

      $result=DB::table('customer')
             ->where('customer_email',$customer_email)
             ->where('customer_password',$customer_password)
             ->first();
             if($result)
             {
                 Session::put('customer_id',$result->customer_id);
                 return Redirect::to('/checkout');
             }
             else
             {
  
                return Redirect::to('/login-check');

             }
    }
    public function payment()
    {
           return view('pages.payment');
    }
    public function order_place(Request $request)
    {
          $payment_method=$request->payment_method;
          $pdata = array();
          $pdata['payment_method'] = $request->payment_method;
          $pdata['payment_status'] = 'pending';
          $payment_id = DB::table('payment')
                       ->insertGetId($pdata);

         $odata = array();
         $odata['customer_id'] =Session::get('customer_id');
         $odata['shipping_id'] =Session::get('shipping_id');
         $odata['payment_id']=$payment_id;
         $odata['order_total']=Cart::getTotal();
         $odata['order_status']='pending';
         $order_id = DB::table('order')
                    ->insertGetId($odata);
    $contents= Cart::getContent();
     $oddata=array();
     foreach ($contents as  $v_content) 
     {
        $oddata['order_id']=$order_id;
        $oddata['product_id']=$v_content->id;
        $oddata['product_name']=$v_content->name;
        $oddata['product_price']=$v_content->price;
        $oddata['product_sales_quantity']=$v_content->quantity;
        DB::table('orderdetails')
            ->insert($oddata);
     }
     if ($payment_method=='handcash') {
          
           Cart::clear();
          return view('pages.handcash');
         
        
     }elseif ($payment_method=='cart') {
   
      echo "cart";
      
     }elseif($payment_method=='paypal'){
         echo "paypal";
     }else{
      echo "not selectd";
     }




          
    }
   public function manage_order()
    {
     
      $all_order_info=DB::table('order')
                     ->join('customer','order.customer_id','=','customer.customer_id')
                     ->select('order.*','customer.customer_name')
                     ->get();
       $manage_order=view('back.manage_order')
               ->with('all_order_info',$all_order_info);
       return view('admin_layout')
               ->with('back.manage_order',$manage_order); 
    }
  public function view_order($order_id)
  {
       

      $order_by_id=DB::table('order')
              ->join('customer','order.customer_id','=','customer.customer_id')
              ->join('orderdetails','order.order_id','=','orderdetails.order_id')
              ->join('shipping','order.shipping_id','=','shipping.shipping_id')
              ->select('order.*','orderdetails.*','shipping.*','customer.*')
              ->where('order.order_id',$order_id)
              ->get();
       $view_order=view('back.view_order')
               ->with('order_by_id',$order_by_id);
       return view('admin_layout')
               ->with('back.view_order',$view_order); 
                     // echo "<pre>";
                     //  print_r($order_by_id);
                     // echo "</pre>";
  }
   public function unactive_order($order_id)
    {

        DB::table('order')
        ->where('order_id',$order_id)
        ->update(['order_status' => 0]);
        Session::put('exception','Order is pending!!!');
        return Redirect::to('/manage_order');

    }
        public function active_order($order_id)
    {

        DB::table('order')
        ->where('order_id',$order_id)
        ->update(['order_status' => 1]);
        Session::put('exception','Order Confirm  Successfully!!!');
        return Redirect::to('/manage_order');

    }



      public function delete_order($order_id)
    {
      DB::table('order')
      ->where('order_id',$order_id)
      ->delete();

        Session::put('exception','order delete Sucessfully');
        return Redirect::to('/manage_order');



    }
}
