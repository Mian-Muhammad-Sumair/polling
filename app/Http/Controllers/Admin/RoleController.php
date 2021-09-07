<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermissionStoreRequest;
use App\Models\Permission;
use App\Models\Role;
use http\Env\Request;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(RoleDataTable $datatable)
    {
        return $datatable->render('admin.rolesList');
    }
    public function assignPermissionsForm($roleId)
    {
        $permissions=Permission::all();
        $role=Role::where('id',$roleId)->first();
        $role_permissions=$role->permissions()->pluck('name')->toArray();
        return view('admin.assignPermissions')->with(['role'=>$role,'role_permissions'=>$role_permissions,'permissions'=>$permissions]);

    }
    public function assignPermissions(RolePermissionStoreRequest $request)
    {
        $data=$request->validated();

        $role=Role::where('id',$data['role_id'])->first();
        $permissions=$role->permissions()->pluck('name')->toArray();
        if(isset($permissions))     {$role->revokePermissionTo($permissions);}

        $role->givePermissionTo($data['permission'])?
        toastr()->success('Successfully! Permissions Has Assigned.'):
            toastr()->error('Sorry! Please try again later.');
        return redirect('admin/role_list');
//        return view('admin.assignPermissions')->with(['role'=>$role,'permissions'=>$permissions]);

    }

}
