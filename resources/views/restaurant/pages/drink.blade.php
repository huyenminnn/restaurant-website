@extends('restaurant.layouts.master')

@section('content')
<div id="heading">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-content">
					<h2>Drink</h2>
					<span>Home / <a href="{{ route('restaurant.drink') }}">Drink</a></span>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="food-list">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-section">
					<h2>Drink Menu</h2>
					<img src="{{ asset('restaurant/images/under-heading.png') }}" alt="" >
				</div>
			</div>
		</div>
		<div class="row" id="drink_list">
			@foreach ($drink_list as $drink)			
			<div class="col-md-4 col-sm-6">
				<div class="blog-post">
					<div class="blog-thumb">
						<img src="{{ asset('') }}{{$drink['thumbnail']}}" alt="" />
					</div>
					<div class="blog-content">
						<div class="content-show">
							<h4>
								<a href="">{{$drink['name']}}</a>
								<a href="" style="float: right;" data-id="{{$drink['id']}}" id="addDrink-{{$drink['id']}}" class="addDrink"><button class="fa fa-glass btn btn-sm btn-danger" style="color: white"></button></a>
							</h4>
							<span>{{$drink['price']}} $ </span>/ 
							<strong style="color: red"><strike>{{$drink['origin_price']}} $</strike></strong>
						</div>
						<div class="content-hide">
							<p>{{$drink['description']}}</p>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div class="text-center">
			{{ $drink_list->links() }}
		</div>		
	</div>
</div>
@endsection
@section('js.section')
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf_token"]').attr('content')
		}
	});

	$('#drink_list').on('click', '.addDrink', function(event){
		event.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			url: '{{ asset('') }}booking/'+id,
			type: 'GET',
			success: function(res){				
				toastr['success']('You added "'+res.name+'" to order list successfully!');
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('You added this drink failed!');
			}
		})
	})
</script>
@endsection
