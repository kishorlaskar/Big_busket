<?php


 


Route::get('test',function(){return view('test');});
//frontend
Route::get('/','HomeController@index');
Route::get('/blog','HomeController@blog');
Route::get('/contact','HomeController@contact');

//show catagorey wise product
Route::get('/product_by_catagorey/{catagorey_id}','HomeController@show_product_by_catagorey');
Route::get('/product_by_brand/{manufacture_id}','HomeController@show_product_by_brand');
Route::get('/view_product/{product_id}','HomeController@product_details_by_id');

//Route for cart
Route::post('/add_to_cart','CartController@add_to_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete_to_cart/{id}','CartController@delete_cart');
Route::post('/update_cart','CartController@update_cart');

//Route for checkout
Route::get('/login-check','CheckController@login_check');
Route::post('/customer_registation','CheckController@customer_registation');
Route::get('/checkout','CheckController@checkout');
Route::post('/save-shipping-details','CheckController@save_shipping_details');
Route::get('/customer-logout','CheckController@customer_logout');
Route::post('/customer_login','CheckController@customer_login');
//Route for Payment
Route::get('/customer_payment','CheckController@payment');
Route::post('/order-place','CheckController@order_place');

//manage order routes
Route::get('/manage_order','CheckController@manage_order');
Route::get('/view-order/{order_id}','CheckController@view_order');
Route::get('/delete_order/{order_id}','CheckController@delete_order');
Route::get('/unactive_order/{order_id}','CheckController@unactive_order');
Route::get('/active_order/{order_id}','CheckController@active_order');





//backend
Route::get('/logout','SuperAdminController@logout');
Route::get('/aa','AdminController@admin_login');
Route::get('/dashboard','SuperAdminController@index');
Route::post('/admin_dashboard','AdminController@dashboard');

//catorey related routes
Route::get('/add_catagorey','CatagoreyController@index');
Route::get('/all_catagorey','CatagoreyController@all_catagorey');
Route::post('/save_catagorey','CatagoreyController@save_catagorey');
Route::get('/unactive_catagorey/{catagorey_id}','CatagoreyController@unactive_catagorey');
Route::get('/active_catagorey/{catagorey_id}','CatagoreyController@active_catagorey');
Route::get('/edit_catagorey/{catagorey_id}','CatagoreyController@edit_catagorey');
Route::post('/update_catagorey/{catagorey_id}','CatagoreyController@update_catagorey');
Route::get('/delete_catagorey/{catagorey_id}','CatagoreyController@delete_catagorey');



//brand related routers

Route::get('/add_brand','BrandController@add_brand');
Route::get('/all_brand','BrandController@all_brand');
Route::post('/save_brand','BrandController@save_brand');
Route::get('/unactive_brand/{manufacture_id}','BrandController@unactive_brand');
Route::get('/active_brand/{manufacture_id}','BrandController@active_brand');
Route::get('/edit_brand/{manufacture_id}','BrandController@edit_brand');
Route::post('/update_brand/{manufacture_id}','BrandController@update_brand');
Route::get('/delete_brand/{manufacture_id}','BrandController@delete_brand');

//product related routers

Route::get('/add_product','ProductController@add_product');
Route::get('/all_product','ProductController@all_product');


Route::get('/all_product_by_uve','ProductController@all_product_by_uve');


Route::get('/edit_product/{product_id}','ProductController@edit_product');
Route::get('/delete_product/{product_id}','ProductController@delete_product');
Route::get('/unactive_product/{product_id}','ProductController@unactive_product');
Route::get('/active_product/{product_id}','ProductController@active_product');
Route::post('/save_product','ProductController@save_product');
Route::post('/update_product/{product_id}','ProductController@update_product');

//Slider related routers
Route::get('/add_slider','SliderController@add_slider');
Route::get('/all_slider','SliderController@all_slider');
Route::post('/save_slider','SliderController@save_slider');
Route::get('/delete_slider/{slider_id}','SliderController@delete_slider');
Route::get('/unactive_slider/{slider_id}','SliderController@unactive_slider');
Route::get('/active_slider/{slider_id}','SliderController@active_slider');





















