<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function showBookings(Request $req)
    {
        $sessionUsername = $req->session()->get('username');
        if(in_array('booking', session('permissions', [])))
        {
            $bookings = DB::table('booking')
            ->join('customer as c', 'c.id', '=', 'booking.customer_id')
            ->join('projects as pr', 'pr.id', '=', 'booking.project_id')
            ->join('plots_inventory as pl', 'pl.id', '=', 'booking.plot_id')
            ->select('booking.id', 'c.cnic_number', 'pr.project_title','pl.plot_no', 'booking.unit_cost', 'booking.total_amount')
            ->where('username', $sessionUsername)
            ->get();
            return view('pages.bookings', ['bookingData' => $bookings]);
        }
        else
        {
            return redirect()->back();
        }
        
    }

    public function showBookingForm(Request $req, $id=null)
    {
        try
        {
            $bookingData = null;
            $isLockedMode = null;
            $customers = DB::table('customer')
                ->select('id', 'name', 'cnic_number')
                ->get();

            $projects = DB::table('projects')
                ->select('id', 'project_title')
                ->get();

            if($id)
            {
                $bookingData = DB::table('booking')
                ->join('customer as c', 'c.id', '=', 'booking.customer_id')
                ->join('projects as pr', 'pr.id', '=', 'booking.project_id')
                ->join('phase as ph', 'ph.id', '=', 'booking.phase_id')
                ->join('plots_inventory as pl', 'pl.id', '=', 'booking.plot_id')
                ->select(
                    'booking.*', 
                    'c.name', 'c.cnic_number', 'c.address', 'c.customer_image', 'c.mobile_number_1', // Alias to avoid column name collision
                    'ph.completion_date', 'ph.phase_title',
                    'pl.plot_no'
                )
                ->where('booking.id', $id)
                ->first();
                if($bookingData->isLocked == 1)
                {
                    $isLockedMode = true;
                }
            }

            return view('pages.add-booking', compact('customers','projects','bookingData','isLockedMode'));
        }
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getPlotsForBooking(Request $req)
    {   
        $project_id = $req->project_id;
        $phase_id = $req->phase_id;
        $bookedPlotIds = DB::table('booking')
                            // ->where('project_id', $project_id)
                            ->where('phase_id', $phase_id)
                            ->pluck('plot_id');
        $availablePlots = DB::table('plots_inventory')
                            // ->where('project_id', $project_id)
                            ->where('phase_id', $phase_id)
                            ->whereNotIn('id', $bookedPlotIds)
                            ->get(['id', 'plot_no']);

        return response()->json($availablePlots);
    }

    public function getPhasesForBooking(Request $req)
    {   
        $project_id = $req->project_id;
        $phases = DB::table('phase')
                    ->where('project_id', $project_id)
                    ->get(['id', 'phase_title', 'completion_date']);
        return response()->json($phases);
    }

    public function getBookingData(Request $req)
    {
        $bookingData = [
            'project_id' => $req->input('project_id'),
            'phase_id' => $req->input('phase_id'),
            'plot_id' => $req->input('plot_id'),
            'unit_cost' => $req->input('unit_cost'),
            'extra_charges' => $req->input('extra_charges'),
            'development_charges' => $req->input('development_charges'),
            'total_amount' => $req->input('total_amount'),
            'token_amount' => $req->input('token_amount'),
            'advance_amount' => $req->input('advance_amount'),
            'payment_plan' => $req->input('payment_plan'),
            'number_of_installments' => $req->input('num_of_installments'),
            'installment_amount' => $req->input('installment_amount'),
            'username' => session()->get('username'),
            'created_on' => now(),
        ];
        return $bookingData; 
    }

    public function getCustomerData(Request $req)
    {
        $customerData =[
            'name' => $req->input('customer_name'),
            'address' => $req->input('customer_address'),
            'mobile_number_1' => $req->input('mobile_no'),
            'cnic_number' => $req->input('customer_cnic'),
        ];
        if (!$req->input('id')) {
            $customerData['customer_image'] = 'default.jpg';
        }
        
        if ($req->hasFile('avatar')) {
            $avatar = $req->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $destinationPath = public_path('images/customer-images');
            $avatar->move($destinationPath, $avatarName);
            $customerData['customer_image'] = $avatarName;
        }

        return $customerData;
    }

    public function getInstallmentsData(Request $request, $bookingId, $customerId) {
        $installmentsData = [];
        $installmentIds = $request->input('installment_ids', []);
    
        $amounts = $request->input('amounts', []);
        $dueDates = $request->input('due_dates', []);
        $statuses = $request->input('statuses', []);
        $paymentModes = $request->input('payment_modes', []);
        $intimationDates = $request->input('intimation_dates', []);
    
        foreach ($installmentIds as $key => $installmentId) {
            // Initialize variables to avoid undefined index error
            $amount = $amounts[$key];
            $dueDate = $dueDates[$key];
            $status = $statuses[$key]; // Default to 'pending' if not set
            $paymentMode = $paymentModes[$key]; // Default to 'cash' if not set
            $intimationDate = $intimationDates[$key];
    
            if (!empty($installmentId)) {
                // Update existing installment
                DB::table('installment')
                    ->where('id', $installmentId)
                    ->update([
                        'amount' => $amount,
                        'due_date' => $dueDate,
                        'installment_status' => $status,
                        'payment_mode' => $paymentMode,
                        'intimation_date' => $intimationDate,
                        'updated_at' => now(),
                    ]);
            } else {
                // Prepare data for new installment
                $installmentsData[] = [
                    'booking_id' => $bookingId,
                    'project_id' => $request->input('project_id'),
                    'phase_id' => $request->input('phase_id'),
                    'plot_id' => $request->input('plot_id'),
                    'customer_id' => $customerId,
                    'amount' => $amount,
                    'due_date' => $dueDate,
                    'installment_status' => $status,
                    'payment_mode' => $paymentMode,
                    'intimation_date' => $intimationDate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
    
        // Insert any new installments
        if (!empty($installmentsData)) {
            DB::table('installment')->insert($installmentsData);
        }
    }
    
    


    public function getInstallments($bookingId) {
        $installments = DB::table('installment')
            ->where('booking_id', $bookingId)
            ->orderBy('due_date', 'asc')
            ->get();
    
        return response()->json([
            'success' => true,
            'data' => $installments,
        ]);
    }
    

    public function addBooking(Request $req)
    {
        $customerData =$this->getCustomerData($req);
        $bookingData = $this->getBookingData($req);
        DB::beginTransaction();
        try
        {
            if(DB::table('booking')->where('plot_id', $bookingData['plot_id'])->first())
            {
                return response()->json(['error' => 'Plot already booked']);
            }
            else
            {
                $customerId = DB::table('customer')->insertGetId($customerData);
                $bookingData['customer_id'] = $customerId;
                $bookingId = DB::table('booking')->insertGetId($bookingData);
                $installmentsData = $this->getInstallmentsData($req, $bookingId, $customerId);
                DB::commit();
                return response()->json(['success' => 'booking added successfully']);
            }
            
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }    
    }

    

    public function updateBooking(Request $req)
    {   
        $bookingData = $this->getBookingData($req);
        $customerData =$this->getCustomerData($req);

        $id = $req->input('id');
        $customerId = $req->input('customer_id');

        DB::beginTransaction();
        try {
            DB::table('customer')->where('id', $customerId)->update($customerData);
            DB::table('booking')->where('id', $id)->update($bookingData);
            $this->getInstallmentsData($req, $id, $customerId);
            DB::commit();
            return response()->json(['success' => 'Booking updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
