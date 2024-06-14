<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function index()
    {
        return view('frontend.index');
    }


    // user profile

    public function userProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('frontend.dashboard.edit_profile', compact('profileData'));
    }

    // profile data update

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
            'message' => 'Uer Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // logout

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Uer logout Successfully',
            'alert-type' => 'warning'
        );

        return redirect('/')->with($notification);
    }

    // Edit PassWord

    public function editPass()
    {
        return view('frontend.dashboard.edit_pass');
    }

    // Store Pass

    public function storePass(Request $request)
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
