<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RoomNumber;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomListController extends Controller
{
    //

    public function viewRoomList()
    {
        $room_number_list = RoomNumber::with(['room_type', 'last_booking.booking:id,check_in,check_out,status,code,name,phone'])->orderBy('room_type_id', 'asc')
            ->leftJoin('room_types', 'room_types.id', 'room_numbers.room_type_id')
            ->leftJoin('booking_room_lists', 'booking_room_lists.room_number_id', 'room_numbers.id')
            ->leftJoin('bookings', 'bookings.id', 'booking_room_lists.booking_id')
            ->select(
                'room_numbers.*',
                'room_numbers.id as id',
                'room_types.name',
                'bookings.id as booking_id',
                'bookings.check_in',
                'bookings.check_out',
                'bookings.name as customer_name',
                'bookings.phone as customer_phone',
                'bookings.status as booking_stauts',
                'bookings.code as booking_no'
            )
            ->orderBy('room_types.id', 'asc')
            ->orderBy('bookings.id', 'desc')
            ->get();


        return view('backend.allroom.roomlist.view-room-list', compact('room_number_list'));
    }

    // add room list

    public function addRoomList()
    {
        $roomtype = RoomType::all();
        return view('backend.allroom.roomlist.add-room-list', compact('roomtype'));
    }
}
