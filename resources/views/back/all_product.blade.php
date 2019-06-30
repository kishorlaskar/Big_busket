
@extends('admin_layout')
@section('admin_content')
<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Tables</a></li>
			</ul>

			<div class="row-fluid sortable">
			 <p class="alert-success">
                            <?php 
                                 $exception=Session::get('exception'); 
                                 if($exception)
                                 {
                                    echo $exception;
                                    Session::put('exception',NULL);
                                 } 
                                 
                                 ?>
                             </p>
            

				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
						
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>

							  <tr>
								  <th>Product ID</th>
								  <th>Product Name</th>
								  
								  <th>Image</th>
								  <th>Price</th>
								  <th>Catagorey</th>
								  <th>Brand</th>
								  <th>Color</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody >







							<tr v-for="product in products">
							<td class="center">@{{product.product_id}}</td>
							<td class="center">@{{product.product_name}}</td>
							
							<td><img :src="product.product_image" style="height: 80px; width: 80px;">
							</td>
						<td class="center">@{{product.product_price}}</td>
						<td class="center">@{{product.catagorey_name}}</td>
						<td class="center">@{{product.manufacture_name}}</td>
						<td class="center">@{{product.product_color}}</td>
							
								<td class="center">
									<span class="label label-success" v-if="product.publication_status == 1">Active</span>
									<span class="label label-gray" v-else>Unactive</span>
								</td>
								<td class="center">	
									<a class="btn btn-danger" v-if="product.publication_status == 1" :href="'unactive_product/'+product.product_id">
								<i class="halflings-icon white thumbs-down"></i></a>
									<a class="btn btn-success" v-else :href="'active_product/'+product.product_id">
										<i class="halflings-icon white thumbs-up"></i>                                            
									    </a>

									<a class="btn btn-info" :href="'edit_product/'+product.product_id">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" :href="'delete_product/'+product.product_id" id="delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							




							


						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

 
@endsection