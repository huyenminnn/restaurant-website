$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf_token"]').attr('content')
    }
});

$(function() {
    $('#tblCategory').DataTable({
        processing: true,
        serverSide: true,
        ajax: "route('admin.category.dataTable')",
        columns: [
        { data: 'id', name: '#' },
        { data: 'name', name: 'name' },
        { data: 'level', name: 'level' },
        { data: 'description', name: 'description' },
        { data: 'created_at', name: 'created_at' },
        { data: 'updated_at', name: 'updated_at' }
        ]
    });
});
