<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //

    public function bookingReport()
    {
        return view('backend.report.booking_report');
    }


    public function SearchByDate(Request $request)
    {

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $bookings = Booking::where('check_in', '>=', $startDate)->where('check_out', '<=', $endDate)->get();

        return view('backend.report.booking_search_date', compact('startDate', 'endDate', 'bookings'));
    }
}
