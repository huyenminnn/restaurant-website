@extends('restaurant.layouts.master')

@section('content')
<div id="heading">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-content">
					<h2>Food</h2>
					<span>Home / <a href="{{ route('restaurant.food') }}">Food</a></span>
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
					<h2>Food Menu</h2>
					<img src="{{ asset('restaurant/images/under-heading.png') }}" alt="" >
				</div>
			</div>
		</div>
		<div class="row" id="food_list">
			@foreach ($food_list as $food)			
			<div class="col-md-4 col-sm-6">
				<div class="blog-post">
					<div class="blog-thumb">
						<img src="{{ asset('') }}{{$food['thumbnail']}}" alt="" />
					</div>
					<div class="blog-content">
						<div class="content-show">
							<h4>
								<a href="">{{$food['name']}}</a>
								
								<a style="float: right;" data-id="{{$food['id']}}" id="addFood-{{$food['id']}}" class="addFood"><button class="fa fa-cutlery btn btn-sm btn-danger" style="color: white" ></button>
								</a>					
							</h4>
							<span>{{$food['price']}} $ </span> / 
							<strong style="color: red"><strike>{{$food['origin_price']}} $</strike></strong>
						</div>
						<div class="content-hide">
							<p>{{$food['description']}}</p>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div class="text-center">
			{{ $food_list->links() }}
		</div>
		
	</div>
</div>

<div class="modal fade" id="modalBookList">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">BOOKING LIST</h4>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Book</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js.section')
<script src="{{ asset('admins/bower_components/toastr/toastr.js') }}"></script>
<script >

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf_token"]').attr('content')
		}
	});

	$('#food_list').on('click', '.addFood', function(event){
		event.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			url: '{{ asset('') }}booking-food/'+id,
			type: 'GET',
			success: function(res){				
				toastr['success']('You added "'+res.name+'" to order list successfully!');
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('You added this food failed!');
			}
		})
	})

</script>
@endsection
