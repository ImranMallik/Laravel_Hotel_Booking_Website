<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class RoleController extends Controller
{
    //
    public function AllPermission()
    {
        $permission = Permission::latest()->get();
        return view('backend.pages.permission.all_permission', compact('permission'));
    }


    public function AddPermission()
    {

        return view('backend.pages.permission.add_permission');
    }

    public function StorePermission(Request $request)
    {

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id)
    {

        $permission = Permission::find($id);
        return view('backend.pages.permission.edit_premission', compact('permission'));
    }


    public function UpdatePermission(Request $request)
    {
        $per_id = $request->id;

        Permission::find($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id)
    {

        Permission::find($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function ImportPermission()
    {

        return view('backend.pages.permission.import_permission');
    }

    public function Export()
    {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }


    public function Import(Request $request)
    {
        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = array(
            'message' => 'Permission Imported Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function Allrole()
    {
        $roles = Role::latest()->get();
        return view('backend.pages.roles.all_roles', compact('roles'));
    }


    public function AddRoles()
    {
        return view('backend.pages.roles.add_roles');
    }

    public function StoreRoles(Request $request)
    {
        Role::create([
            'name' => $request->name
        ]);

        $notification = array(
            'message' => 'Role Created Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.role')->with($notification);
    }


    public function EditRoles($id)
    {
        $roles = Role::findOrFail($id);
        return view('backend.pages.roles.edit_roles', compact('roles'));
    }


    public function UpdateRoles(Request $request)
    {

        $role_id = $request->id;

        Role::find($role_id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.role')->with($notification);
    }

    public function DeleteRoles($id)
    {

        Role::find($id)->delete();

        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function addRolePermission()
    {
        $roles = Role::all();
        $permission_goup = User::getpermissionGroups();
        $permission = Permission::all();



        return view('backend.pages.rolesetup.add_role_permission', compact('roles', 'permission', 'permission_goup'));
    }

    public function rolePermissionStore(Request $request)
    {
        // dd($request->all());
        $data = array();
        $permission = $request->permission;

        foreach ($permission as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            // Check if this role-permission combination already exists
            $exists = DB::table('role_has_permissions')
                ->where('role_id', $request->role_id)
                ->where('permission_id', $item)
                ->exists();

            // Only insert if it doesn't already exist
            if (!$exists) {
                DB::table('role_has_permissions')->insert($data);
            }
        } // end foreach

        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }


    public function allrolesPermission()
    {
        $roles = Role::all();

        return view('backend.pages.rolesetup.all_role_permission', compact('roles'));
    }

    public function AdminEditRoles($id)
    {
        $role = Role::findOrFail($id);
        $permission_goup = User::getpermissionGroups();
        $permissions = Permission::all();


        return view('backend.pages.rolesetup.edit_role_permission', compact('role', 'permissions', 'permission_goup'));
    }


    public function AdminRolesUpdate(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissionIds = $request->permission;

        if (!empty($permissionIds)) {
            // Convert permission IDs to names
            $permissions = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();
            $role->syncPermissions($permissions);
        }

        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function AdminDeleteRoles($id)
    {
        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }


        $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
