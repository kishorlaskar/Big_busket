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
					<a href="#">Update Product</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Product</h2>
					
					</div>
					<div class="box-content">
						<!--  <p class="alert-danger">
                            <?php 
                                 $exception=Session::get('exception'); 
                                 if($exception)
                                 {
                                    echo $exception;
                                    Session::put('exception',NULL);
                                 } 
                                 
                                 ?>
                             </p> -->
                             <form class="form-horizontal" 
						action="{{url('/update_product',$product_info->product_id)}}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label">Product Name</label>
							  <div class="controls">
							<input type="text" class="input-xlarge focused" name="product_name" value="{{$product_info->product_name}}">
							  </div>
							</div> 
					
							<div class="control-group">
							  <label class="control-label">Product Price</label>
							  <div class="controls">
							<input type="number" class="input-xlarge focused" name="product_price" value="{{$product_info->product_price}}">
							  </div>
							</div> 
							<div class="control-group">
							  <label class="control-label" for="fileInput">Product Image</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="fileInput" type="file" name="product_image" value="{{URL::to($product_info->product_image)}}">
							  </div>
							</div> 
							<div class="control-group">
							  <label class="control-label">Product Color</label>
							  <div class="controls">
							<input type="text" class="input-xlarge focused" name="product_color" value="{{$product_info->product_color}}">
							  </div>
							</div>  
                             <div class="control-group">
							  <label class="control-label">Product Size</label>
							  <div class="controls">
			<input type="text" class="input-xlarge focused" name="product_size" value="{{$product_info->product_size}}">
							  </div>
							</div>         
							
							
							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Update Product</button>
							 <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->




@endsection