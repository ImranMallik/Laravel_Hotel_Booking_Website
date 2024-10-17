<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
// use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    public function adminDashboard()
    {
        return view('admin.index');
    }
    // Log out 
    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    // Login Control

    public function index()
    {
        return view('admin.admin_login');
    }

    // Admin Profile

    public function profile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile', compact('profileData'));
    }

    // 

    public function profileStore(Request $request)
    {
        // dd($request->all());
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->has('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $fileName);
            $data['photo'] = $fileName;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function changePassword(Request $request)
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_password_change', compact('profileData'));
    }

    // password Update

    public function updatePassword(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(

                'message' => 'Old Password Dose not Match!',
                'alert-type' => 'error'

            );

            return back()->with($notification);
        }

        // Update New Password

        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(

            'message' => 'Password Change Successfully ',
            'alert-type' => 'success'

        );

        return back()->with($notification);
    }


    // Admin User All Method ------------
    public function allAdmin()
    {
        $alladmin = User::where('role', 'admin')->get();

        return view('backend.pages.admin.all_admin', compact('alladmin'));
    }

    public function addAdmin()
    {
        $roles = Role::all();

        return view('backend.pages.admin.add_admin', compact('roles'));
    }

    public function storeAdmin(Request $request)
    {
        // dd($request->all());
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        // if ($request->roles) {
        //     $user->assignRole($request->roles);
        // }

        if ($request->roles) {
            $roles = is_array($request->roles) ? $request->roles : [$request->roles];

            $roleNames = Role::whereIn('id', $roles)->pluck('name')->toArray();

            $user->assignRole($roleNames);
        }

        $notification = array(
            'message' => 'Admin User Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    }

    public function editAdmin($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.pages.admin.edit_admin', compact('user', 'roles'));
    }

    public function updateAdmin(Request $request, $id)
    {
        // dd($request->all());
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();
        // $user->roles()->detach();
        // if ($request->roles) {
        //     $user->assignRole($request->roles);
        // }

        $user->roles()->detach();

        // Check if roles are provided and valid
        if ($request->roles && is_array($request->roles) && count($request->roles) > 0) {
            // Fetch valid role names by ID
            $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();

            // Assign roles only if we have valid role names
            if (!empty($roleNames)) {
                $user->assignRole($roleNames);
            }
        }
        $notification = array(
            'message' => 'Admin User Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.admin')->with($notification);
    }

    public function DeleteAdmin($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }
        $notification = array(
            'message' => 'Admin User Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method 
}
