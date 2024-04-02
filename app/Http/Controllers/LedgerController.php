<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LedgerController extends Controller
{
    public function showLedgerForm(){
        $accounts = DB::table('acc_coa')->select('HeadCode', 'HeadName')->get();
        return view('pages.ledger-form', compact('accounts'));
    }

    public function showLedger(Request $req){
        $startDate = Carbon::createFromFormat('d-m-Y', $req->input('start_date'))->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d-m-Y', $req->input('end_date'))->format('Y-m-d');
        $accountCode = $req->input('account_head_code');
        $accountName = DB::table('acc_coa')->select('HeadName')->where('HeadCode', $accountCode)->first();
        $transactions = DB::table('voucher')
                        ->where('account_code', $accountCode)
                        ->where('date', '>=', $startDate)
                        ->where('date', '<=', $endDate)
                        ->orderBy('date', 'asc')
                        ->get();
        $data = [
            'transactions' => $transactions,
            'accountCode' => $accountCode,
            'accountName' => $accountName,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];
        $pdf = Pdf::loadView('pages.ledger-account', $data);
        return $pdf->download('ledger-account.pdf');
        
    }
}
