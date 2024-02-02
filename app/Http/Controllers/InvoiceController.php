<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function showAddInvoiceForm(Request $req)
    {
        try
        {
            $customers = DB::table('customer')
                ->select('id', 'name', 'cnic_number')
                ->get();

            $projects = DB::table('projects')
                ->select('id', 'project_title')
                ->get();

            return view('pages.add-invoice', compact('customers','projects'));
        
        }
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getPlotsForProject(Request $req)
    {   
        $project_id = $req->project_id;
        $plots = DB::table('plots_inventory')
            ->where('project_id', $project_id)
            ->get(['id', 'plot_no']);

        return response()->json($plots);
    }

    public function addInvoice(Request $req)
    {   
        $invoiceDateTime = Carbon::createFromFormat('Y-m-d H:i', $req->input('invoice_date_time'));

        $invoiceData=[
            'customer_id' => $req->input('customer_id'),
            'project_id' => $req->input('project_id'),
            'plot_id' => $req->input('plot_id'),
            'invoice_date' => $invoiceDateTime->toDateString(),
            'invoice_time' => $invoiceDateTime->toTimeString(),
            'created_by' => $req->input('created_by'),
            'description' => $req->input('description'),
            'total_amount' => $req->input('total_amount'),
        ];
        try
        {
            $inserted = DB::table('invoice')->insert($invoiceData);
            return response()->json(['success' => 'invoice added successfully']);
        }
        catch (\Exception $e) 
        {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }      
    }
}
