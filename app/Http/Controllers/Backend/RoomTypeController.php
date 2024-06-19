<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    //
    public function roomlypelist()
    {
        $alldata = RoomType::orderBy('id', 'desc')->get();
        return view('backend.allroom.roomtype.view_roomtype', compact('alldata'));
    }

    // 
    public function AddRoomType()
    {
        return view('backend.allroom.roomtype.add_roomtype');
    }
    //
    public function RoomTypeStore(Request $request)
    {
        $roomtype_id =  RoomType::insertGetId([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        Room::insert([
            'room_type_id' => $roomtype_id,
        ]);


        $notification = array(

            'message' => 'RoomType Successfully ',
            'alert-type' => 'success'

        );

        return redirect()->route('room.type-list')->with($notification);
    }
}
