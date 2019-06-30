
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
								  <th>Slider ID</th>
								  <th>Image</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							@foreach( $all_slider as $v_slider)
							<tr>
							<td class="center">{{$v_slider->slider_id}}</td>
							<td><img src="{{URL::to($v_slider->slider_image)}}" style="height: 100px; width: 200px;">
							</td>
						
							
								<td class="center">
									@if($v_slider->status==1)
									<span class="label label-success">Active</span>
									@else
									<span class="label label-gray">Unactive</span>
									@endif
								</td>
								<td class="center">
									@if($v_slider->status==1)		
									<a class="btn btn-danger" href="{{URL::to('/unactive_slider/'.$v_slider->slider_id)}}">
								<i class="halflings-icon white thumbs-down"></i>                                            
									</a>
									@else
									<a class="btn btn-success" href="{{URL::to('/active_slider/'.$v_slider->slider_id)}}">
										<i class="halflings-icon white thumbs-up"></i>                                            
									    </a>
									    @endif

								
									<a class="btn btn-danger" href="{{URL::to('/delete_slider/'.$v_slider->slider_id)}}" id="delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							
							
					@endforeach
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->


@endsection