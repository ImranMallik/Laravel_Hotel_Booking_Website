<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SettingController extends Controller
{
    //

    public function mailSetting()
    {
        $smtp = SmtpSetting::find(1);
        return view('backend.setting.smtp_setting', compact('smtp'));
    }

    public function mailSettingUpdate(Request $request)
    {
        $smtp_id = $request->id;

        SmtpSetting::find($smtp_id)->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
        ]);

        $notification = array(
            'message' => 'Smtp Setting Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function SiteSetting()
    {

        $site = SiteSetting::find(1);
        return view('backend.site.site_setting_update', compact('site'));
    }

    public function SiteUpdate(Request $request)
    {
        // dd($request->all());
        $site_id = $request->id;

        if ($request->file('logo')) {
            if ($request->file('logo')) {
                $image = new ImageManager(new Driver());
                $nam_gen = hexdec(uniqid()) . '.' . $request->file('logo')->getClientOriginalExtension();
                $img = $image->read($request->file('logo'));
                $directory = 'upload/site/';
                $img = $img->resize(110, 44);
                $img->toJpeg(100)->save(public_path($directory . $nam_gen));
                $save_url = $directory . $nam_gen;
            }

            SiteSetting::findOrFail($site_id)->update([
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
                'logo' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(

                'message' => 'Site Setting Updated With Image Successfully ',
                'alert-type' => 'success'

            );

            return redirect()->back()->with($notification);
        } else {
            SiteSetting::findOrFail($site_id)->update([
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(

                'message' => 'Site Setting Updated Successfully',
                'alert-type' => 'success'

            );

            return redirect()->back()->with($notification);
        }
    }
}
