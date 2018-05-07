@extends('restaurant.layouts.master')

@section('content')
<div id="heading">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-content">
					<h2>Booking</h2>
					<span>Home / <a href="{{ route('restaurant.booking') }}">Booking</a></span>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="product-post">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-section">
					<h2>Feel free to send a message</h2>
					<img src="{{ asset('restaurant/images/under-heading.png') }}" alt="" >
				</div>
			</div>
		</div>
		<div id="contact-us">
			<div class="container">
				<div class="row">
					<div class="product-item col-md-12">
						<div class="row">
							<div class="col-md-8">  
								<div class="message-form">
									<form action="{{ route('restaurant.process_booking') }}" method="POST" role="form" name="formBooking" id="formBooking">
										{{-- <legend>Form title</legend> --}}
										@csrf
										<table class="table">											
											<tr>
												<td>
													<div class="form-group">
														<label for="">Name (*)</label>
														<input type="text" class="form-control" id="name" placeholder="Name" name="name" >
													</div>
												</td>
												<td>
													<div class="form-group">
														<label for="">Email(*)</label>
														<input type="email" class="form-control" id="email" placeholder="Email" name="email" >
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="form-group">
														<label for="">Phone (*)</label>
														<input type="text" class="form-control" id="phone" placeholder="Phone" name="phone" >
													</div>
												</td>
												<td>
													<div class="form-group">
														<label for="">Address</label>
														<input type="text" class="form-control" id="address" placeholder="Address" name="address" >
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="form-group">
														<label for="">Date(*)</label>
														<input type="date" class="form-control" id="date" placeholder="Date" name="date" >
													</div>
												</td>
												<td>
													<div class="form-group">
														<label for="">Time(*)</label>
														<input type="time" class="form-control" id="time" placeholder="Time" name="time" >
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="form-group">
														<label for="">Number of guess</label>
														<input type="number" class="form-control" id="number_of_guess" placeholder="Number of guess" name="number_of_guess">
													</div>
												</td>
												<td></td>
											</tr>
											<tr>
												<td colspan="2">
													<div class="form-group">
														<label for="">Message</label>
														<textarea name="message" class="form-control" id="message" style="height: 150px"></textarea>
													</div>													
												</td>
											</tr>

										</table>
										<div class="text-center">
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>										
									</form>
								</div>
							</div>
							<div class="col-md-4">
								<div class="info">
									<p>Duis at pharetra neque, ut condimentum, purus nisl pretium quam, in pulvinar velit massa id elit. </p>
									<ul>
										<li><i class="fa fa-phone"></i>090-080-0760</li>
										<li><i class="fa fa-globe"></i>456 New Dagon City Studio, Yankinn, Digital Estate</li>
										<li><i class="fa fa-envelope"></i><a href="#">info@company.com</a></li>
									</ul>
								</div>
							</div>     
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="heading-section">
					<h2>Find Us On Map</h2>
					<img src="{{ asset('restaurant/images/under-heading.png') }}" alt="" >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="googleMap" style="height:340px;"></div>
			</div>
		</div>     
	</div>
</div>
@endsection


@section('js.section')

@endsection