<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $response = array(
            'rowData' => $permission,
            'type' => 'edit',
        );
        
        return response($response, 200);
    }
    
    public function store(StorePermissionRequest $request)
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validated = $request->validate([
            'title' => 'required|unique:permissions|max:255',
        ]);
        
        $permission = Permission::create($request->all());
        
        $response = array(
            'title' => 'New Permission Created',
            'message' => $request->input('title'),
            'rowData' => $permission,
            'type' => 'create',
        );
        
        return response($response, 200);
    }
    
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);

        $permission->update($request->all());
        $id = $permission->id;

        $response = array(
            'title' => 'Permission Updated',
            'message' => 'Permission ID '.$id.' Updated Succesfully',
            'rowData' => $permission,
            'type' => 'update',
        );
        
        return response($response, 200);
    }
    
    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $permission->forceDelete();
        
        $response = array(
            'title' => 'Permission Deleted',
            'message' => '"'.$permission->title.'" Permission has been Deleted',
            'rowData' => $permission,
            'type' => 'destroy',
        );

        return response($response, 200);
    }
    
    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arr = request('ids');

        Permission::whereIn('id', request('ids'))->forceDelete();
        
        $response = array(
            'title' => 'Permissions Deleted',
            'message' => 'Selected Permissions were Deleted',
            'ids' => $arr,
            'type' => 'massDestroy',
        );
        
        return response($response, 200);
    }

    public function show(Permission $permission)
    {
        abort(404,'Page not found');
    }

    public function create()
    {
        abort(404,'Page not found');
    }
}