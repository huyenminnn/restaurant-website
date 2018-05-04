@extends('admin.layouts.master')

@section('css.dataTable')
<link rel="stylesheet" href="{{ asset('admins/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('admins/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"> --}}

@endsection

@section('cate')
Slider
@endsection

@section('sup_cate')
Restaurant
@endsection


@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Slider</h3>
					<a class="btn btn-primary fas fa-plus " data-toggle="modal" href='#modalAdd' style="float: right">&nbsp;<i class="fas fa-bars"></i></a>
					<div class="modal fade" id="modalAdd">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">Add new image</h4>
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
											<label for="">
												<i class="fa fa-picture-o font-green" aria-hidden="true">Image</i>
											</label>			
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-new thumbnail" style="max-width: 250px;">
													<img id="previewimg" src="" alt="No Image" class="img-responsive" /> 
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 200px;"> </div>
												<div style="margin-top: 10px;">
													<span class="input-group-btn">
														<a id="lfm" data-input="thumbnail" data-preview="previewimg" class="btn btn-primary">
															<input type="file" name="thumbnail" id="thumbnail">
														</a>
													</span>
													@if ($errors->has('thumbnail'))
													<span class="errors">{{$errors->first('thumbnail')}}</span>
													@endif

												</div>
											</div>
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
					<table class="table table-hover table-bordered" id="tbl-slider">
						<thead>
							<tr>
								<th width="5%" class="text-center">ID</th>
								<th>Image</th>
								<th>Title</th>
								<th>Description</th>
								<th>Hidden</th>
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
		$('#tbl-slider').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('admin.pages.dataTable') !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'image', name: 'image', render: function(data, type, full, meta){
				return '<img src=\"http://tash.restaurant/'+data+'" alt="" height="80px">' }
			},
			{ data: 'title', name: 'title' },
			{ data: 'description', name: 'description' },
			{ data: 'hidden', name: 'hidden' },
			{ data: 'action', name: 'action', orderable: false, searchable: false}
			]
		});
	});

	$('#formAdd').on('submit',  function(event) {
		//prevent open new window 
		event.preventDefault();

		$.ajax({
			url: '{{ route('admin.pages.store') }}',
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {
				title: $('#name').val(),
				description: $('#description').val(),
				image: $('#thumbnail').get(0).files[0],
			},
			success: function(response){
				// alert(response.message);
				$('#modalAdd').modal('hide');

				$('#tbl-slider').prepend('<tr id='+response.id+'><td>'+response.id+'</td><td>'+response.name+'</td><td>'+response.parent+'</td><td>'+response.level+'</td><td>'+response.description+'</td><td>'+response.created_at+'</td><td><a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id='+response.id+'></a>&nbsp;<a title="Update" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='+response.id+'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='+response.id+'></a></td></tr>');


				toastr["success"]("Add new Image successfully!");
			},
			error: function(xhr, status, errorThrown){
				$errs = xhr.responseJSON.errors;
				console.log($errs);
				toastr['error'](errorThrown);
				// toastr['error']($errs['name'][0]);
				// toastr['error']($errs['description'][0]);
			} 
		})
	});

	//delete 
	$('#tbl-slider').on('click','.btnDelete', function(e){

		var id = $(this).data('id');
		
		var parent = $(this).parent();

		e.preventDefault();

		swal({			
			title: "Are you sure?",
			text: "Once deleted, you will delete this image!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {

			if (willDelete) {

				$.ajax({

					type: "delete",
					url: '{{ asset('') }}admin/pages/delete/'+id,

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

</script>
@endsection
