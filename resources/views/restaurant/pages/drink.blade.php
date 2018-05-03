@extends('restaurant.layouts.master')

@section('content')
<div id="heading">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-content">
					<h2>Drink</h2>
					<span>Home / <a href="{{ route('restaurant.food') }}">Drink</a></span>
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
		<div class="row">
			@foreach ($drink_list as $drink)			
			<div class="col-md-4 col-sm-6">
				<div class="blog-post">
					<div class="blog-thumb">
						<img src="{{ asset('') }}{{$drink['thumbnail']}}" alt="" />
					</div>
					<div class="blog-content">
						<div class="content-show">
							<h4><a href="">{{$drink['name']}}</a></h4>
							<span>{{$drink['sale_price']}} $</span>
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