<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::with(['permissions'])->get();
        $permissions = Permission::pluck('title', 'id');

        return view('admin.roles.index', compact('roles','permissions'));
    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions');
        
        $response = array(
            'rowData' => $role,
            'type' => 'edit',
        );
        
        return response($response, 200);
    }
    
    public function store(StoreRoleRequest $request)
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validated = $request->validate([
            'title' => 'required|unique:roles|max:255',
        ]);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));
        
        $role = Role::with(['permissions'])->where('id',$role->id)->get();
        
        $response = array(
            'title' => 'New Role Created',
            'message' => $request->input('title'),
            'rowData' => $role,
            'type' => 'create',
        );
        
        return response($response, 200);
    }
    
    public function update(UpdateRoleRequest $request, Role $role)
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);

        $role->update($request->all());
        $id = $role->id;
        if ($id != 1) {
            $role->permissions()->sync($request->input('permissions', []));
        }else{
            abort(406, 'Not Acceptable');
        }

        $role = Role::with(['permissions'])->where('id',$role->id)->get();

        $response = array(
            'title' => 'Role Updated',
            'message' => 'Role ID '.$id.' Updated Succesfully',
            'rowData' => $role,
            'type' => 'update',
        );
        
        return response($response, 200);
    }
    
    public function destroy(Role $role)
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if ($role->id != 1) {
            $role->forceDelete();
        }else{
            abort(406, 'Not Acceptable');
        }
        
        $response = array(
            'title' => 'Role Deleted',
            'message' => '"'.$role->title.'" Role has been Deleted',
            'rowData' => $role,
            'type' => 'destroy',
        );

        return response($response, 200);
    }
    
    public function massDestroy(MassDestroyRoleRequest $request)
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arr = request('ids');
        foreach($arr as $id){
            if ($id != 1) {
                Role::whereIn('id', request('ids'))->forceDelete();
            }else{
                abort(406, 'Not Acceptable');
            }
        }
        
        $response = array(
            'title' => 'Roles Deleted',
            'message' => 'Selected Roles were Deleted',
            'ids' => $arr,
            'type' => 'massDestroy',
        );
        
        return response($response, 200);
    }

    public function show(Role $role)
    {
        abort(404,'Page not found');
    }

    public function create()
    {
        abort(404,'Page not found');
    }
}