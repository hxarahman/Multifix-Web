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
                            <h5 class="m-b-10">Permissions</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">User Management</a></li>
                            <li class="breadcrumb-item"><a href="#!">Permissions</a></li>
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
                            <h5>User Permissions</h5>
                            <div class="card-header-right">
                                @can('permission_delete')
                                <button data-url="{{ route('admin.permissions.massDestroy') }}" type="button" class="btn waves-effect waves-light btn-danger m-0" id="DeleteSelectedRows">
                                    Delete Selected Rows
                                </button>
                                @endcan
                                @can('permission_create')
                                <button type="button" class="btn waves-effect waves-light btn-primary m-0" data-toggle="modal" data-target="#PermissionModal">
                                    Add New Permission
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
                                            @canany(['permission_edit','permission_delete'])
                                            <th>Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permissions as $key => $permission)
                                        <tr id="Row{{ $permission->id ?? '' }}">
                                            <td></td>
                                            <td>{{ $permission->id ?? '' }}</td>
                                            <td>{{ $permission->title ?? '' }}</td>
                                            @canany(['permission_edit','permission_delete'])
                                            <td>
                                                @can('permission_edit')
                                                <button data-url="{{ route('admin.permissions.edit', $permission->id ?? 0) }}" class="editRow btn btn-info btn-sm has-ripple"><i class="feather icon-edit"></i>&nbsp;Edit <span class="ripple ripple-animate"></span></button>
                                                @endcan
                                                @can('permission_delete')
                                                <button data-url="{{ route('admin.permissions.destroy', $permission->id ?? 0) }}" class="deleteRow btn btn-danger btn-sm has-ripple"><i class="feather icon-trash-2"></i>&nbsp;Delete <span class="ripple ripple-animate"></span></button>
                                                @endcan
                                            </td>
                                            @endcanany
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

<div class="modal fade" id="PermissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="feather icon-briefcase mr-1"></i>Add New Permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="PermissionForm" action="{{ route("admin.permissions.index") }}">
                <div class="modal-body text-left">
                    <div class="form-group">
                        <label>Permission Name</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Permission Name">
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

<div class="modal fade" id="PermissionUpdateModal" tabindex="-1" role="dialog" aria-labelledby="PermissionUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PermissionUpdateModalLabel"><i class="feather icon-briefcase mr-1"></i>Add New Permission</h5>
                <button type="button" onclick="clearForm()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="PermissionUpdateForm" data-id="0" action="{{ route("admin.permissions.index") }}">
                <div class="modal-body text-left">
                    <div class="form-group">
                        <label>Permission Name</label>
                        <input type="text" class="form-control" name="title" id="title-u" placeholder="Enter Permission Name">
                        <input type="hidden" name="_method" value="PUT">
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
    var PermissionTable = $('#checkbox-select').DataTable({
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
    
    @can('permission_create')
    $('#PermissionForm').on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        var actionUrl = form.attr('action');
        callAjax(form.serialize(), actionUrl, "POST");
    });
    @endcan     

    @can('permission_edit')
    $('#PermissionUpdateForm').on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        var actionUrl = form.attr('action') +'/'+ form.attr('data-id');
        callAjax(form.serialize(), actionUrl, "POST");
    });
    @endcan

    @can('permission_delete')
    function deleteBtnInit() {
        $(".deleteRow").click(function(){
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Permission!",
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

    @can('permission_edit')
    function editBtnInit() {
        $(".editRow").click(function(){
            let btn = $(this);
            let actionUrl = btn.attr("data-url");
            callAjax({}, actionUrl, "GET");
        });
    }
    editBtnInit();
    @endcan

    @can('permission_delete')
    $("#DeleteSelectedRows").click(function(){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Permission!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                let btn = $(this);
                let arr = [];
                $.each(PermissionTable.rows('.selected').data(),function(key,value){
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

    @canany(['permission_create','permission_edit','permission_delete'])
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
                PermissionTable.row('#Row'+response.rowData.id).remove().draw(!1);
                break;
            case 'massDestroy':
                $.each(response.ids, function(index, value){
                    PermissionTable.row('#Row'+value).remove().draw(!1);
                });
                break;
            case 'edit':
                $('#title-u').val(response.rowData.title);
                $('#PermissionUpdateForm').attr('data-id', response.rowData.id)
                $('#PermissionUpdateModal').modal('toggle')
                break;
            case 'update':
                $('#Row'+response.rowData.id+' td:nth-child(3)').text(response.rowData.title);
                $('#PermissionUpdateModal').modal('toggle')
                clearForm();
                break;
            default:
                let buttons = `
                    <button data-url="/admin/permissions/`+response.rowData.id+`/edit" class="editRow btn btn-info btn-sm has-ripple"><i class="feather icon-edit"></i>&nbsp;Edit <span class="ripple ripple-animate"></span></button>
                    <button data-url="/admin/permissions/`+response.rowData.id+`" class="deleteRow btn btn-danger btn-sm has-ripple"><i class="feather icon-trash-2"></i>&nbsp;Delete <span class="ripple ripple-animate"></span></button>
                `;
                let row = PermissionTable.row.add([
                    null,
                    response.rowData.id,
                    response.rowData.title,
                    buttons,
                ]).draw(false);
                row.nodes().to$().attr('id', 'Row'+response.rowData.id);
                clearForm();
                deleteBtnInit();
                editBtnInit();
                $('#PermissionModal').modal('toggle');
                $('#checkbox-select').DataTable();
        }
    }
    @endcanany

</script>
@stop
