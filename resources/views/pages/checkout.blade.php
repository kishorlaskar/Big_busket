@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
		

			<div class="register-req">
				<p>Please fill up the following tasks properly to confirm an acurate order.</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form action="{{url('/save-shipping-details')}}" method="post">
									{{csrf_field()}}
									<input type="text" placeholder="Email*" name="shipping_email">
									
									<input type="text" placeholder="First Name *" name="shipping_firstname">
									
									<input type="text" placeholder="Last Name *" name="shipping_lastname">
									<input type="text" placeholder="Mobile Number *" name="shipping_mobile">
									<input type="text" placeholder="Address *" name="shipping_address">

									<input type="text" placeholder="City *" name="shipping_city">
									<input type="submit" value="Done" name="submit" class="btn btn-default">
								</form>
							</div>
					
						</div>
					</div>
					<div class="col-sm-4">
				
					</div>					
				</div>
			</div>	
		</div>
	</section> <!--/#cart_items-->


@endsection