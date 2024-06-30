<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomBookedDate;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    //

    public function checkout()
    {
        if (Session::has('book_data')) {
            $book_data = Session::get('book_data');
            $room = Room::findOrFail($book_data['room_id']);

            $toDate = Carbon::parse($book_data['check_in']);
            $formData = Carbon::parse($book_data['check_out']);
            $nights = $toDate->diffInDays($formData);
            return view('frontend.checkout.checkout', compact('book_data', 'room', 'nights'));
        } else {
            $notification = array(

                'message' => 'Something want to wrong ',
                'alert-type' => 'error'

            );

            return redirect('/')->with($notification);
        }
    }
    public function BookingStore(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'check_in' => 'required|date',
        //     'check_out' => 'required|date',
        //     'persion' => 'required|integer',
        //     'num_of_room' => 'required|integer'
        // ]);

        // session()->flush();

        $data = array();
        $data['num_of_room'] = $request->num_of_room;
        $data['persion'] = $request->persion;
        $data['num_of_available'] = $request->num_of_ava;
        $data['check_in'] = date('Y-m-d', strtotime($request->check_in));
        $data['check_out'] = date('Y-m-d', strtotime($request->check_out)); // Corrected line
        $data['room_id'] = $request->room_id;

        Session::put('book_data', $data);
        // Log::info('Redirecting to checkout');
        // Log::info(route('checkout')); // Log the generated URL
        return redirect()->route('checkout');
    }

    // CheckOut Store

    public function checkoutStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'country' => 'required',
            'name' => 'required',
            'address' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'payment_method' => 'required'
        ]);

        $book_data = Session::get('book_data');

        $toDate = Carbon::parse($book_data['check_in']);
        $formData = Carbon::parse($book_data['check_out']);
        $total_nights = $toDate->diffInDays($formData);
        $room = Room::findOrFail($book_data['room_id']);
        $subTotal = $room->price * $total_nights * $book_data['num_of_room'];
        // dd($subTotal);
        $discount = ($room->discount / 100) * $subTotal;
        $total_price  = $subTotal - $discount;
        $code = rand(000000000, 999999999);
        // print_r($code);
        // die;

        $bookData = new Booking();
        $bookData->rooms_id = $room->id;
        $bookData->user_id = Auth::user()->id;
        $bookData->check_in = date('Y-m-d', strtotime($book_data['check_in']));
        $bookData->check_out = date('Y-m-d', strtotime($book_data['check_out']));
        $bookData->person = $book_data['persion'];
        $bookData->number_of_rooms = $book_data['num_of_room'];
        $bookData->total_night = $total_nights;
        $bookData->actual_price = $room->price;
        $bookData->subtotal = $subTotal;
        $bookData->discount = $discount;
        $bookData->total_price = $total_price;
        $bookData->payment_method = $request->payment_method;
        $bookData->transation_id = '';
        $bookData->payment_status = 0;
        $bookData->name = $request->name;
        $bookData->email = $request->email;
        $bookData->phone = $request->phone;
        $bookData->country = $request->country;
        $bookData->state = $request->state;
        $bookData->zip_code = $request->zip_code;
        $bookData->address = $request->address;
        $bookData->code = $code;
        $bookData->status = 0;
        $bookData->created_at = Carbon::now();
        $bookData->save();

        $sdate = date('Y-m-d', strtotime($book_data['check_in']));
        $edate = date('Y-m-d', strtotime($book_data['check_out']));
        $eldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $eldate);
        foreach ($d_period as $period) {
            $booked_dates = new RoomBookedDate();
            $booked_dates->booking_id = $bookData->id;
            $booked_dates->room_id = $bookData->id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }

        Session::forget('book_data');

        $notification = array(
            'message' => 'Booking Added Successfully ',
            'alert-type' => 'success'
        );

        return redirect('/')->with($notification);
    }
}
