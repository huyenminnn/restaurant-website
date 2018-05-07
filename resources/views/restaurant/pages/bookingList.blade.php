@extends('restaurant.layouts.master')

@section('content')
<div id="heading">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-content">
					<h2>Booking</h2>
					<span>Home / <a href="{{ route('restaurant.booking') }}">ORDER LIST</a></span>
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
					<h2>Your choice</h2>
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
									<table class="table table-hover" id="tblBooking">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="text-center">Thumbnail</th>
												<th class="text-center">Name</th>
												<th class="text-center">Price</th>
												<th class="text-center">Quantity</th>
												<th class="text-center">Sub total</th>
											</tr>
										</thead>
										<tbody>
											
											@foreach ($list as $item)
											<tr style="font-weight: bold;" id="row-{{$item->rowId}}">
												<td>{{$item->id}}</td>
												<td style="width: 20%">
													<img src="{{ asset('') }}{{$item->options->thumbnail}}" class=" img-responsive img-rounded" style="">
												</td>
												<td>{{$item->name}}</td>
												<td class="text-right">{{$item->price}} $/ <strike style="color: red">{{$item->options->origin_price}} $</strike></td>
												<td class="text-center">
													<a href="" class="btn-primary btn btn-sm fa fa-minus btnDecrease" data-item-rowid="{{$item->rowId}}"></a>
													&nbsp;{{$item->qty}}&nbsp;
													<a href="" class="btn-primary btn btn-sm fa fa-plus btnIncrease" data-item-rowid="{{$item->rowId}}"></a>
												</td>
												<td class="text-right" style="color: red">{{$item->subtotal}} $</td>
											</tr>
											@endforeach
											<tr class="text-right">
												<td colspan="5" ><b>TAX (10%)</b></td>
												<td><b style="color: red" id="tax">{{$tax}} $</b></td>
											</tr>
											<tr class="text-right">
												<td colspan="5" ><b>TOTAL</b></td>
												<td><b style="color: red" id="total">{{$total}} $</b></td>
											</tr>
											
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-4">
								<div class="info">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
									<ul>
										<li><i class="fa fa-phone"></i>090-080-0760</li>
										<li><i class="fa fa-globe"></i>456 New Dagon City Studio, Yankinn, Digital Estate</li>
										<li><i class="fa fa-envelope"></i><a href="#">info@company.com</a></li>
										<br>
										<hr>
										
										<li>
											<a href="{{ route('restaurant.drink') }}" class="btn btn-success fa fa-glass"> More Drink</a>
											<a href="{{ route('restaurant.food') }}" class="btn btn-danger fa fa-cutlery"> More Food</a>
										</li>
										
										<li><a href="{{ route('restaurant.booking') }}" class="btn btn-primary fa fa-credit-card"> <b>Booking</b></a></li>

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
<script>
	$('#tblBooking').on('click', '.btnIncrease',function(event) {
		event.preventDefault();
		var rowId = $(this).data('item-rowid');
		var row = document.getElementById('row-'+rowId);
		// alert(row);
		$.ajax({
			url: '{{ asset('') }}booking/increase/'+rowId,
			type: 'GET',			
			success: function(res) {
				toastr['success']('Update quantity successfull!');
				row.remove();
				// alert(res);
				$('#tblBooking').prepend('<tr style="font-weight: bold;" id="row-'+res.item['rowId']+'"><td>'+res.item['id']+'</td><td style="width: 20%"><img src="{{ asset('') }}'+res.item['options']['thumbnail']+'" class=" img-responsive img-rounded" style=""></td><td>'+res.item['name']+'</td><td class="text-right">'+res.item['price']+' $/ <strike style="color: red">'+res.item['options']['origin_price']+'$</strike></td><td class="text-center"><a href="" class="btn-primary btn btn-sm fa fa-minus btnDecrease" data-item-rowid="'+res.item['rowId']+'"></a>&nbsp;'+res.item['qty']+'&nbsp;<a href="" class="btn-primary btn btn-sm fa fa-plus btnIncrease" data-item-rowid="'+res.item['rowId']+'"></a></td><td class="text-right" style="color: red">'+res.item['price']*res.item['qty']+'$</td></tr>');
				$('#total').text(res.total);
				$('#tax').text(res.tax);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				toastr['error']('Update quantity failed!');
			}
		})
	});

	$('#tblBooking').on('click','.btnDecrease', function(event) {
		event.preventDefault();
		var rowId = $(this).data('item-rowid');
		var row = document.getElementById('row-'+rowId);
		// alert(row);
		$.ajax({
			url: '{{ asset('') }}booking/decrease/'+rowId,
			type: 'GET',			
			success: function(res) {
				toastr['success']('Update quantity successfull!');
				row.remove();
				// alert(res);
				$('#total').text(res.total);
				$('#tax').text(res.tax);
				$('#tblBooking').prepend('<tr style="font-weight: bold;" id="row-'+res.item['rowId']+'"><td>'+res.item['id']+'</td><td style="width: 20%"><img src="{{ asset('') }}'+res.item['options']['thumbnail']+'" class=" img-responsive img-rounded" style=""></td><td>'+res.item['name']+'</td><td class="text-right">'+res.item['price']+' $/ <strike style="color: red">'+res.item['options']['origin_price']+'$</strike></td><td class="text-center"><a href="" class="btn-primary btn btn-sm fa fa-minus btnDecrease" data-item-rowid="'+res.item['rowId']+'"></a>&nbsp;'+res.item['qty']+'&nbsp;<a href="" class="btn-primary btn btn-sm fa fa-plus btnIncrease" data-item-rowid="'+res.item['rowId']+'"></a></td><td class="text-right" style="color: red">'+res.item['price']*res.item['qty']+'$</td></tr>');
				
			},
			error: function(xhr, ajaxOptions, thrownError) {
				toastr['error']('Update quantity failed!');
			}
		})
	});
</script>
@endsection