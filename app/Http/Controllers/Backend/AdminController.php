<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
}
