<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use PHPUnit\Framework\Constraint\Count;

class RoomController extends Controller
{
    //
    public function editRoom($id)
    {
        $editData = Room::findOrFail($id);
        $basic_facility = Facility::where('rooms_id', $id)->get();

        return view('backend.allroom.room.edit_room', compact('editData', 'basic_facility'));
    }

    public function updateRoom(Request $request, $id)
    {
        // dd($request->all());

        $room = Room::findOrFail($id);
        $room->room_type_id = $room->room_type_id;
        $room->total_adult = $request->total_adult;
        $room->total_child = $request->total_child;
        $room->room_capacity = $request->room_capacity;
        $room->price = $request->room_price;
        $room->size = $request->size;
        $room->view = $request->view;
        $room->bed_style = $request->bed_style;
        $room->discount = $request->room_discount;
        $room->short_desc = $request->shot_desc;
        $room->long_desc = $request->long_desc;
        // Update Image
        if ($request->file('image')) {
            $image = new ImageManager(new Driver());
            $nam_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            $img = $image->read($request->file('image'));
            $directory = 'upload/rooming/';
            $img = $img->resize(550, 850);
            $img->toJpeg(100)->save(public_path($directory . $nam_gen));
            $room->image =  $nam_gen;
        }

        $room->save();

        if ($request->basic_facility_name == NULL) {
            $notification = array(
                'message' => 'Sorry! Not Any Basic Facility Select',
                'alert-type' => 'success'

            );
            return redirect()->back()->with($notification);
        } else {
            Facility::where('rooms_id', $id)->delete();
            $facility = Count($request->basic_facility_name);
            for ($i = 0; $i < $facility; $i++) {
                $fcount = new Facility();
                $fcount->rooms_id = $room->id;
                $fcount->facility_name = $request->basic_facility_name[$i];
                $fcount->save();
            }
        }

        // Update Multi Image 
        if ($room->save()) {
            $files = $request->multi_img;
            if (!empty($files)) {
                $subimage = MultiImage::where('rooms_id', $id)->get()->toArray();
                MultiImage::where('rooms_id', $id)->delete();
            }
            if (!empty($files)) {
                foreach ($files as $file) {
                    $imgName = date('YmdHi') . $file->getClientOriginalName();
                    $file->move('upload/rooming/multi_img', $imgName);
                    $subimage = new MultiImage();
                    $subimage->rooms_id = $room->id;
                    $subimage->multi_img = $imgName;
                    $subimage->save();
                }
            }
        }

        $notification = array(
            'message' => 'Room updated Successfully!!',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
    }
}
