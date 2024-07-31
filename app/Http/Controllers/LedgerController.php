<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class LedgerController extends Controller
{
    public function showLedgerForm(){
        $accounts = DB::table('chart_of_accounts')->select('Account_Code', 'Account_Title')->get();
        return view('pages.ledger-form', compact('accounts'));
    }
    
    protected function fetchDataForPdf($startDate, $endDate, $accountCode) {
        $accountName = DB::table('chart_of_accounts')->select('Account_Title')->where('Account_Code', $accountCode)->first();
        $transactions = DB::table('voucher')
                            ->where('account_code', $accountCode)
                            ->where('date', '>=', $startDate)
                            ->where('date', '<=', $endDate)
                            ->orderBy('date', 'asc')
                            ->get();
    
        return [
            'transactions' => $transactions,
            'accountName' => $accountName->Account_Title, // Adjust based on your actual structure
            'startDate' => $startDate,
            'endDate' => $endDate,
            'accountCode' => $accountCode
        ];
    }
    
    public function showLedger(Request $request) {
        $startDate = Carbon::createFromFormat('d-m-Y', $request->input('start_date'))->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d-m-Y', $request->input('end_date'))->format('Y-m-d');
        $accountCode = $request->input('account_head_code');
    
        $exists = DB::table('voucher')
                    ->where('account_code', $accountCode)
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->exists();
    
        if ($exists) {
            $reportId = Str::random(40);
    
            // Assuming you fetch data here for PDF generation
            $data = $this->fetchDataForPdf($startDate, $endDate, $accountCode);
    
            // Cache the data with reportId as the key
            // The data is stored in the cache for a limited amount of time, say 30 minutes
            Cache::put($reportId, $data, now()->addMinutes(30));
            // dd(Cache::get($reportId));
    
            return response()->json(['success' => true, 'reportId' => $reportId]);
        } else {
            return response()->json(['success' => false, 'message' => 'No transactions found.']);
        }
    }

    public function downloadLedger(Request $request) {
        $reportId = $request->query('reportId');
    
        // Retrieve the cached data using reportId
        $data = Cache::get($reportId);
    
        if ($data) {
            // Proceed with PDF generation using the retrieved data
            $pdf = PDF::loadView('pages.ledger-account', $data);
            return $pdf->stream('ledger-account.pdf');
        } else {
            // Handle the case where there is no data (e.g., invalid reportId or cache expired)
            return response()->json(['error' => 'Report data not found or has expired.'], 404);
        }
    }
}
