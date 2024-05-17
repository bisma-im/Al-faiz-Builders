<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function showInvoices(){
        $invoices = DB::table('invoice')
        ->join('booking as b', 'b.id', '=', 'invoice.booking_id')
        ->join('customer as c', 'c.id', '=', 'b.customer_id')
        ->join('plots_inventory as pl', 'pl.id', '=', 'b.plot_id')
        ->select('invoice.id', 'invoice.booking_id', 'c.name', 'invoice.created_at', 'pl.plot_no', 'invoice.total_amount')
        ->get();
        return view('pages.invoices', ['invoiceData' => $invoices]);
    }

    public function showAddInvoiceForm(Request $req, $id=null)
    {
        try
        {   
            $invoiceData = $invoiceItems =  null;
            $bookings = DB::table('booking')
                ->join('customer as c', 'c.id', '=', 'booking.customer_id')
                ->select('booking.id', 'c.name', 'c.cnic_number')
                ->get();

            if($id)
            {
                $invoiceData = DB::table('invoice')
                    ->join('booking as b', 'b.id', '=', 'invoice.booking_id')
                    ->join('projects as pr', 'pr.id', '=', 'b.project_id')
                    ->join('phase as ph', 'ph.id', '=', 'b.phase_id')
                    ->join('plots_inventory as pl', 'pl.id', '=', 'b.plot_id')
                    ->where('invoice.id', $id)
                    ->select('pr.project_title', 'ph.phase_title', 'pl.plot_no', 
                    'invoice.id', 'invoice.booking_id', 'invoice.total_amount')
                    ->first();

                $invoiceItems = DB::table('invoice_item')
                ->where('invoice_id', $id)
                ->select('description', 'amount')
                ->get();
                // dd($invoiceItems);
            }

            return view('pages.add-invoice', compact('bookings','invoiceData', 'invoiceItems'));
        
        }
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getBookingDetails(Request $req)
    {   
        $bookingId = $req->booking_id;
        $bookingDetails = DB::table('booking')
            ->join('projects as pr', 'pr.id', '=', 'booking.project_id')
            ->join('phase as ph', 'ph.id', '=', 'booking.phase_id')
            ->join('plots_inventory as pl', 'pl.id', '=', 'booking.plot_id')
            ->where('booking.id', $bookingId)
            ->select('pr.project_title', 'ph.phase_title', 'pl.plot_no')
            ->get();

        return response()->json($bookingDetails);
    }

    public function getInvoiceData(Request $req)
    {
        // $invoiceDateTime = Carbon::createFromFormat('Y-m-d H:i', $req->input('invoice_date_time'));
        $invoiceData=[
            'booking_id' => $req->input('booking_id'),
            'created_at' => now(),
            'created_by' => session()->get('username'),
            'total_amount' => $req->input('total_amount'),
        ];

        return $invoiceData;
    }

    public function addInvoice(Request $req)
    {   
        $validator = Validator::make($req->all(), [
            'kt_ecommerce_add_item_options.*.description' => 'required_with:kt_ecommerce_add_item_options.*.amount',
            'kt_ecommerce_add_item_options.*.amount' => 'required_with:kt_ecommerce_add_item_options.*.description',
        ], [
            'kt_ecommerce_add_item_options.*.description.required_with' => 'A description is required when an amount is provided.',
            'kt_ecommerce_add_item_options.*.amount.required_with' => 'An amount is required when a description is provided.',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Both description and amount are required.'
            ]);
        }
        // dd(now());
        $invoiceData= $this->getInvoiceData($req);
        $totalAmount = 0;
        $invoiceItems = [];
        $items = $req->input('kt_ecommerce_add_item_options');
        $customerData = DB::table('customer')
                        ->join('booking as b', 'b.customer_id', '=', 'customer.id')
                        ->where('b.id', $invoiceData['booking_id'])
                        ->select('customer.name', 'customer.id')
                        ->get();
        $data = [
            'invoiceData' => $invoiceData,
            'customerData' => $customerData,
        ];
        try
        {
            
            DB::beginTransaction();
            $invoiceId = DB::table('invoice')->insertGetId($invoiceData);
            $invoiceData['id'] = $invoiceId;
            if($items)
            {
                foreach($items as $item)
                {
                        $invoiceItems[] = [
                            'invoice_id' => $invoiceId,
                            'description' => $item['description'],
                            'amount' => (float)$item['amount'],
                        ];
                    
                } 

                $data['invoiceItems'] = $invoiceItems;

                DB::table('invoice_item')->insert($invoiceItems);
                DB::commit();

                $reportId = Str::random(40);
                Cache::put($reportId, $data, now()->addMinutes(30));

                return response()->json([
                    'success' => true,
                    'message' => 'Invoice added successfully. Your invoice ID is ' . $invoiceId,
                    'reportId' => $reportId,
                ]);
            }  
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'You must add at least one item to generate an invoice.'
                ]);
            }
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }      
    }

    public function generateInvoicePdf(Request $request) {
        $reportId = $request->query('reportId');
    
        // Retrieve the cached data using reportId
        $data = Cache::get($reportId);
    
        if ($data) {
            // Proceed with PDF generation using the retrieved data
            // $pdf = App::make('dompdf.wrapper');
            // $pdf->loadView('pages.invoice-challan', $data);
            // $pdf->setPaper('a4', 'portrait'); // Set paper to landscape mode
            // return $pdf->stream('invoice-challan.pdf');
            
            $pdf = PDF::loadView('pages.invoice-challan', $data)->setPaper('a4', 'portrait');
            $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);
            $pdf->set_option('isHtml5ParserEnabled', true);
            return $pdf->stream('invoice-challan.pdf');
        } else {
            // Handle the case where there is no data (e.g., invalid reportId or cache expired)
            return response()->json(['error' => 'Invoice not found or has expired.'], 404);
        }
    }

    public function updateInvoice(Request $req)
    {
        $invoiceData = $this->getInvoiceData($req);
        $id = $req->input('id'); // Get the user ID from the request
        $invoiceItems = [];
        $items = $req->input('kt_ecommerce_add_item_options');

        foreach($items as $item)
        {
            $invoiceItems[] = [
                'invoice_id' => $id,
                'description' => $item['description'],
                'amount' => (float)$item['amount'],
            ];         
        }  
        try {
            DB::beginTransaction();
            $updated = DB::table('invoice')
                ->where('id', $id)
                ->update($invoiceData);

            DB::table('invoice_item')
                ->where('invoice_id', $id)
                ->delete();  
                
            DB::table('invoice_item')->insert($invoiceItems);

            DB::commit();
            return response()->json(['success' => 'User updated successfully']);
        } 
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}
