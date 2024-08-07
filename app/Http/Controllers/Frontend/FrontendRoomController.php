<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use App\Models\RoomBookedDate;
use App\Models\RoomNumber;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        $otherRoom = Room::where('id', '!=', $id)->limit(2)->orderBy('id', 'DESC')->get();
        return view('frontend.room.room_details', compact('roomDetails', 'multi_img', 'facility', 'otherRoom'));
    }

    // Data room Search

    public function BookingSearch(Request $request)
    {
        $request->flash();

        if ($request->check_in == $request->check_out) {

            $notification = array(

                'message' => 'Something want to wrong ',
                'alert-type' => 'error'

            );

            return redirect()->back()->with($notification);
        }

        $sdate = date('Y-m-d', strtotime($request->check_in));
        $edate = date('Y-m-d', strtotime($request->check_out));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $alldate);

        $dt_array = [];
        foreach ($d_period as $period) {
            array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $dt_array)->distinct()->pluck('booking_id')->toArray();

        $rooms = Room::withCount('room_num')->where('status', 1)->get();
        // dd($rooms);

        return view('frontend.room.search_room', compact('rooms', 'check_date_booking_ids'));
    }

    // search room details

    public function searchRoomDetails(Request $request, $id)
    {
        $request->flash();
        $roomDetails = Room::findOrFail($id);
        $multi_img = MultiImage::where('rooms_id', $id)->get();
        $facility = Facility::where('rooms_id', $id)->get();
        $otherRoom = Room::where('id', '!=', $id)->limit(2)->orderBy('id', 'DESC')->get();
        $room_id = $id;
        return view('frontend.room.search_roo_details', compact('roomDetails', 'multi_img', 'facility', 'otherRoom', 'room_id'));
    }




    public function CheckRoomAvailability(Request $request)
    {
        $sdate = date('Y-m-d', strtotime($request->check_in));
        $edate = date('Y-m-d', strtotime($request->check_out));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $alldate);
        $dt_array = [];
        foreach ($d_period as $period) {
            array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $dt_array)->distinct()->pluck('booking_id')->toArray();

        $room = Room::withCount('room_num')->find($request->room_id);

        $bookings = Booking::withCount('assing_rooms')->whereIn('id', $check_date_booking_ids)->where('rooms_id', $room->id)->get()->toArray();

        $total_book_room = array_sum(array_column($bookings, 'assing_rooms_count'));

        $av_room = @$room->room_num_count - $total_book_room;

        $toDate = Carbon::parse($request->check_in);
        $fromDate = Carbon::parse($request->check_out);
        $nights = $toDate->diffInDays($fromDate);

        return response()->json(['available_room' => $av_room, 'total_nights' => $nights]);
    }
}
