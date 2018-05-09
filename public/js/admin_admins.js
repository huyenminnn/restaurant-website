$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf_token"]').attr('content')
    }
});

$(function() {
    $('#tblAdmin').DataTable({
        processing: true,
        serverSide: true,
        ajax: "route('admin.admins.dataTable')",
        columns: [
        { data: 'id', name: '#' },
        { data: 'name', name: 'name' },
        { data: 'avatar', name: 'avatar' },
        { data: 'password', name: 'password' },
        { data: 'phone', name: 'phone' },
        { data: 'email', name: 'email' },
        { data: 'birthday', name: 'birthday' },
        { data: 'created_at', name: 'created_at' },
        { data: 'updated_at', name: 'updated_at' }
        ]
    });
});

