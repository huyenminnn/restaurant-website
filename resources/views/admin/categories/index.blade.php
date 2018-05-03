@extends('admin.layouts.master')

@section('css.dataTable')
<link rel="stylesheet" href="{{ asset('admins/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('admins/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"> --}}

@endsection

@section('cate')
Category
@endsection

@section('sup_cate')
Product
@endsection


@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Table of Category</h3>
					<a class="btn btn-primary fas fa-plus " data-toggle="modal" href='#modalAdd' style="float: right">&nbsp;<i class="fas fa-bars"></i></a>
					<div class="modal fade" id="modalAdd">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">Add new category</h4>
								</div>
								<div class="modal-body">
									<form action="" method="POST" role="form" id="formAdd" name="formAdd">
										@csrf
										<div class="form-group">
											<label for="">Name</label>
											<input type="text" class="form-control" id="name" placeholder="Name" name="name">
										</div>
										<div class="form-group">
											<label for="">Description</label>
											<input type="text" class="form-control" id="description" placeholder="Description" name="description">
										</div>
										<div class="form-group">
											<label for="">Super category</label>
											<select name="parent-id" id="parent-id" class="form-control" required="required" placeholder="Select super category">
												
												<option value="0" data-level="0" data-id="0">Select super category</option>
												@foreach ($categories as $category)
												<option value="{!!$category['id']!!}" data-level="{!!$category['level']!!}" ">{!!$category['name']!!}</option>
												@endforeach												
											</select>
										</div>										

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
					<table class="table table-hover table-bordered" id="tbl-category">
						<thead>
							<tr>
								<th width="5%" class="text-center">ID</th>
								<th>Name</th>
								<th width="15%">Sup Category</th>
								<th>Level</th>
								<th>Description</th>
								<th width="15%">Created at</th>
								<th width="15%">Action</th>
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
					<h4 class="modal-title">Tash Res: </h4>
				</div>
				<div class="modal-body">
					<h4 class="text-center">Details of Category: <span id="show-name-title"></span></h4>
					<br>
					<table class="table table-hover">	

						<tr>
							<th>ID</th>
							<td id="show-id"></td>
						</tr>
						<tr>
							<th>Name</th>
							<td id="show-name"></td>
						</tr>
						<tr>
							<th>Super Category</th>
							<td id="show-super-cate"></td>
						</tr>
						<tr>
							<th>Description</th>
							<td id="show-description"></td>
						</tr>
						<tr>
							<th>Level</th>
							<td id="show-level"></td>
						</tr>
						<tr>
							<th>Created at</th>
							<td id="show-created-at"></td>
						</tr>
						<tr>
							<th>Lastest updated</th>
							<td id="show-updated-at"></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal Edit --}}
	<div class="modal fade" id="modalEdit">
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
	</div>
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
		$('#tbl-category').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('admin.category.dataTable') !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'name', name: 'name' },
			{ data: 'parent', name: 'sup cate' },
			{ data: 'level', name: 'level' },
			{ data: 'description', name: 'description' },
			{ data: 'created_at', name: 'created_at' },
			{ data: 'action', name: 'action', orderable: false, searchable: false}
			]
		});
	});

	$('#formAdd').on('submit',  function(event) {
		//prevent open new window 
		event.preventDefault();

		var level = $('#parent-id option:selected').attr('data-level');
		// alert(level);
		$.ajax({
			url: '{{ route('admin.category.store') }}',
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {
				name: $('#name').val(),
				description: $('#description').val(),
				parent_id: $('#parent-id').val(),
				level: level,
			},
			success: function(response){
				// alert(response.message);
				$('#modalAdd').modal('hide');

				$('#tbl-category').prepend('<tr id='+response.id+'><td>'+response.id+'</td><td>'+response.name+'</td><td>'+response.parent+'</td><td>'+response.level+'</td><td>'+response.description+'</td><td>'+response.created_at+'</td><td><a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id='+response.id+'></a>&nbsp;<a title="Update" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='+response.id+'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='+response.id+'></a></td></tr>');


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
	$('#tbl-category').on('click','.btnDelete', function(e){

		var id = $(this).data('id');
		
		var parent = $(this).parent();

		e.preventDefault();

		swal({			
			title: "Are you sure?",
			text: "Once deleted, you will delete this sup category!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {

			if (willDelete) {

				$.ajax({

					type: "delete",
					url: '{{ asset('') }}admin/category/delete/'+id,

					success: function(res)
					{
						toastr.success('The category has been deleted!');
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
				swal("The category is safety!");
			}
		});
	});

	$('#tbl-category').on('click', '.btnShow', function(e){
		e.preventDefault();

		
		$('#modalShow').modal('show');

		var id = $(this).data('id');
		// alert(id);

		$.ajax({
			url: '{{ asset('') }}admin/category/'+id,
			type: 'GET',
			success: function(res)
			{				
				$('#show-id').text(res.id);
				$('#show-name').text(res.name);
				$('#show-name-title').text(res.name);
				$('#show-level').text(res.level);
				$('#show-description').text(res.description);
				$('#show-super-cate').text(res.parent);
				$('#show-created-at').text(res.created_at);
				$('#show-updated-at').text(res.updated_at);
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
