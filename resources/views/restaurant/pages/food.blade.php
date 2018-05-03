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
		<div class="row">
			@foreach ($food_list as $food)			
			<div class="col-md-4 col-sm-6">
				<div class="blog-post">
					<div class="blog-thumb">
						<img src="{{ asset('') }}{{$food['thumbnail']}}" alt="" />
					</div>
					<div class="blog-content">
						<div class="content-show">
							<h4><a href="">{{$food['name']}}</a></h4>
							<span>{{$food['sale_price']}}$</span>
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
@endsection