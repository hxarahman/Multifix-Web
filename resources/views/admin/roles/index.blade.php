@extends('layouts.admin')

@section('title')hi @stop
@section('siteDesc')desc @stop

@section('css')
    <!-- data tables css -->
    <link rel="stylesheet" href="/admin/assets/css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/assets/css/plugins/select.bootstrap4.min.css">
@stop
@section('content')
<!-- [ Main Content ] start -->

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Roles</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">User Management</a></li>
                            <li class="breadcrumb-item"><a href="#!">Roles</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
            <div class="row">
                <!-- Checkbox Select table start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>User Roles</h5>
                            <div class="card-header-right">
                                @can('role_delete')
                                <button data-url="{{ route('admin.roles.massDestroy') }}" type="button" class="btn waves-effect waves-light btn-danger m-0" id="DeleteSelectedRows">
                                    Delete Selected Rows
                                </button>
                                @endcan
                                @can('role_create')
                                <button type="button" class="btn waves-effect waves-light btn-primary m-0" data-toggle="modal" data-target="#RoleModal">
                                    Add New Role
                                </button>
                                @endcan
                                <div class="btn-group card-option">
                                <button type="button" class="btn minimize-card">
                                    <a href="#!" class="text-black"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a>
                                </button>
                            </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="checkbox-select" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="checkbox-select_info">
                                   <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Permissions</th>
                                            @canany(['role_edit','role_delete'])
                                            <th>Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $key => $role)
                                        <tr id="Row{{ $role->id ?? '' }}">
                                            <td></td>
                                            <td>{{ $role->id ?? '' }}</td>
                                            <td>{{ $role->title ?? '' }}</td>
                                            <td style="display: flex; flex-wrap: wrap;">
                                                @foreach($role->permissions as $key => $item)
                                                <span class="badge badge-success mx-1 my-1">{{ $item->title }}</span>
                                                @endforeach
                                            </td>
                                            @if($role->id != 1)
                                            @canany(['role_edit','role_delete'])
                                            <td>
                                                @can('role_edit')
                                                <button data-url="{{ route('admin.roles.edit', $role->id ?? 0) }}" class="editRow btn btn-info btn-sm has-ripple"><i class="feather icon-edit"></i>&nbsp;Edit <span class="ripple ripple-animate"></span></button>
                                                @endcan
                                                @can('role_delete')
                                                <button data-url="{{ route('admin.roles.destroy', $role->id ?? 0) }}" class="deleteRow btn btn-danger btn-sm has-ripple"><i class="feather icon-trash-2"></i>&nbsp;Delete <span class="ripple ripple-animate"></span></button>
                                                @endcan
                                            </td>
                                            @endcanany
                                            @else
                                            <td>Admin Role Cannot be Modified.</td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                 </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Checkbox Select table end -->
            </div>
            <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->

<div class="modal fade" id="RoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="feather icon-briefcase mr-1"></i>Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="RoleForm" action="{{ route("admin.roles.index") }}">
                <div class="modal-body text-left">
                    <div class="form-group">
                        <label>Role Name</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Role Name">
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <label>Permissions</label>
                        </div>
                        @foreach($permissions as $id => $permission)
                        <div class="col-md-6">
                            <div class="switch switch-success d-inline m-r-10">
                                <input type="checkbox" name="permissions[]" id="switch-s-{{ $id }}" value="{{ $id }}">
                                <label for="switch-s-{{ $id }}" class="cr"></label>
                            </div>
                            <label>{{ $permission }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn waves-effect waves-light btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn waves-effect waves-light btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="RoleUpdateModal" tabindex="-1" role="dialog" aria-labelledby="RoleUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RoleUpdateModalLabel"><i class="feather icon-briefcase mr-1"></i>Add New Role</h5>
                <button type="button" onclick="clearForm()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="RoleUpdateForm" data-id="0" action="{{ route("admin.roles.index") }}">
                <div class="modal-body text-left">
                    <div class="form-group">
                        <label>Role Name</label>
                        <input type="text" class="form-control" name="title" id="title-u" placeholder="Enter Role Name">
                        <input type="hidden" name="_method" value="PUT">
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <label>Permissions</label>
                        </div>
                        @foreach($permissions as $id => $permission)
                        <div class="col-md-6">
                            <div class="switch switch-success d-inline m-r-10">
                                <input type="checkbox" name="permissions[]" id="switch-u{{ $id }}" value="{{ $id }}">
                                <label for="switch-u{{ $id }}" class="cr"></label>
                            </div>
                            <label>{{ $permission }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn waves-effect waves-light btn-secondary" onclick="clearForm()" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn waves-effect waves-light btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('js')
<!-- datatable Js -->
<script src="/admin/assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="/admin/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script src="/admin/assets/js/plugins/dataTables.select.min.js"></script>
<script src="/admin/assets/js/global.js"></script>
<script>

    $('#title').focusout(function(e){
        var str = $(this).val();
        str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
        $(this).val(str)
    });


    // [ Checkbox Selection ]
    var RoleTable = $('#checkbox-select').DataTable({
        columnDefs: [{
            className: 'select-checkbox',
            orderable: false,
            targets: 0,
            checkbox: {
                selectRow: true,
            }
        }],
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        order: [
            [1, 'asc']
        ]
    });

    function ajaxNotPermissible(response) {

        var rT = "";
        $.each(response.responseJSON.errors.title, function(i, vL){
            rT += vL+"\n";
        });

        $.each(response.responseJSON.errors.permissions, function(i, vL){
            rT += vL+"\n";
        });

        $.each(response.responseJSON.errors.ids, function(i, vL){
            rT += vL+"\n";
        });

        new PNotify.alert({
            title: response.responseJSON.message,
            text: rT,
            type: 'error'
        }); 
    }

    $("#checkbox-select_wrapper .row:nth-child(3)").click(function(){
        console.error('sss')
        editBtnInit()
        deleteBtnInit()
    });

</script>

<script>
    
    @can('role_create')
    $('#RoleForm').on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        var actionUrl = form.attr('action');
        callAjax(form.serialize(), actionUrl, "POST");
    });
    @endcan     

    @can('role_edit')
    $('#RoleUpdateForm').on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        var actionUrl = form.attr('action') +'/'+ form.attr('data-id');
        callAjax(form.serialize(), actionUrl, "POST");
    });
    @endcan

    @can('role_delete')
    function deleteBtnInit() {
        $(".deleteRow").click(function(){
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Role!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    let btn = $(this);
                    let data = { _method: 'DELETE' };
                    let actionUrl = btn.attr("data-url");
                    callAjax(data, actionUrl, "POST");
                }
            });
        });
    }
    deleteBtnInit();
    @endcan

    @can('role_edit')
    function editBtnInit() {
        $(".editRow").click(function(){
            let btn = $(this);
            let actionUrl = btn.attr("data-url");
            callAjax({}, actionUrl, "GET");
        });
    }
    editBtnInit();
    @endcan

    @can('role_delete')
    $("#DeleteSelectedRows").click(function(){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Role!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                let btn = $(this);
                let arr = [];
                $.each(RoleTable.rows('.selected').data(),function(key,value){
                    arr.push(value[1]); //"name" being the value of your first column.
                });
                console.log(arr);
                let data = { ids: arr, _method: 'DELETE' };
                let actionUrl = btn.attr("data-url");
                callAjax(data, actionUrl, "POST");
            }
        });
    });
    @endcan

    @canany(['role_create','role_edit','role_delete'])
    function ajaxSuccess(response) 
    {
        if(response.title && response.message != undefined)
        {
            new PNotify.alert({
                title: response.title,
                text: response.message,
                type: 'success'
            });
        }

        switch(response.type) {
            case "destroy":
                RoleTable.row('#Row'+response.rowData.id).remove().draw(!1);
                break;
            case 'massDestroy':
                $.each(response.ids, function(index, value){
                    RoleTable.row('#Row'+value).remove().draw(!1);
                });
                break;
            case 'edit':
                $('#title-u').val(response.rowData.title);
                $.each(response.rowData.permissions, function(index, value){
                    $('#switch-u'+value.id).prop('checked', true);
                });
                $('#RoleUpdateForm').attr('data-id', response.rowData.id)
                $('#RoleUpdateModal').modal('toggle')
                break;
            case 'update':
                let uBadges = "";
                $.each(response.rowData[0].permissions, function(index, value){
                    uBadges += '<span class="badge badge-success mx-1 my-1">'+value.title+'</span>';
                });
                $('#Row'+response.rowData[0].id+' td:nth-child(3)').text(response.rowData[0].title);
                $('#Row'+response.rowData[0].id+' td:nth-child(4)').html(uBadges);
                $('#RoleUpdateModal').modal('toggle')
                clearForm();
                break;
            default:
                let badges = "";
                $.each(response.rowData[0].permissions, function(index, value){
                    badges += '<span class="badge badge-success mx-1 my-1">'+value.title+'</span>';
                });
                let buttons = `
                    <button data-url="/admin/roles/`+response.rowData[0].id+`/edit" class="editRow btn btn-info btn-sm has-ripple"><i class="feather icon-edit"></i>&nbsp;Edit <span class="ripple ripple-animate"></span></button>
                    <button data-url="/admin/roles/`+response.rowData[0].id+`" class="deleteRow btn btn-danger btn-sm has-ripple"><i class="feather icon-trash-2"></i>&nbsp;Delete <span class="ripple ripple-animate"></span></button>
                `;
                let row = RoleTable.row.add([
                    null,
                    response.rowData[0].id,
                    response.rowData[0].title,
                    badges,
                    buttons,
                ]).draw(false);
                row.nodes().to$().attr('id', 'Row'+response.rowData[0].id);
                clearForm();
                deleteBtnInit();
                editBtnInit();
                $('#RoleModal').modal('toggle');
                $('#checkbox-select').DataTable();
        }
    }
    @endcanany

</script>
@stop
