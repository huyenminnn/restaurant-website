@extends('admin.layouts.master')

@section('css.dataTable')
{{-- <link rel="stylesheet" href="{{asset('admins/bower_components/prism-gh-pages/themes/prism.css')}}"> --}}
<link rel="stylesheet" href="{{ asset('admins/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/bower_components/bootstrap-fileinput-master/css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/bower_components/bootstrap-tagsinput-master/src/bootstrap-tagsinput.css') }}">
<style>
#modalAdd .modal-dialog{
	margin: 5%;
}

</style>
@endsection

@section('cate')
Food - Drink Management
@endsection

@section('sup_cate')
Products
@endsection

@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Table of Products</h3>
					<a class="btn btn-primary fas fa-plus " data-toggle="modal" href='#modalAdd' style="float: right">&nbsp;<i class="fas fa-bars"></i></a>

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table class="table table-hover table-bordered" id="tbl-product">
						<thead>
							<tr>
								<th width="5%" class="text-center">ID</th>
								<th>Name</th>
								<th>Thumbnail</th>
								<th width="15%">Category</th>
								{{-- <th>Level</th> --}}
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
</section>

{{-- modalAdd --}}
<div class="modal fade" id="modalAdd">
	<div class="modal-dialog container-fluid">
		<div class="modal-content container">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add new product</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form" id="formAdd" name="formAdd" >
					@csrf
					<div class="form-group">
						<table class="table">							
							<tr>
								<td>
									<div class="form-group">
										<label for="">Name</label>
										<input type="text" class="form-control" id="name" placeholder="Name" name="name" >
									</div>
								</td>
								<td>
									<div class="form-group">
										<label for="">Origin price</label>
										<input type="text" class="form-control" id="origin_price" placeholder="Origin price" name="origin_price" >
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
										<label for="">Category</label>
										<select name="category_id" id="category_id" class="form-control" required="required" >
											@foreach ($categories as $category)
											<option value="{!!$category['id']!!}">{!!$category['name']!!}</option>
											@endforeach												
										</select>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label for="">Sale price</label>
										<input type="text" class="form-control" id="price" placeholder="Sale price" name="price" >
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="form-group">
										<label for="">Description</label>
										<textarea type="text" class="form-control" id="description" placeholder="Description" name="description"></textarea>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="form-group">
										<label for="">Content(<span style="color: red">*</span>)</label>
										<textarea class="form-control ckeditor" name="content" id="content" cols="30" rows="10" placeholder="Content"></textarea> 
										@if ($errors->has('content'))
										<span class="errors">{{$errors->first('content')}}</span>
										@endif
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="form-group">
										<label for="">
											<i class="fa fa-picture-o font-green" aria-hidden="true"> Thumbnail</i>
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
								</td>
							</tr>
						</table>
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

{{-- modal Show --}}
<div class="modal fade" id="modalShow">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tash Res: <span id="show-name"></span></h4>
			</div>
			<div class="modal-body">

				<table class="table">	

					<tr>
						<td  colspan="2">
							<img src="" alt="" id="show-thumbnail" width="100%">
						</td>
					</tr>						
					<tr>							
						<td id="show-description" colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2" id="show-content"></td>
					</tr>
					<tr>
						<th>Category</th>
						<td id="show-category"></td>
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
				<h3 class="modal-title">Tah Res: Edit <span id="edit-title-name"></span> </h3>
			</div>
			<div class="modal-body">
				<form action=""  role="form" id="formEdit" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					
					<input type="hidden" name="product-id" value="" id="edit-id">
					<div class="form-group">
						<table class="table">							
							<tr>
								<td>
									<div class="form-group">
										<label for="">Name</label>
										<input type="text" class="form-control" id="edit-name"  name="name" >
									</div>
								</td>
								<td>
									<div class="form-group">
										<label for="">Origin price</label>
										<input type="text" class="form-control" id="edit-origin-price"  name="origin-price" >
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
										<label for="">Category</label>
										<select name="category_id" id="edit_category_id" class="form-control" required="required" >
											<option value="" selected="true" id="edit-category-old"></option>
											@foreach ($categories as $category)
											<option value="{!!$category['id']!!}">{!!$category['name']!!}</option>
											@endforeach												
										</select>
									</div>
								</td>
								<td>
									<div class="form-group">
										<label for="">Sale price</label>
										<input type="text" class="form-control" id="edit-price" name="price" >
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="form-group">
										<label for="">Description</label>
										<textarea type="text" class="form-control" id="edit-description" name="description"></textarea>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="form-group">
										<label for="">Content(<span style="color: red">*</span>)</label>
										<textarea class="form-control ckeditor" name="content" id="edit_content" cols="30" rows="10" placeholder="Content"></textarea> 
										@if ($errors->has('content'))
										<span class="errors">{{$errors->first('content')}}</span>
										@endif
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="form-group">
										<label for="">
											<i class="fa fa-picture-o font-green" aria-hidden="true"> Thumbnail</i>
										</label>			
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="max-width: 250px;">
												<img id="edit-previewimg" src="" alt="No Image" class="img-responsive" /> 
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 200px;"> </div>
											<div style="margin-top: 10px;">
												<span class="input-group-btn">
													<a id="lfm" data-input="thumbnail" data-preview="previewimg" class="btn btn-primary">
														<input type="file" name="thumbnail" id="edit-thumbnail">
													</a>
												</span>
												@if ($errors->has('thumbnail'))
												<span class="errors">{{$errors->first('thumbnail')}}</span>
												@endif

											</div>
										</div>
									</div>
								</td>
							</tr>
						</table>
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
<!-- /.content -->
@endsection


@section('js.dataTable')
<script src="{{ asset('admins/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admins/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
{{-- <script src="{{ asset('admins/bower_components/tinymce/js/tinymce/tinymce.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admins/bower_components/prism-gh-pages/prism.js') }}"></script> --}}
<script src="{{ asset('admins/bower_components/bootstrap-fileinput-master/js/fileinput.min.js') }}"></script>
<script src="{{ asset('admins/bower_components/bootstrap-tagsinput-master/src/bootstrap-tagsinput.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('admins/bower_components/ckeditor/ckeditor.js') }}"></script>
<script src="">		
	CKEDITOR.replace('#content')
	// CKEDITOR.replace('#edit_content')
</script>
<script >

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf_token"]').attr('content')
		}
	});

	$(function() {
		$('#tbl-product').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('admin.product.dataTable') !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'name', name: 'name' },
			{ data: 'thumbnail', name: 'thumbnail', render: function(data, type, full, meta){
				return '<img src=\"http://tashres.com/'+data+'" alt="" height="80px">' }
			},
			{ data: 'category_name', name: 'category' },
			{ data: 'description', name: 'description' },
			{ data: 'created_at', name: 'created_at' },
			{ data: 'action', name: 'action', orderable: false, searchable: false}
			]
		});
	});

	$('#formAdd').on('submit', function(event) {

		event.preventDefault();

		var thumbnail = $('#thumbnail').get(0).files[0];
		var content = CKEDITOR.instances['content'].getData();
		var newProduct = new FormData();

		newProduct.append('name',$('#name').val());
		newProduct.append('description',$('#description').val());
		newProduct.append('content',content);
		newProduct.append('category_id',$('#category_id').val());
		newProduct.append('thumbnail',thumbnail);
		newProduct.append('origin_price',$('#origin_price').val());
		newProduct.append('price',$('#price').val());

		$.ajax({
			url: '{{ route('admin.product.store') }}',
			type: 'POST',
			processData: false,
			contentType: false,
			cache: false,
			dataType: 'JSON',
			data: newProduct,

			success:function(res){
				$('#modalAdd').modal('hide');
				console.log(res);
				$('#tbl-product').prepend('<tr><td>'+res['id']+'</td><td>'+res['name']+'</td><td><img src="http://tashres.com/'+res['thumbnail']+'" alt=""></td><td>'+res['category_name']+'</td><td>'+res['description']+'</td><td>'+res['created_at']+'</td><td><a name="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id="'+res["id"]+'" id="row-'+res["id"]+'"></a>&nbsp;<a name="Update" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='+res["id"]+'></a>&nbsp;<a name="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='+res["id"]+'></a></td></tr>');
				toastr['success']("Add product successfully!");
			},
			error:function(xhr, ajaxOptions, thrownError){
				// console.log(xhr.responseJSON.errors);
				toastr.error(thrownError);
			}
		})
	});

	$('#tbl-product').on('click', '.btnShow', function(event){
		event.preventDefault();
		var id = $(this).data('id');
		// alert(id);
		$.ajax({
			url: '{{ asset('') }}/admin/product/'+id,
			type: 'GET',
			success: function(res) {
				$('#modalShow').modal('show');
				$('#show-thumbnail').attr('src', "http://tashres.com/"+res.thumbnail);
				$('#show-name').text(res.name);
				$('#show-description').text(res.description);
				$('#show-created-at').text(res.created_at);
				$('#show-updated-at').text(res.updated_at);
				$('#show-category').text(res.category_info.name);
				$('#show-content').text(res.content);
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr.error(thrownError);
			}
		})
	})

	$('#tbl-product').on('click', '.btnEdit', function(event){
		event.preventDefault();
		var id= $(this).data('id');
		document.getElementById('formEdit').reset();
		$.ajax({
			url: '{{ asset('') }}/admin/product/edit/'+id,
			type: 'GET',
			success: function(res){
				$('#modalEdit').modal('show');
				$('#edit-id').attr('value',res.id);
				$('#edit-name').attr('value',res.name);
				$('#edit-origin-price').attr('value',res.origin_price);
				$('#edit-price').attr('value',res.price);
				$('#edit-title-name').attr('value',res.name);
				$('#edit-description').text(res.description);
				$('#edit-category-old').attr('value',res.category_info.id);
				$('#edit-category-old').text(res.category_info.name);
				$('#edit-previewimg').attr('src',"http://tashres.com/"+res.thumbnail);
				CKEDITOR.instances.edit_content.setData(res.content);
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr.error(thrownError);
			}
		})			
	})

	$('#tbl-product').on('click','.btnDelete', function(e){

		var id = $(this).data('id');
		
		var parent = $(this).parent();

		e.preventDefault();

		swal({			
			title: "Are you sure?",
			text: "Once deleted, you will delete this product!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {

			if (willDelete) {

				$.ajax({

					type: "delete",
					url: '{{ asset('') }}admin/product/delete/'+id,

					success: function(res)
					{
						toastr.success('The product has been deleted!');
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
				swal("The product is safety!");
			}
		});
	});

	$('#formEdit').on('submit', function(event){

		event.preventDefault();

		var id = $('#edit-id').val();
		
		var row = document.getElementById(id);

		var thumbnail = $('#edit-thumbnail').get(0).files[0];

		var content = CKEDITOR.instances['edit_content'].getData();

		var newInfor = new FormData();

		newInfor.append('name',$('#edit-name').val());
		newInfor.append('description',$('#edit-description').val());
		newInfor.append('content',content);
		newInfor.append('category_id',$('#formEdit #category_id option:selected').val());
		newInfor.append('thumbnail',thumbnail);
		newInfor.append('origin_price',$('#edit-origin-price').val());
		newInfor.append('price',$('#edit-price').val());

		$.ajax({
			url: '{{ asset('') }}admin/product/update/'+id,
			type: 'PUT',
			processData: false,
			contentType: false,
			cache: false,
			dataType: 'JSON',
			data: newInfor,
			success:function(res){
				$('#modalEdit').modal('hide');
				console.log(res);
				// toastr['success']('Update successfull!');
				// console.log(res['price']);
			},
			error:function(xhr, ajaxOptions, thrownError){

			}
		})
	})

</script>
@endsection