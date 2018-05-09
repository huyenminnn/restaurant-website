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
									<p>Project IT4409 - Web and Online Services </p>
									<ul>
										<li><i class="fa fa-phone"></i>086-860-3396</li>
										<li><i class="fa fa-globe"></i>1st, Dai Co Viet, Hai Ba Trung, Hanoi</li>
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
				<div id="googleMap" style="height:340px;">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.639319006184!2d105.84069301435818!3d21.007090393894917!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab8ac0a8def5%3A0xa76484d5add02445!2zMSDEkOG6oWkgQ-G7kyBWaeG7h3QsIELDoWNoIEtob2EsIEhhaSBCw6AgVHLGsG5nLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1525793441266" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>
		</div>     
	</div>
</div>
@endsection


@section('js.section')
{{-- <script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDpYZDw56DcO2pWhL10Yks_hdCIFjSBnug&callback=initMap">
</script>

<script>
	var map;

	function initMap()
	{
		var map_options = {
			center: new google.maps.LatLng(16.8496189,96.1288854),
			zoom: 15,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("googleMap"), map_options);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
	google.maps.event.addDomListener(window, "resize", function() 
	{
		var center = map.getCenter();
		google.maps.event.trigger(map, "resize");
		map.setCenter(center); 
	});
</script> --}}
@endsection