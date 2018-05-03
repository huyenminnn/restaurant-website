@extends('admin.layouts.master')

@section('css.section')
<link rel="stylesheet" href="{{ asset('admin_assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<style>
#modalShow th{
	width: 25%;
}
</style>
@endsection
@section('cate')
Admins
@endsection

@section('sup_cate')
Admin
@endsection

@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Table of Admins</h3>
					<a class="btn btn-primary fas fa-plus " data-toggle="modal" href='#modalAdd' style="float: right">&nbsp;<i class="fas fa-users"></i></a>

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table class="table table-hover table-bordered" id="tbl-admins">
						<thead>
							<tr>
								<th width="5%" class="text-center">ID</th>
								<th>Name</th>
								<th>Avatar</th>
								<th width="15%">Email</th>
								{{-- <th>Level</th> --}}
								<th>Phone</th>
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
</section>

<!-- Modal Shows-->
{{-- <div id="modalShow" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Information of admin: <span id="showT-name"></span></h4>
			</div>
			<div class="modal-body">
				<table class="table table-hover">
					<tr>
						<th>ID</th>
						<td id="showT-id"></td>
					</tr>
					<tr>
						<th>Name</th>
						<td id="showT-name-1"></td>
					</tr>
					<tr>
						<th>Created_at</th>
						<td id="showT-created-at"></td>
					</tr>
					<tr>
						<th>Lastest updated</th>
						<td id="showT-updated-at"></td>
					</tr>

				</table>
			</div>

		</div>
	</div>
</div> --}}
<!-- ./ModalShow -->

<!-- Modal Edit-->
<div id="modalEdit" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit admin: <span id="edit-name"></span></h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<form  class="form-horizontal" role="form" id="formEdit">
						@csrf
						{{ method_field('put')}}

						<input type="hidden" name="id" value="" id="id">
						<div class="form-group">
							<label for="">Name</label>
							<input type="text" class="form-control" id="editT-name" name="name">
						</div>

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>					
			</div>
		</div>
	</div>
</div>
<!-- ./ModalEdit -->
@endsection

@section('js.section')
<script src="{{ asset('admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf_token"]').attr('content')
		}
	});

	$(function() {
		$('#tbl-admins').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('admin.admins.dataTable') !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'name', name: 'name' },
			{ data: 'avatar', name: 'avatar', render: function(data, type, full, meta){
				return '<img src=\"http://tash.restaurant/'+data+'" alt="" height="80px">' }
			},
			{ data: 'email', name: 'email' },
			{ data: 'phone', name: 'phone' },
			{ data: 'created_at', name: 'created_at' },
			{ data: 'action', name: 'action', orderable: false, searchable: false}
			]
		});
	});

	//add new admin
	$('#formAddAdmin').on('submit', function(event) {
		//khong tao cua so moi
		event.preventDefault();

		// DAU PHAY, reponse: gia tri controller tra ve
		$.ajax({
			type: 'post',
			url: '{{ route('admin.admins.store') }}',
			data: {
				name: $("#name").val(),
			},

			success: function (response) {
				// alert(response.message);
				$('#modalAdd').modal('hide');

				toastr["success"]("Add new admin successfully!");

				$('#tbladmin').prepend('<tr><td width="5%">'+response.id+'</td><td>'+response.name+'</td><td>'+response.created_atd+'</td><td>'+response.updated_at+'</td><td width="20%"><a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-admin-id="'+response.id+'"></a>&nbsp;&nbsp;<a title="Update" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-admin-id="'+response.id+'"></a>&nbsp;&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-admin-id="'+response.id+'"></a><td></tr>');

			},
			error: function (xhr, status, errorThrown){
				$errs = xhr.responseJSON.errors;
				console.log($errs);
				toastr['error'](errorThrown);
				toastr['error']($errs['name'][0]);
			}
		})
	});

	//show an admin
	$('.btnShow').on('click', function (event) {
		$('#modalShow').modal('show');

		var id = $(this).data('admin-id');
		// alert(id);
		$.ajax({
			url: '{{ asset('') }}admin/admins/'+id,
			type: 'GET',
			success: function(response) {
				$('#showT-id').text(response.id),
				$('#showT-name').text(response.name),
				$('#showT-name-1').text(response.name),
				$('#showT-updated-at').text(response.updated_at);
				$('#showT-created-at').text(response.created_at);
			},

			error: function() {
				// body...
			}
		})		
	})

	//delete 
	$('.btnDelete').on('click', function(e){

		var id = $(this).data('admin-id');
		
		var parent = $(this).parent();

		e.preventDefault();

		swal({			
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recovery this admin!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {

			if (willDelete) {

				$.ajax({

					type: "delete",
					url: '{{ asset('') }}admin/admins/delete/'+id,

					success: function(res)
					{
						parent.slideUp(300, function () {
							parent.closest("tr").remove();
						});
						toastr.success('The admin has been deleted!');
					},

					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseJSON.errors);
						toastr.error(thrownError);
					}
				});

				

			} else {
				swal("The admin is safety!");
			}
		});
	});

	// show info to update
	$('.btnEdit').on('click', function (event) {
		$('#modalEdit').modal('show');

		var id = $(this).data('admin-id');
		// alert(id);
		$.ajax({
			url: '{{ asset('') }}admin/admins/'+id,
			type: 'GET',
			success: function(response) {
				$('#edit-name').text(response.name);
				$('#formEdit #id').attr('value', response.id);
				$('#editT-name').attr('value', response.name);
			},

			error: function() {
				// body...
			}
		})		
	})

	//update admin
	$('#formEdit').on('submit', function(event) {
		//khong tao cua so moi
		event.preventDefault();

		var id = $('#formEdit #id').val();

		var level = $("#parent_id option:selected").attr("data-level"); //

		var row = document.getElementById('row-'+id); //row: admin update

		// DAU PHAY, reponse: gia tri controller tra ve
		$.ajax({
			type: 'put',
			url: '{{ asset('') }}admin/admins/update/'+id,
			data: {
				name: $("#editT-name").val(),
			},

			success: function (response) {
				// alert(response.message);
				$('#modalEdit').modal('hide');
				
				row.remove();

				toastr["success"]("Update admin successfully!");

				$('#tbladmin').prepend('<tr><td width="5%">'+response.id+'</td><td>'+response.name+'</td><td>'+response.created_at+'</td><td>'+response.updated_at+'</td><td width="20%"><a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-admin-id="'+response.id+'"></a>&nbsp;&nbsp;<a title="Update" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-admin-id="'+response.id+'"></a>&nbsp;&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-admin-id="'+response.id+'"></a><td></tr>');

				

			},
			error: function (xhr, status, errorThrown){
				// toastr.error(thrownError);
			}
		})
	});
	
</script>
@endsection