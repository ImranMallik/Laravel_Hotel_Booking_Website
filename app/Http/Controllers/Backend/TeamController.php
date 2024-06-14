<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TeamController extends Controller
{
    //
    public function AllTeam()
    {
        // dd('hello');
        $team = Team::latest()->get();
        return view('backend.Team.all_team', compact('team'));
    }

    public function AddTeam()
    {
        return view('backend.Team.add_team');
    }

    public function StoreTeam(Request $request)
    {
        // dd($request->all());
        if ($request->file('image')) {
            $image = new ImageManager(new Driver());
            $nam_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            $img = $image->read($request->file('image'));
            $directory = 'upload/team/';
            $img = $img->resize(550, 670);
            $img->toJpeg(100)->save(public_path($directory . $nam_gen));
            $save_url = $directory . $nam_gen;
        }

        Team::insert([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(

            'message' => 'Team Data Inserted Successfully ',
            'alert-type' => 'success'

        );

        return redirect()->route('all.team')->with($notification);
    }

    public function editTeam($id)
    {
        $team = Team::findOrFail($id);
        return view('backend.Team.edit_team', compact('team'));
    }

    public function updateTeam(Request $request)
    {
        $team_id = $request->id;

        if ($request->file('image')) {
            if ($request->file('image')) {
                $image = new ImageManager(new Driver());
                $nam_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
                $img = $image->read($request->file('image'));
                $directory = 'upload/team/';
                $img = $img->resize(550, 670);
                $img->toJpeg(100)->save(public_path($directory . $nam_gen));
                $save_url = $directory . $nam_gen;
            }

            Team::findOrFail($team_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(

                'message' => 'Team Updated With Image Successfully ',
                'alert-type' => 'success'

            );

            return redirect()->route('all.team')->with($notification);
        } else {
            Team::findOrFail($team_id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(

                'message' => 'Team Updated With Out Image Successfully ',
                'alert-type' => 'success'

            );

            return redirect()->route('all.team')->with($notification);
        }
    }

    // delete

    public function deleteTeam($id)
    {
        $delete_id = Team::findOrFail($id);
        $img = $delete_id->image;
        unlink($img);
        Team::findOrFail($id)->delete();


        $notification = array(

            'message' => 'Team Deleted Successfully !!',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    }
}
