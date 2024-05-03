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
            $projects = DB::table('projects')
                ->select('id', 'project_title')
                ->get();

            $phases = DB::table('phase')
                ->select('id', 'project_id', 'phase_title')
                ->get();

            if($req->ajax()){
                $selectedProjectId = $req->input('selectedProject');
                $selectedPhaseId = $req->input('selectedPhase');
                $selectedStatus = $req->input('selectedStatus');

                // dd($selectedProjectId, $selectedPhaseId, $selectedStatus);
            }
            else {
                $selectedProjectId = $projects->first()->id;
                $selectedPhaseId = $phases->where('project_id', $selectedProjectId)->first()->id;
                $selectedStatus = 'active';
            }
            

            $bookingData = DB::table('booking')
            ->join('customer as c', 'c.id', '=', 'booking.customer_id')
            ->join('projects as pr', 'pr.id', '=', 'booking.project_id')
            ->join('plots_inventory as pl', 'pl.id', '=', 'booking.plot_id')
            ->join('installment as i', 'booking.id', '=', 'i.booking_id')
            ->select('booking.id', 'c.name', 'c.mobile_number_1', 'pr.project_title','pl.plot_no', 'booking.total_amount',
                    DB::raw('SUM(CASE WHEN i.installment_status = \'paid\' THEN i.amount ELSE 0 END) as received_amount'),
                    DB::raw('SUM(CASE WHEN i.installment_status = \'pending\' THEN i.amount ELSE 0 END) as pending_amount'))
            ->where('booking.username', $sessionUsername)
            ->where('booking.status', $selectedStatus)
            ->where('booking.project_id', $selectedProjectId)
            ->where('booking.phase_id', $selectedPhaseId)
            ->groupby('booking.id', 'c.name', 'c.mobile_number_1', 'pr.project_title','pl.plot_no', 'booking.total_amount')
            ->get();

            if($req->ajax()) {
                return view('partials.booking_row', compact('bookingData', 'projects', 'phases', 'selectedProjectId', 'selectedPhaseId', 'selectedStatus'))->render();
            } else {
                return view('pages.bookings', compact('bookingData', 'projects', 'phases', 'selectedProjectId', 'selectedPhaseId', 'selectedStatus'));
            }
            // return view('pages.bookings', compact('bookingData', 'projects', 'phases', 'selectedProjectId', 'selectedPhaseId', 'selectedStatus'));
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
            $isLockedMode = $isCancelled = null;
            $customers = DB::table('customer')
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
                    'c.name', 'c.cnic_number','c.address','c.customer_image','c.mobile_number_1',
                    'c.next_of_kin_name', 'c.next_of_kin_relation', 'c.next_of_kin_cnic', 'c.next_of_kin_address', 'c.next_of_kin_mobile_number_1',
                    'ph.completion_date', 'ph.phase_title',
                    'pr.project_title',
                    'pl.plot_no'
                )
                ->where('booking.id', $id)
                ->first();
                if($bookingData->isLocked === 1)
                {
                    $isLockedMode = true;
                }
                if($bookingData->status === 'cancelled')
                {
                    $isCancelled = true;
                }
            }

            return view('pages.add-booking', compact('customers','projects','bookingData','isLockedMode' , 'isCancelled'));
        }
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCustomer($customerId)
    {
        try
        {
            $customer = DB::table('customer')
            ->select('id', 'name', 'cnic_number','address','customer_image','mobile_number_1',
            'next_of_kin_name', 'next_of_kin_relation', 'next_of_kin_cnic', 'next_of_kin_address', 'next_of_kin_mobile_number_1')
            ->where('id',$customerId)
            ->get();

            return response()->json(['success' => true,'data' => $customer,], 200);
        } catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getPlotsForBooking(Request $req)
    {   
        $project_id = $req->project_id;
        $phase_id = $req->phase_id;
        $availablePlots = DB::table('plots_inventory')
                            // ->where('project_id', $project_id)
                            ->where('phase_id', $phase_id)
                            ->where('isBooked', 'n')
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
            'discount_type' => $req->input('discount_type'),
            'discount_amount' => $req->input('discount_amount'),
            'discount_percentage' => $req->input('discount_percentage'),
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
            'next_of_kin_name' => $req->input('nok_name'),
            'next_of_kin_relation' => $req->input('nok_relation'),
            'next_of_kin_cnic' => $req->input('nok_cnic'),
            'next_of_kin_address' => $req->input('nok_address'),
            'next_of_kin_mobile_number_1' => $req->input('nok_mobile_no'),
        ];
        
        if ($req->hasFile('avatar')) {
            $avatar = $req->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $destinationPath = public_path('images/customer-images');
            $avatar->move($destinationPath, $avatarName);
            $customerData['customer_image'] = $avatarName;
        } else if ($req->input('existing_customer_image') != 'default.svg' && !$req->hasFile('avatar')) {
            $customerData['customer_image'] = $req->input('existing_customer_image');
        } else {
            if (!$req->input('customer_id_dropdown')) {
                $customerData['customer_image'] = 'default.svg';
            }
        }

        if ($req->hasFile('cnic_image')) {
            $cnicImage = $req->file('cnic_image');
            $cnicImageName = time() . '.' . $cnicImage->getClientOriginalExtension();
            $destinationPath = public_path('images/customer/customer-cnic');
            $cnicImage->move($destinationPath, $cnicImageName);
            $customerData['customer_cnic_image'] = $cnicImageName;
        } else if ($req->input('existing_cnic_image') != 'default.svg' && !$req->hasFile('cnic_image')) {
            $customerData['customer_cnic_image'] = $req->input('existing_cnic_image');
        } else {
            if (!$req->input('customer_id_dropdown')) {
                $customerData['customer_cnic_image'] = 'default.svg';
            }
        }

        if ($req->hasFile('nok_cnic_image')) {
            $cnicImage = $req->file('nok_cnic_image');
            $cnicImageName = time() . '.' . $cnicImage->getClientOriginalExtension();
            $destinationPath = public_path('images/customer/nok-cnic');
            $cnicImage->move($destinationPath, $cnicImageName);
            $customerData['nok_cnic_image'] = $cnicImageName;
        } else if ($req->input('existing_nok_cnic_image') != 'default.svg' && !$req->hasFile('nok_cnic_image')) {
            $customerData['nok_cnic_image'] = $req->input('existing_nok_cnic_image');
        } else {
            if (!$req->input('customer_id_dropdown')) {
                $customerData['nok_cnic_image'] = 'default.svg';
            }
        }

        if ($req->hasFile('thumb_impression')) {
            $thumbImpression = $req->file('thumb_impression');
            $imageName = time() . '.' . $thumbImpression->getClientOriginalExtension();
            $destinationPath = public_path('images/customer/thumb-impression');
            $thumbImpression->move($destinationPath, $imageName);
            $customerData['thumb_impression'] = $imageName;
        } else if ($req->input('existing_thumb_impression') != 'default.svg' && !$req->hasFile('thumb_impression')) {
            $customerData['thumb_impression'] = $req->input('existing_thumb_impression');
        } else {
            if (!$req->input('customer_id_dropdown')) {
                $customerData['thumb_impression'] = 'default.svg';
            }
        }

        return $customerData;
    }

    public function getInstallmentsData(Request $request, $bookingId, $customerId) {
        $installmentsData = [];
        // Assuming you have installment data in the request...
        foreach ($request->input('amounts', []) as $key => $amount) {
            $dueDate = $request->input('due_dates', [])[$key] ?? null;
            $status = $request->input('statuses', [])[$key] ?? 'pending';
            $intimationDate = $request->input('intimation_dates', [])[$key] ?? null;
    
            $installmentsData[] = [
                'booking_id' => $bookingId,
                'project_id' => $request->input('project_id'),
                'phase_id' => $request->input('phase_id'),
                'plot_id' => $request->input('plot_id'),
                'customer_id' => $customerId,
                'amount' => $amount,
                'due_date' => $dueDate,
                'installment_status' => $status,
                'intimation_date' => $intimationDate,
                'created_at' => now(),
                'updated_at' => now(),
                // Add other fields as necessary
            ];
        }
        // dd($installmentsData);
        return $installmentsData;
            
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

    public function getCancelledBooking(Request $req){
        $cancelledBooking = [
            'booking_id' => $req->input('bookingId'),
            'plot_id' => $req->input('plotId'),
            'reason' => $req->input('reason_for_cancellation'),
            'date_and_time' => now(),
            'cancelled_by' => session()->get('username'),
        ];
        if ($req->hasFile('noc')) {
            $nocFile = $req->file('noc');
            $nocFileName = time() . '.' . $nocFile->getClientOriginalExtension();
            $destinationPath = public_path('assets/media/cancelled_booking/noc');
            $nocFile->move($destinationPath, $nocFileName);
            $cancelledBooking['noc'] = $nocFileName;
        }
        // dd($nocFileName);
        return $cancelledBooking;
    }
    
    public function cancelBooking(Request $req){
        if($req->input('cancelled') === 'CANCELLED' && $req->has('cancel_booking_checkbox')){
            $cancelledBooking = $this->getCancelledBooking($req);
            $bookingId = $cancelledBooking['booking_id'];
            $plotId = $cancelledBooking['plot_id'];

            try 
            { 
                \DB::beginTransaction();
                $cancelledBookingId = DB::table('cancelled_bookings')->insertGetId($cancelledBooking);
                DB::table('plots_inventory')
                    ->where('id', $plotId)
                    ->update(['isBooked' => 'n']);

                DB::table('booking')
                    ->where('id', $bookingId)
                    ->update(['status' => 'cancelled']);

                DB::table('installment')
                    ->where('booking_id', $bookingId)
                    ->where('plot_id', $plotId)
                    ->where('installment_status', '!=', 'paid')
                    ->update(['installment_status' => 'cancelled']);

                if ($req->hasFile('cancelled_booking_media')) {
                    foreach ($req->file('cancelled_booking_media') as $file) {
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $filePath = public_path('assets/media/cancelled_booking/media');
                        $file->move($filePath, $filename);

                        DB::table('cancelled_bookings_media')->insert([
                            'cancelled_booking_id' => $cancelledBookingId,
                            'media_name' => $filename,
                        ]);
                    }
                }
                \DB::commit();
                return response()->json(['success' => 'Booking cancelled successfully']);
            }   
            catch (\Exception $e) 
            {   
                \DB::rollBack();
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return response()->json(['error' => $e->getMessage()], 422);
    }

    public function addBooking(Request $req)
    {
        $customerData =$this->getCustomerData($req);
        $bookingData = $this->getBookingData($req);
        $bookingData['status'] = 'active';
        $customerId= null;
        DB::beginTransaction();
        try
        {
            if(DB::table('booking')->where('plot_id', $bookingData['plot_id'])->first())
            {
                return response()->json(['error' => 'Plot already booked']);
            }
            else
            {
                $customerExists = $req->input('customer_exists');
                if ($customerExists === 'yes') {
                    $customerId = $req->input('customer_id_dropdown');
                    DB::table('customer')->where('id', $customerId)->update($customerData);
                } elseif ($customerExists === 'no') {
                    $customerId = DB::table('customer')->insertGetId($customerData);
                }
                
                $bookingData['customer_id'] = $customerId;
                $bookingId = DB::table('booking')->insertGetId($bookingData);
                $installmentsData = $this->getInstallmentsData($req, $bookingId, $customerId);
                DB::table('installment')->insert($installmentsData);
                DB::table('plots_inventory')
                ->where('id', $bookingData['plot_id'])
                ->limit(1)
                ->update(array('isBooked' => 'y'));
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
