<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use App\Models\RoomNumber;
use App\Models\RoomType;
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
        $multiImg = MultiImage::where('rooms_id', $id)->get();
        $allrooms = RoomNumber::where('room_id', $id)->get();
        return view('backend.allroom.room.edit_room', compact('editData', 'basic_facility', 'multiImg', 'allrooms'));
    }

    // Delete Room 

    public function deleteRoom(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        if (file_exists('upload/rooming/' . $room->image) and !empty($room->image)) {

            @unlink('upload/rooming/' . $room->image);
        }

        $subimage = MultiImage::where('rooms_id', $room->id)->get()->toArray();
        if (!empty($subimage)) {
            foreach ($subimage as $value) {
                if (!empty($value)) {
                    @unlink('upload/rooming/multi_img/' . $value['multi_img']);
                }
            }
        }

        RoomType::where('id', $room->room_type_id)->delete();
        MultiImage::where('rooms_id', $room->id)->delete();
        Facility::where('rooms_id', $room->id)->delete();
        RoomNumber::where('room_id', $room->id)->delete();
        $room->delete();

        $notification = array(
            'message' => 'Room Deleted Successfully!!',
            'alert-type' => 'success'

        );

        return redirect()->back()->with($notification);
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

        return redirect()->route('room.type-list')->with($notification);
    }

    // multi imgage Delete using Icon

    public function multiImgDelet($id)
    {

        $deleteImg = MultiImage::where('id', $id)->first();

        if ($deleteImg) {
            // Construct the full path to the image file
            $imagePath = public_path('upload/rooming/multi_img/' . $deleteImg->multi_img);

            // Debugging line to check the constructed path (optional)
            // dd($imagePath);

            // Check if the file exists before attempting to delete it
            if (file_exists($imagePath)) {
                unlink($imagePath);
            } else {
                echo "Image does not exist";
            }

            // Delete the image record from the database
            MultiImage::where('id', $id)->delete();
        }

        $notification = array(
            'message' => 'Multi Image Deleted Successfully!!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // Add Room Number

    public function addRoomNumber(Request $request, $id)
    {
        // dd($request->all());
        $roomNum = new RoomNumber();
        $roomNum->room_id = $id;
        $roomNum->room_type_id = $request->room_type_id;
        $roomNum->room_no = $request->room_no;
        $roomNum->status = $request->status;
        $roomNum->save();

        $notification = array(
            'message' => 'Room Number Added Successfully!!',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type-list')->with($notification);
    }
    // Edit Room Number

    public function editRoomId($id)
    {
        $room_num = RoomNumber::findOrFail($id);

        return view('backend.allroom.room.edit_room_num', compact('room_num'));
    }

    public function updateRoomNumber(Request $request, $id)
    {
        $data = RoomNumber::findOrFail($id);
        $data->room_no = $request->room_num;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'Room Number Update Successfully!!',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type-list')->with($notification);
    }

    public function deleteRoomNumber($id)
    {
        // dd($id) 
        RoomNumber::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Room Number Deleted Successfully!!',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type-list')->with($notification);
    }
}
