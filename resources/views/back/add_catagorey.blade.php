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
					<a href="#">Add Catagorey</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Catagorey</h2>
					
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
						<form class="form-horizontal" action="{{url('/save_catagorey')}}" method="post">
							{{ csrf_field() }}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label">Catagorey Name</label>
							  <div class="controls">
							<input type="text" class="input-xlarge focused" name="catagorey_name" required="">
							  </div>
							</div>          
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Catagoey Description</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="catagorey_desciption" required=""></textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Publication Status</label>
							  <div class="controls">
								<input class="input-file uniform_on" type="checkbox" name="publication_status" value="1">
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Catagoey</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->




@endsection