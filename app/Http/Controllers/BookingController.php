<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function showBookings(Request $req, $phaseId = null, $projectId = null)
    {
        $sessionUsername = $req->session()->get('username');
        $sessionRole = $req->session()->get('role');

        if ($sessionRole === 'dealer' || in_array('booking', session('permissions', []))) {
            $projects = DB::table('projects')
                ->join('phase', 'phase.project_id', '=', 'projects.id')
                ->select('projects.id', 'projects.project_title')
                ->distinct()
                ->get();

            $phases = DB::table('phase')
                ->select('id', 'project_id', 'phase_title')
                ->get();

            if ($phaseId && $projectId) {
                $selectedPhaseId = $phaseId;
                $selectedProjectId = $projectId;
            } else {
                // Check if there are any projects before trying to access the first one
                $selectedProjectId = $req->input('selectedProject') ?: ($projects->isNotEmpty() ? $projects->first()->id : null);

                // Ensure there is a selected project ID before attempting to find phases
                if ($selectedProjectId) {
                    $selectedPhase = $phases->where('project_id', $selectedProjectId)->first();
                    $selectedPhaseId = $req->input('selectedPhase') ?: ($selectedPhase ? $selectedPhase->id : null);
                } else {
                    $selectedPhaseId = null;
                }
            }

            // dd($phaseId, $projectId, $selectedProjectId, $selectedPhaseId);
            $routeName = $req->route()->getName();
            $selectedStatus = $routeName === 'showCancelledBookings' ? 'cancelled' : 'active';

            $query = DB::table('booking as b')
                ->join('customer as c', 'c.id', '=', 'b.customer_id')
                ->join('projects as pr', 'pr.id', '=', 'b.project_id')
                ->join('plots_inventory as pl', 'pl.id', '=', 'b.plot_id')
                ->join('phase as ph', 'ph.id', '=', 'pl.phase_id')
                ->leftJoin(DB::raw("(SELECT booking_id, COALESCE(SUM(amount), 0) as total_dc
                         FROM development_charges
                         GROUP BY booking_id) as dc"), 'dc.booking_id', '=', 'b.id')
                ->leftJoin('installment as i', 'i.booking_id', '=', 'b.id')
                ->select(
                    'b.id',
                    'b.total_amount',
                    'c.name', // Alias is applied here directly
                    'cnic_number',
                    'c.mobile_number_1',
                    'pr.project_title',
                    'pl.plot_no',
                    'b.demarcation_charges',
                    'dc.total_dc',
                    DB::raw("SUM(CASE WHEN i.installment_status = 'paid' THEN i.amount ELSE 0 END) as received_amount"),
                    DB::raw("SUM(CASE WHEN i.installment_status = 'pending' THEN i.amount ELSE 0 END) as pending_amount")
                )
                ->where('b.username', $sessionUsername)
                ->where('b.status', $selectedStatus);
            // dd($phaseId, $projectId);
            // Apply project filter only if not 'all'
            if ($selectedProjectId !== 'all') {
                $query->where('b.project_id', $selectedProjectId);
            }
            // dd($phaseId, $projectId, $selectedProjectId, $selectedPhaseId, $projects, $phases);
            // Apply phase filter only if not 'all'
            if ($selectedPhaseId !== 'all') {
                $query->where('ph.id', $selectedPhaseId);
            }
            $bookingData = $query->groupBy('b.id', 'c.name', 'c.cnic_number', 'c.mobile_number_1', 'pr.project_title', 'pl.plot_no', 'b.total_amount', 'b.demarcation_charges', 'dc.total_dc')->get();
            // dd($bookingData);
            $fromHref = $req->query('fromHref', false);
            if ($req->ajax() && !$fromHref) {
                // return view('partials.booking_row', compact('bookingData', 'projects', 'phases', 'selectedProjectId', 'selectedPhaseId', 'selectedStatus'))->render();
                // response()->json(['success' => 'booking added successfully', 'data' => $bookingData]);
                // dd('this is ajax call');
                return response()->json($bookingData);
            } else {
                // dd($bookingData);
                return view('pages.bookings', compact('bookingData', 'projects', 'phases', 'selectedProjectId', 'selectedPhaseId', 'selectedStatus'));
            }
        } else {
            return redirect()->back();
        }
    }

    public function showBookingForm(Request $req, $id = null)
    {
        try {
            $bookingData = $bookingMedia = null;
            $isLockedMode = $isCancelled = $devCharges = null;
            $customers = DB::table('customer')
                ->get();

            $projects = DB::table('projects')
                ->select('id', 'project_title')
                ->get();

            if ($id) {
                $bookingData = DB::table('booking')
                    ->join('customer as c', 'c.id', '=', 'booking.customer_id')
                    ->join('projects as pr', 'pr.id', '=', 'booking.project_id')
                    ->join('phase as ph', 'ph.id', '=', 'booking.phase_id')
                    ->join('plots_inventory as pl', 'pl.id', '=', 'booking.plot_id')
                    ->select(
                        'booking.*',
                        'c.name',
                        'c.cnic_number',
                        'c.address',
                        'c.customer_image',
                        'c.mobile_number_1',
                        'c.next_of_kin_name',
                        'c.next_of_kin_relation',
                        'c.next_of_kin_cnic',
                        'c.next_of_kin_address',
                        'c.next_of_kin_mobile_number_1',
                        'c.thumb_impression',
                        'c.customer_cnic_image',
                        'c.nok_cnic_image',
                        'ph.completion_date',
                        'ph.phase_title',
                        'pr.project_title',
                        'pl.plot_no',
                        'pl.category',
                        'pl.file_reg_number'
                    )
                    ->where('booking.id', $id)
                    ->first();

                $bookingMedia = DB::table('booking_media')->where('booking_id', $id)->get();

                // dd($bookingMedia);

                $devCharges = DB::table('development_charges')
                ->where('booking_id', $id)
                ->get()
                ->map(function ($devCharge) {
                    // Format due date and calculate intimation date
                    $devCharge->due_date = Carbon::parse($devCharge->due_date)->format('d-M-Y');
                    $devCharge->intimation_date = Carbon::parse($devCharge->due_date)->subDays(5)->format('d-M-Y');
                    
                    // Check for invoice and get payment_date and payment_status if invoice exists
                    if ($devCharge->invoice_id) {
                        $invoice = DB::table('invoice')->where('id', $devCharge->invoice_id)->first();
                        
                        // Set payment date
                        $devCharge->payment_date = $invoice && $invoice->payment_date
                            ? Carbon::parse($invoice->payment_date)->format('d-M-Y')
                            : 'N/A';
                
                        // Set payment status
                        $devCharge->payment_status = $invoice && $invoice->payment_status
                            ? $invoice->payment_status
                            : 'N/A';
                    } else {
                        $devCharge->payment_date = 'N/A';
                        $devCharge->payment_status = 'N/A';
                    }
                
                    return $devCharge;
                });

                if ($bookingData->isLocked === 1) {
                    $isLockedMode = true;
                }
                if ($bookingData->status === 'cancelled') {
                    $isCancelled = true;
                }
            }

            return view('pages.add-booking', compact('customers', 'projects', 'bookingData', 'isLockedMode', 'isCancelled', 'devCharges', 'bookingMedia'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function downloadBookingMedia(Request $req, $docName=null)
    {
        if($docName)
        {
            $docPath = public_path('bookings/' . $docName); // Ensure the file name is appended to the path

            if (file_exists($docPath)) {
                // Return a download response
                return response()->download($docPath);
            } else {
                // Handle the case where the file doesn't exist
                abort(404);
            }
        }
    }

    public function addDevChargesForm(Request $req)
    {
        $bookings = null;
        try {
            $bookings = DB::table('booking')
                ->join('customer as c', 'c.id', '=', 'booking.customer_id')
                ->join('plots_inventory as pl', 'pl.id', '=', 'booking.plot_id')
                ->select('booking.id', 'c.name as customer_name', 'c.cnic_number', 'pl.plot_no')
                ->where('booking.status', 'active')->get();

            return view('pages.development-charges', compact('bookings'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addDemarcChargesForm(Request $req)
    {
        $currentRouteName = $req->route()->getName();
        $bookings = null;
        $isDemarc = 'n';
        try {
            $temp = DB::table('booking')
                ->join('customer as c', 'c.id', '=', 'booking.customer_id')
                ->join('plots_inventory as pl', 'pl.id', '=', 'booking.plot_id')
                ->select('booking.id', 'c.name as customer_name', 'c.cnic_number', 'pl.plot_no')
                ->where('booking.status', 'active');

            // Check the route to see if it's the 'addDemarcationChargesForm' route
            if ($currentRouteName === 'addDemarcationChargesForm') {
                $isDemarc = 'y';
                // Filter where 'demarcation_charges' is null or empty
                $bookings = $temp->where(function ($query) {
                    $query->whereNull('booking.demarcation_charges')
                        ->orWhere('booking.demarcation_charges', '');
                })->get();
            }

            return view('pages.add-dev-charges', compact('bookings', 'isDemarc'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCustomer($customerId)
    {
        try {
            $customer = DB::table('customer')
                ->select(
                    'id',
                    'name',
                    'cnic_number',
                    'address',
                    'customer_image',
                    'mobile_number_1',
                    'next_of_kin_name',
                    'next_of_kin_relation',
                    'next_of_kin_cnic',
                    'next_of_kin_address',
                    'next_of_kin_mobile_number_1',
                    'thumb_impression',
                    'customer_cnic_image',
                    'nok_cnic_image'
                )
                ->where('id', $customerId)
                ->get();

            return response()->json(['success' => true, 'data' => $customer,], 200);
        } catch (\Exception $e) {
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
            ->get(['id', 'plot_no', 'category']);

        return response()->json($availablePlots);
    }

    public function getPhasesForBooking(Request $req)
    {
        $project_id = $req->project_id;
        if ($project_id === 'all') {
            $phases = DB::table('phase')
                ->join('projects as pr', 'pr.id', '=', 'phase.project_id')
                ->get(['phase.id', 'phase.phase_title', 'phase.completion_date', 'pr.project_title']);

            // dd($phases);
        } else {
            $phases = DB::table('phase')
                ->where('project_id', $project_id)
                ->get(['id', 'phase_title', 'completion_date']);
        }

        return response()->json($phases);
    }

    public function getBookingData(Request $req)
    {
        $bookingDate = Carbon::createFromFormat('Y-m-d', $req->input('booking_date'));
        $currentTime = Carbon::now('Asia/Karachi');

        // Set the time to the current time
        $bookingDate->hour($currentTime->hour)
            ->minute($currentTime->minute)
            ->second($currentTime->second);

        $bookingData = [
            'project_id' => $req->input('project_id'),
            'phase_id' => $req->input('phase_id'),
            'plot_id' => $req->input('plot_id'),
            'unit_cost' => $req->input('unit_cost'),
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
            'created_on' => $bookingDate->toDateTimeString(),
        ];
        return $bookingData;
    }

    public function getCustomerData(Request $req)
    {
        $customerData = [
            'name' => $req->input('customer_name'),
            'address' => $req->input('customer_address'),
            'mobile_number_1' => $req->input('mobile_no'),
            'cnic_number' => $req->input('customer_cnic'),
            'next_of_kin_name' => $req->input('nok_name'),
            'next_of_kin_relation' => $req->input('nok_relation'),
            'next_of_kin_cnic' => $req->input('nok_cnic'),
            'next_of_kin_address' => $req->input('nok_address'),
            'next_of_kin_mobile_number_1' => $req->input('nok_mobile_no'),
            'created_by' => session()->get('username'),
        ];

        if ($req->hasFile('avatar')) {
            $avatar = $req->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $destinationPath = public_path('images/customer-images');
            $avatar->move($destinationPath, $avatarName);
            $customerData['customer_image'] = $avatarName;
        } else if ($req->input('existing_customer_image') != 'blank.png' && !$req->hasFile('avatar')) {
            $customerData['customer_image'] = $req->input('existing_customer_image');
        } else {
            if (!$req->input('customer_id_dropdown')) {
                $customerData['customer_image'] = 'blank.png';
            }
        }

        if ($req->hasFile('cnic_image')) {
            $cnicImage = $req->file('cnic_image');
            $cnicImageName = time() . '.' . $cnicImage->getClientOriginalExtension();
            $destinationPath = public_path('images/customer/customer-cnic');
            $cnicImage->move($destinationPath, $cnicImageName);
            $customerData['customer_cnic_image'] = $cnicImageName;
        } else if ($req->input('existing_cnic_image') != 'blank.png' && !$req->hasFile('cnic_image')) {
            $customerData['customer_cnic_image'] = $req->input('existing_cnic_image');
        } else {
            if (!$req->input('customer_id_dropdown')) {
                $customerData['customer_cnic_image'] = 'blank.png';
            }
        }

        if ($req->hasFile('nok_cnic_image')) {
            $cnicImage = $req->file('nok_cnic_image');
            $cnicImageName = time() . '.' . $cnicImage->getClientOriginalExtension();
            $destinationPath = public_path('images/customer/nok-cnic');
            $cnicImage->move($destinationPath, $cnicImageName);
            $customerData['nok_cnic_image'] = $cnicImageName;
        } else if ($req->input('existing_nok_cnic_image') != 'blank.png' && !$req->hasFile('nok_cnic_image')) {
            $customerData['nok_cnic_image'] = $req->input('existing_nok_cnic_image');
        } else {
            if (!$req->input('customer_id_dropdown')) {
                $customerData['nok_cnic_image'] = 'blank.png';
            }
        }

        if ($req->hasFile('thumb_impression')) {
            $thumbImpression = $req->file('thumb_impression');
            $imageName = time() . '.' . $thumbImpression->getClientOriginalExtension();
            $destinationPath = public_path('images/customer/thumb-impression');
            $thumbImpression->move($destinationPath, $imageName);
            $customerData['thumb_impression'] = $imageName;
        } else if ($req->input('existing_thumb_impression') != 'blank.png' && !$req->hasFile('thumb_impression')) {
            $customerData['thumb_impression'] = $req->input('existing_thumb_impression');
        } else {
            if (!$req->input('customer_id_dropdown')) {
                $customerData['thumb_impression'] = 'blank.png';
            }
        }

        return $customerData;
    }

    public function getInstallmentsData(Request $request, $bookingId, $customerId)
    {
        $installmentsData = [];

        $dueDates = $request->input('due_dates', []);

        $latestDueDate = min($dueDates);

        // Assuming you have installment data in the request...
        foreach ($request->input('amounts', []) as $key => $amount) {
            $dueDate = $dueDates[$key];
            $status = $request->input('statuses', [])[$key] ?? 'pending';
            $intimationDate = $request->input('intimation_dates', [])[$key];

            // Check if due date is today
            $advanceAndToken = ($dueDate === $latestDueDate) ? 'y' : 'n';

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
                'advance_and_token' => $advanceAndToken,
                'created_at' => now(),
                'updated_at' => now(),
                // Add other fields as necessary
            ];
        }
        // dd($installmentsData);
        return $installmentsData;
    }

    public function getRegistrationNumber($plotId)
    {
        $plot = DB::table('plots_inventory')->where('id', $plotId)->first();
        $regNumber = $plot ? $plot->file_reg_number : null;  // This will be null if no plot or no regNumber

        return response()->json([
            'success' => $plot !== null,
            'data' => $regNumber,
        ]);
    }

    public function getInstallments($bookingId)
    {
        $installments = DB::table('installment')
            ->leftJoin('invoice as inv', 'inv.id', '=', 'installment.invoice_id')
            ->select('installment.*', 'inv.payment_date as pd')
            ->where('installment.booking_id', $bookingId)
            ->orderBy('installment.due_date', 'asc')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $installments,
        ]);
    }

    public function getCancelledBooking(Request $req)
    {
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

    public function cancelBooking(Request $req)
    {
        if ($req->input('cancelled') === 'CANCELLED' && $req->has('cancel_booking_checkbox')) {
            $cancelledBooking = $this->getCancelledBooking($req);
            $bookingId = $cancelledBooking['booking_id'];
            $plotId = $cancelledBooking['plot_id'];

            try {
                DB::beginTransaction();
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
                DB::commit();
                return response()->json(['success' => 'Booking cancelled successfully']);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return response()->json(['error' => 'error'], 422);
    }

    public function addBooking(Request $req)
    {
        $customerData = $this->getCustomerData($req);
        $bookingData = $this->getBookingData($req);
        $regNumber = $req->input('file_reg_number');
        $bookingData['status'] = 'active';
        $customerId = null;
        DB::beginTransaction();
        try {
            if (DB::table('booking')->where('plot_id', $bookingData['plot_id'])->where('status', 'active')->first()) {
                return response()->json(['error' => 'Plot already booked']);
            } else {
                $customerExists = $req->input('customer_exists');
                if ($customerExists === 'yes') {
                    $customerId = $req->input('customer_id_dropdown');
                    DB::table('customer')->where('id', $customerId)->update($customerData);
                } elseif ($customerExists === 'no') {
                    $customerId = DB::table('customer')->insertGetId($customerData);
                }

                $bookingData['customer_id'] = $customerId;
                // dd($bookingData)
                $bookingId = DB::table('booking')->insertGetId($bookingData);
                // dd($req->input('amounts', []));
                $installmentsData = $this->getInstallmentsData($req, $bookingId, $customerId);
                // dd($installmentsData);
                DB::table('installment')->insert($installmentsData);
                DB::table('plots_inventory')
                    ->where('id', $bookingData['plot_id'])
                    ->limit(1)
                    ->update(array('isBooked' => 'y', 'file_reg_number' => $regNumber));

                if ($req->hasFile('booking_media')) {
                    foreach ($req->file('booking_media') as $file) {
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $filePath = public_path('bookings');
                        $file->move($filePath, $filename);

                        DB::table('booking_media')->insert([
                            'booking_id' => $bookingId,
                            'media_name' => $filename,
                        ]);
                    }
                }

                DB::commit();
                return response()->json(['success' => 'booking added successfully']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }



    public function updateBooking(Request $req)
    {
        $id = $req->input('id');
        // $customerId = $req->input('customer_id');
        $installmentIds = $req->input('installment_ids', []);
        $amounts = $req->input('amounts', []);

        $devInstallmentIds = $req->input('dev_installment_ids', []);
        $devAmounts = $req->input('devAmounts', []);

        // dd($devInstallmentIds, $devAmounts);

        DB::beginTransaction();
        try {
            foreach ($installmentIds as $index => $installmentId) {
                if (isset($amounts[$index])) { // Check if the amount index exists to avoid index errors
                    DB::table('installment')->where('id', $installmentId)
                        ->update(['amount' => $amounts[$index], 'updated_at' => now()]);
                }
            }

            foreach ($devInstallmentIds as $index => $devInstallmentId) {
                if (isset($devAmounts[$index])) { // Check if the amount index exists to avoid index errors
                    DB::table('development_charges')->where('id', $devInstallmentId)
                        ->update(['amount' => $devAmounts[$index], 'timestamp' => now()]);
                }
            }

            DB::commit();
            return response()->json(['success' => 'Booking updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addDemarcCharges(Request $req)
    {
        $bookingId = $req->booking_id;

        if ($req->input('isDemarc') && $req->input('isDemarc') === 'y') {
            // This block handles demarcation charges
            DB::table('booking')->where('id', $bookingId)->update(['demarcation_charges' => $req->dev_charges]);
            return response()->json(['success' => 'Demarcation charges added successfully', 'devChargesId' => null, 'bookingId' => $bookingId]);
        }
        $devChargesData = [
            'booking_id' => $bookingId,
            'amount' => $req->dev_charges,
            'description' => $req->dev_charges_description,
            'due_date' => Carbon::now()->addMonth()->toDateString(),
            'timestamp' => now(),
        ];

        // dd($devChargesData);
        $devChargesId = null;
        DB::beginTransaction();
        try {
            $devChargesId = DB::table('development_charges')->insertGetId($devChargesData);
            DB::commit();
            return response()->json(['success' => 'Charges added successfully', 'devChargesId' => $devChargesId, 'bookingId' => $bookingId]);
        } catch (\Exception $e) {
            DB::rollBack();
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    public function addDevCharges(Request $request) {
        $installmentsData = [];

        $dueDates = $request->input('due_dates', []);
        $totalAmount = $request->input('dev_charge');
        $bookingId = $request->input('booking_id');
        // Assuming you have installment data in the request...
        foreach ($request->input('amounts', []) as $key => $amount) {
            $dueDate = $dueDates[$key];

            $installmentsData[] = [
                'booking_id' => $bookingId,
                'amount' => $amount,
                'due_date' => $dueDate,
                'timestamp' => now(),
            ];
        }

        DB::beginTransaction();
        try {
            DB::table('development_charges')->insert($installmentsData);
            DB::table('booking')->where('id', $bookingId)->update(['development_charges' => $totalAmount]);
            DB::commit();
            return response()->json(['success' => 'Development charges added successfully'], 201);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
