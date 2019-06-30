
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
								  <th>Catagorey ID</th>
								  <th>Catagorey Name</th>
								  <th>Catagorey Description/th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							@foreach( $all_catagorey_info as $v_catagorey)
							<tr>
								<td>{{$v_catagorey->catagorey_id}}</td>
								<td class="center">{{$v_catagorey->catagorey_name}}</td>
								<td class="center">{{$v_catagorey->catagorey_desciption}}</td>
								<td class="center">
									@if($v_catagorey->publication_status==1)
									<span class="label label-success">Active</span>
									@else
									<span class="label label-gray">Unactive</span>
									@endif
								</td>
								<td class="center">
									@if($v_catagorey->publication_status==1)
									<a class="btn btn-danger" href="{{URL::to('/unactive_catagorey/'.$v_catagorey->catagorey_id)}}">
										<i class="halflings-icon white thumbs-down"></i>                                            
									</a>
									@else
										<a class="btn btn-success" href="{{URL::to('/active_catagorey/'.$v_catagorey->catagorey_id)}}">
										<i class="halflings-icon white thumbs-up"></i>                                            
									    </a>
									    @endif

									<a class="btn btn-info" href="{{URL::to('/edit_catagorey/'.$v_catagorey->catagorey_id)}}">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="{{URL::to('/delete_catagorey/'.$v_catagorey->catagorey_id)}}" id="delete">
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