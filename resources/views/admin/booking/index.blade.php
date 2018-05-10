@extends('admin.layouts.master')

@section('css.dataTable')
<link rel="stylesheet" href="{{ asset('admins/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('admins/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"> --}}

@endsection

@section('cate')
Booking
@endsection

@section('sup_cate')
Restaurant
@endsection

@section('admin_name')
	{{$admin_info['name']}}
@endsection

@section('admin_profile')
	{{$admin_info['avatar']}}
@endsection

@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Table of Booking</h3>
					<a class="btn btn-primary fas fa-plus " data-toggle="modal" href='#modalAdd' style="float: right">&nbsp;<i class="fas fa-bars"></i></a>
					<div class="modal fade" id="modalAdd">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">Add new Booking</h4>
								</div>
								<div class="modal-body">
									<form action="" method="POST" role="form" id="formAdd" name="formAdd">
										@csrf
										<table class="table">											
											<tr>
												<td>
													<div class="form-group">
														<label for="">Name</label>
														<input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label for="">Email</label>
														<input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="form-group">
														<label for="">Phone</label>
														<input type="text" class="form-control" id="phone" placeholder="Phone" name="phone" required>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label for="">Address</label>
														<input type="text" class="form-control" id="address" placeholder="Address" name="address" required>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="form-group">
														<label for="">Date</label>
														<input type="date" class="form-control" id="date" placeholder="Date" name="date" required>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label for="">Time</label>
														<input type="time" class="form-control" id="time" placeholder="Time" name="time" required>
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
												<td>
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
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary">Create</button>
											</div>
										</form>
									</div>

								</div>
							</div>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-hover table-bordered" id="tbl-booking">
							<thead>
								<tr>
									<th width="5%" class="text-center">ID</th>
									<th>Name</th>
									<th>Phone</th>
									<th>Email</th>
									<th>Date</th>
									<th>Time</th>
									<th>Guess</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		{{-- modal Show --}}
		<div class="modal fade" id="modalShow">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Tash Res: Details of Booking</h4>
					</div>
					<div class="modal-body">
						
						<br>
						<table class="table table-hover" id="tbl-show-booking">
							<thead>
								<tr>
									<th>#</th>
									<th>Thumbnail</th>
									<th>Name</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		{{-- modal Edit --}}
	{{-- <div class="modal fade" id="modalEdit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title">Tah Res </h3>
				</div>
				<div class="modal-body">
					<form action=""  role="form" id="formEdit">
						@csrf
						@method('PUT')
						<legend class="text-center">Edit category: <span id="edit-title-name"></span></legend>
						<input type="hidden" name="id-cate" value="" id="edit-id">
						<input type="hidden" name="edit-has-sub-cate" value="" id="edit-has-sub-cate">
						<div class="form-group">
							<label for="">Name</label>
							<input type="text" class="form-control" id="edit-name" placeholder="Name" name="name">
						</div>
						<div class="form-group">
							<label for="">Description</label>
							<input type="text" class="form-control" id="edit-description" placeholder="Description" name="description">
						</div>
						<div class="form-group">
							<label for="">Super category</label>
							<select name="parent-id" id="parent-id" class="form-control" required="required" placeholder="Select super category">
								<option value="" data-level="" id="edit-parent-old"></option>
								@foreach ($categories as $category)
								<option value="{{$category['id']}}" data-level={{$category['level']}}>{{$category['name']}}</option>
								@endforeach											
							</select>
						</div>										
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> --}}
</section>
<!-- /.content -->
@endsection

@section('js.dataTable')
<script src="{{ asset('admins/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admins/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/admin_category.js') }}"></script>
<script >
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf_token"]').attr('content')
		}
	});
	$(function() {
		$('#tbl-booking').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('admin.booking.dataTable') !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'name', name: 'name' },
			{ data: 'phone', name: 'phone' },
			{ data: 'email', name: 'email' },
			{ data: 'date', name: 'date' },
			{ data: 'time', name: 'time' },			
			{ data: 'number_of_guess', name: 'number_of_guess' },
			{ data: 'status', name: 'status' },
			{ data: 'action', name: 'action', orderable: false, searchable: false}
			]
		});
	});
	$('#formAdd').on('submit',  function(event) {
		//prevent open new window 
		event.preventDefault();
		$.ajax({
			url: '{{ route('admin.booking.store') }}',
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {
				name: $('#name').val(),
				email: $('#email').val(),
				phone: $('#phone').val(),
				address: $('#address').val(),
				date: $('#date').val(),
				time: $('#time').val(),
				number_of_guess: $('#number_of_guess').val(),
			},
			success: function(response){
				$('#modalAdd').modal('hide');
				$('#tbl-booking').prepend('<tr id='+response.id+'><td>'+response.id+'</td><td>'+response.name+'</td><td>'+response.phone+'</td><td>'+response.email+'</td><td>'+response.date+'</td><td>'+response.time+'</td><td>'+response.number_of_guess+'</td><td>'+status+'</td><td><a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id='+response.id+'></a>&nbsp;<a title="Update" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='+response.id+'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='+response.id+'></a></td></tr>');
				toastr["success"]("Add new Category successfully!");
			},
			error: function(xhr, status, errorThrown){
				$errs = xhr.responseJSON.errors;
				console.log($errs);
				toastr['error'](errorThrown);
				toastr['error']($errs['name'][0]);
				toastr['error']($errs['description'][0]);
			} 
		})
	});
	//delete 
	$('#tbl-booking').on('click','.btnDelete', function(e){
		var id = $(this).data('id');
		
		var parent = $(this).parent();
		e.preventDefault();
		swal({			
			title: "Are you sure?",
			text: "Once deleted, you will delete this booking!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					type: "delete",
					url: '{{ asset('') }}admin/booking/delete/'+id,
					success: function(res)
					{
						toastr.success('The booking has been deleted!');
						parent.slideUp(300, function () {
							parent.closest("tr").remove();
						});
					},
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseJSON.errors);
						toastr.error(thrownError);
					}
				});				
			} else {
				swal("The booking is safety!");
			}
		});
	});
	$('#tbl-booking').on('click', '.btnShow', function(e){
		e.preventDefault();
		
		var id = $(this).data('id');
		// alert(id);
		$.ajax({
			url: '{{ asset('') }}admin/booking/'+id,
			type: 'GET',
			success: function(res)
			{				
				var qty = res.length;
				$('#modalShow').modal('show');	
				$('#tbl-show-booking tbody tr').remove();
				res.forEach(function(item) {
					// console.log(item);
					$('#tbl-show-booking').prepend('<tr style="font-weight: bold;"><td>'+item.id+'</td><td style="width: 20%"><img src="{{ asset('') }}'+item.thumbnail+'" class=" img-responsive img-rounded" style=""></td><td>'+item.name+'</td><td class="text-right">'+item.price+' $/ <strike style="color: red">'+item.origin_price+'$</strike></td><td class="text-center">'+item.quantity+'</td><td class="text-right" style="color: red">'+item.price*item.quantity+'$</td></tr>');
				});
				
				
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.responseJSON.errors);
				toastr.error(thrownError);
			}
		})
	})
	$('#tbl-category').on('click', '.btnEdit', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$('#modalEdit').modal('show');
		document.getElementById('formEdit').reset();
		$.ajax({
			url: '{{ asset('') }}admin/category/edit/'+id,
			type: 'GET',
			success: function(res){
				// alert(res.id);
				$('#edit-title-name').text(res.name);
				$('#edit-name').attr('value',res.name);
				$('#edit-description').attr('value',res.description);
				$('#edit-parent-id').text(res.parent);
				$('#edit-parent-old').attr('value',res.parent_id);
				$('#edit-parent-old').attr('selected',true);
				$('#edit-parent-old').attr('data-level',res.level);
				$('#edit-parent-old').text(res.parent);
				$('#edit-id').attr('value',res.id);
				$('#edit-has-sub-cate').attr('value',res.has_sub_cate);
			},
			error: function(xhr, ajaxOptions, thrownError){
				console.log(xhr.responseJSON.errors);
				toastr.error(thrownError);
			}
		})		
	})
	$('#formEdit').on('submit',function(e){
		e.preventDefault();
		var id =  $('#formEdit #edit-id').attr('value');
		var row = document.getElementById(id);
		$.ajax({
			url: '{{ asset('') }}admin/category/update/'+id,
			type: 'PUT',
			data: {
				name: $('#edit-name').val(),
				description: $('#edit-description').val(),
				parent_id: $('#formEdit #parent-id option:selected').val(),
				level: $('#formEdit #parent-id option:selected').data('level'),
			},
			success: function(response){
				$('#modalEdit').modal('hide');
				row.remove();
				$('#tbl-category').prepend('<tr id='+response.id+'><td>'+response.id+'</td><td>'+response.name+'</td><td>'+response.parent+'</td><td>'+response.level+'</td><td>'+response.description+'</td><td>'+response.created_at+'</td><td><a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id='+response.id+'></a>&nbsp;<a title="Update" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='+response.id+'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='+response.id+'></a></td>');
				toastr['success']('Update successfully!');
			},
			error: function(xhr, ajaxOptions, thrownError){
				// toastr['error'](response.error);
			}
		})
	})
</script>
@endsection