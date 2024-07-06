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
use Stripe;
use Stripe\Stripe as StripeStripe;

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

        $validateData = $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'persion' => 'required',
            'number_of_rooms' => 'required',

        ]);

        if ($request->available_room < $request->number_of_rooms) {

            $notification = array(
                'message' => 'Something want to wrong!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        Session::forget('book_date');

        $data = array();
        $data['number_of_rooms'] = $request->number_of_rooms;
        $data['persion'] = $request->persion;
        $data['available_room'] = $request->available_room;
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
        // dd(env('STRIPE_SECRET'));
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
        $subTotal = $room->price * $total_nights * $book_data['number_of_rooms'];
        // dd($subTotal);
        $discount = ($room->discount / 100) * $subTotal;
        $total_price  = $subTotal - $discount;
        $code = rand(000000000, 999999999);
        // print_r($code);
        // die;

        if ($request->payment_method == 'Stripe') {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $s_pay = \Stripe\Charge::create([
                "amount" => $total_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment For Booking. Booking No " . $code
            ]);
            if ($s_pay['status'] == 'succeeded') {
                $payment_status = 1;
                $transation_id = $s_pay->id;
            } else {
                $notification = array(

                    'message' => 'Sorry Payment Field ',
                    'alert-type' => 'error'

                );

                return redirect('/')->with($notification);
            }
        } else {
            $payment_status = 0;
            $transation_id = '';
        }


        $bookData = new Booking();
        $bookData->rooms_id = $room->id;
        $bookData->user_id = Auth::user()->id;
        $bookData->check_in = date('Y-m-d', strtotime($book_data['check_in']));
        $bookData->check_out = date('Y-m-d', strtotime($book_data['check_out']));
        $bookData->person = $book_data['persion'];
        $bookData->number_of_rooms = $book_data['number_of_rooms'];
        $bookData->total_night = $total_nights;
        $bookData->actual_price = $room->price;
        $bookData->subtotal = $subTotal;
        $bookData->discount = $discount;
        $bookData->total_price = $total_price;
        $bookData->payment_method = $request->payment_method;
        if ($request->payment_method == 'Stripe') {
            $bookData->transation_id = $s_pay->id;
            $bookData->payment_status = 1;
            $bookData->status = 1;
        } else {
            $bookData->transation_id = '';
            $bookData->payment_status = 0;
            $bookData->status = 0;
        }
        $bookData->name = $request->name;
        $bookData->email = $request->email;
        $bookData->phone = $request->phone;
        $bookData->country = $request->country;
        $bookData->state = $request->state;
        $bookData->zip_code = $request->zip_code;
        $bookData->address = $request->address;
        $bookData->code = $code;
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
