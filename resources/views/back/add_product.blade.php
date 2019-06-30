@extends('admin_layout')
@section('admin_content')
<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Add Product</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product </h2>
					
					</div>
					<div class="box-content">
						 <p class="alert-danger">
                            <?php 
                                 $exception=Session::get('exception'); 
                                 if($exception)
                                 {
                                    echo $exception;
                                    Session::put('exception',NULL);
                                 } 
                                 
                                 ?>
                             </p>
						<form class="form-horizontal" action="{{url('/save_product')}}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label">Product Name</label>
							  <div class="controls">
						<input type="text" class="input-xlarge focused" name="product_name" required="">
							  </div>
							</div>  
            <div class="control-group">
			<label class="control-label" for="selectError3">Product Catagorey<label>
								<div class="controls">
								  <select id="selectError3" name="catagorey_id">
								  	<option >Select Catagorey</option>
									  <?php

                             $all_published_catagorey = DB::table('catagorey')
                                                   ->where('publication_status',1)
                                                   -> get();

                                foreach($all_published_catagorey as $v_catagorey) {?>
									<option value="{{$v_catagorey->catagorey_id}}">{{$v_catagorey->catagorey_name}}</option>
									<?php } ?>
									
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">Brand Name<label>
								<div class="controls">
								  <select id="selectError3" name="manufacture_id">
								  	<option>Select Brand</option>
							<?php

                             $all_published_brand = DB::table('manufacture')
                                                      ->where('publication_status',1)
                                                      -> get();

                                foreach($all_published_brand as $v_brand) {?>
                                	<option value="{{$v_brand->manufacture_id}}">{{$v_brand->manufacture_name}}</option>
									<?php } ?>
									
								  </select>
								</div>
							  </div>
							   

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product_Short_Description <label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="product_short_description" required=""></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product_Long_Description <label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="product_long_description" required=""></textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label">Product Price</label>
							  <div class="controls">
							<input type="number" class="input-xlarge focused" name="product_price" required="">
							  </div>
							</div> 
							<div class="control-group">
							  <label class="control-label" for="fileInput">Product Image</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="fileInput" type="file" name="product_image">
							  </div>
							</div> 
							<div class="control-group">
							  <label class="control-label">Product Color</label>
							  <div class="controls">
							<input type="text" class="input-xlarge focused" name="product_color" required="">
							  </div>
							</div>  
                             <div class="control-group">
							  <label class="control-label">Product Size</label>
							  <div class="controls">
			<input type="text" class="input-xlarge focused" name="product_size" required="">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="fileInput">Publication Status</label>
							  <div class="controls">
								<input class="input-file uniform_on" type="checkbox" name="publication_status" value="1">
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add product</button>
							 
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->




@endsection