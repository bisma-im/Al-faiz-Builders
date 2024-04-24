<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class StatementsController extends Controller
{
    public function showTBForm(){
        return view('pages.generate-tb');
    }

    public function generateTrialBalance(Request $request) {
        // Define the start and end dates for the financial year (July of previous year to June of current year)
        $startDate = Carbon::createFromFormat('d-m-Y', $request->input('start_date'))->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d-m-Y', $request->input('end_date'))->format('Y-m-d');

        // Fetch the debit and credit sums and calculate the net balance for each account head
        $accountBalances = DB::table('voucher as v')
        ->join('acc_coa', 'acc_coa.HeadCode', '=', 'v.account_code')
        ->select('v.account_code', 'acc_coa.HeadName', 'acc_coa.HeadType',
                 DB::raw("(SELECT balance FROM voucher as v2 
                           WHERE v2.account_code = v.account_code 
                             AND v2.date <= ?
                           ORDER BY v2.id DESC 
                           LIMIT 1) as ending_balance"))
        ->where('v.date', '<=', $endDate)
        ->groupBy('v.account_code', 'acc_coa.HeadName', 'acc_coa.HeadType')
        ->setBindings([$endDate, $endDate]) // Binding $endDate for both placeholders
        ->get();
        // Calculate the total debits and credits for the trial balance
        $totalDebits = 0;
        $totalCredits = 0;

        foreach ($accountBalances as $accountBalance) {
            // Assuming 'A' and 'E' head types should be debits and the rest should be credits
            if (in_array($accountBalance->HeadType, ['A', 'E'])) {
                $totalDebits += $accountBalance->ending_balance;
            } else {
                $totalCredits += $accountBalance->ending_balance;
            }
        }
        // dd($accountBalances, $totalDebits,$totalCredits);
        $data = [
            'accountBalances' => $accountBalances,
            'totalDebits' => $totalDebits,
            'totalCredits' => $totalCredits,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];
                        
        $pdf = Pdf::loadView('pages.trial-balance', $data)->setPaper('a4', 'landscape');
        $filename = 'trial-balance-' . $endDate . '.pdf';
        return $pdf->download($filename);
        // return view('pages.trial-balance', compact('accountBalances', 'totalDebits', 'totalCredits', 'startDate', 'endDate'));
    }
}
