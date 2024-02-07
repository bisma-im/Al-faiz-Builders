<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function showInvoices(){
        $invoices = DB::table('invoice')
        ->join('customer as c', 'c.id', '=', 'invoice.customer_id')
        ->join('projects as pr', 'pr.id', '=', 'invoice.project_id')
        ->join('plots_inventory as pl', 'pl.id', '=', 'invoice.plot_id')
        ->select('invoice.id', 'c.name', 'pr.project_title','pl.plot_no', 'invoice.invoice_date', 'invoice.invoice_time', 'invoice.total_amount')
        ->get();
        return view('pages.invoices', ['invoiceData' => $invoices]);
    }

    public function showAddInvoiceForm(Request $req, $id=null)
    {
        try
        {   
            $invoiceData = null;
            $customers = DB::table('customer')
                ->select('id', 'name', 'cnic_number')
                ->get();

            $projects = DB::table('projects')
                ->select('id', 'project_title')
                ->get();

            if($id)
            {
                $invoiceData = DB::table('invoice')
                ->where('id', $id)
                ->first();

                $formattedDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $invoiceData->invoice_date . ' ' . $invoiceData->invoice_time)
                                ->format('Y-m-d H:i');
                $invoiceData->formattedDateTime = $formattedDateTime;
            }

            return view('pages.add-invoice', compact('customers','projects','invoiceData'));
        
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

    public function getInvoiceData(Request $req)
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

        return $invoiceData;
    }

    public function addInvoice(Request $req)
    {   
        $invoiceData= $this->getInvoiceData($req);
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

    public function updateInvoice(Request $req)
    {
        $invoiceData = $this->getInvoiceData($req);
        $id = $req->input('id'); // Get the user ID from the request
        try {
            $updated = DB::table('invoice')
                ->where('id', $id)
                ->update($invoiceData);
    
            if ($updated) {
                return response()->json(['success' => 'User updated successfully']);
            } else {
                return response()->json(['error' => 'User not found or update failed'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
