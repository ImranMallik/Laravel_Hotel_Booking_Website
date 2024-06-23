<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use Illuminate\Http\Request;

class FrontendRoomController extends Controller
{
    //

    public function AllFrontendRoom()
    {
        $rooms = Room::latest()->get();

        return view('frontend.room.all_rooms', compact('rooms'));
    }

    public function AllRoomDtails($id)
    {
        $roomDetails = Room::findOrFail($id);
        $multi_img = MultiImage::where('rooms_id', $id)->get();
        $facility = Facility::where('rooms_id', $id)->get();
        return view('frontend.room.room_details', compact('roomDetails', 'multi_img', 'facility'));
    }
}
