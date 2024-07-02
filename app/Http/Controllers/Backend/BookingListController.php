<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingRoomList;
use App\Models\RoomBookedDate;
use App\Models\RoomNumber;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookingListController extends Controller
{
    //

    public function bookingList()
    {
        $bookingRoom = Booking::orderBy('id', 'desc')->get();
        return view('backend.booking.booking-list', compact('bookingRoom'));
    }

    public function editBookingList($id)
    {
        $editData = Booking::with('room')->findOrFail($id);
        return view('backend.booking.edit-booklist', compact('editData'));
    }

    public function updateBookingStatus(Request $request, $id)
    {
        // dd($request->all());
        $booking = Booking::findOrFail($id);
        $booking->payment_status = $request->payment_status;
        $booking->status = $request->status;
        $booking->save();

        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function UpdateBooking(Request $request, $id)
    {
        // if ($request->available_room < $request->number_of_rooms) {

        //     $notification = array(
        //         'message' => 'Something Want To Wrong!',
        //         'alert-type' => 'error'
        //     );
        //     return redirect()->back()->with($notification);
        // }

        $data = Booking::find($id);
        $data->number_of_rooms = $request->number_of_rooms;
        $data->check_in = date('Y-m-d', strtotime($request->check_in));
        $data->check_out = date('Y-m-d', strtotime($request->check_out));
        $data->save();

        RoomBookedDate::where('booking_id', $id)->delete();

        $sdate = date('Y-m-d', strtotime($request->check_in));
        $edate = date('Y-m-d', strtotime($request->check_out));
        $eldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $eldate);
        foreach ($d_period as $period) {
            $booked_dates = new RoomBookedDate();
            $booked_dates->booking_id = $data->id;
            $booked_dates->room_id = $data->rooms_id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }

        $notification = array(
            'message' => 'Booking Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // Assign Room
    public function assignRoom($booking_id)
    {
        $booking = Booking::find($booking_id);

        $booking_date_array = RoomBookedDate::where('booking_id', $booking_id)->pluck('book_date')->toArray();

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $booking_date_array)->where('room_id', $booking->rooms_id)->distinct()->pluck('booking_id')->toArray();

        $booking_ids = Booking::whereIn('id', $check_date_booking_ids)->pluck('id')->toArray();

        $assign_room_ids = BookingRoomList::whereIn('booking_id', $booking_ids)->pluck('room_number_id')->toArray();

        $room_numbers = RoomNumber::where('room_id', $booking->rooms_id)->whereNotIn('id', $assign_room_ids)->where('status', 'Active')->get();

        return view('backend.booking.assing-room', compact('booking', 'room_numbers'));
    }
}
