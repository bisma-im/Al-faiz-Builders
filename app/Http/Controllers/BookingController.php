<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function showBookingForm(Request $req)
    {
        try
        {
            $bookingData = null;
            $customers = DB::table('customer')
                ->select('id', 'name', 'cnic_number')
                ->get();

            $projects = DB::table('projects')
                ->select('id', 'project_title')
                ->get();

            return view('pages.add-booking', compact('customers','projects','bookingData'));
        }
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
