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
        ->join('chart_of_accounts', 'chart_of_accounts.Account_Code', '=', 'v.account_code')
        ->select('v.account_code', 'chart_of_accounts.Account_Title',
                 DB::raw("(SELECT balance FROM voucher as v2 
                           WHERE v2.account_code = v.account_code 
                             AND v2.date <= ?
                           ORDER BY v2.id DESC 
                           LIMIT 1) as balance"))
        ->where('v.date', '<=', $endDate)
        ->groupBy('v.account_code', 'chart_of_accounts.Account_Title')
        ->setBindings([$endDate, $endDate]) // Binding $endDate for both placeholders
        ->get();
        // Calculate the total debits and credits for the trial balance
        $totalDebits = 0;
        $totalCredits = 0;
        $debitAccounts = [];
        $creditAcconts = [];

        foreach ($accountBalances as $accountBalance) {
            // Assuming 'A' and 'E' head types should be debits and the rest should be credits
            if (in_array(substr($accountBalance->account_code, 0, 1), ['1', '5']) || $accountBalance->account_code == '4-001-002' || $accountBalance->account_code == '6-001-001') {
                $totalDebits += $accountBalance->balance;
                $debitAccounts[$accountBalance->Account_Title] = $accountBalance->balance;
            } else {
                $totalCredits += $accountBalance->balance;
                $creditAcconts[$accountBalance->Account_Title] = $accountBalance->balance;
            }
        }
        // dd($debitAccounts, $creditAcconts);
        $data = [
            'accountBalances' => $accountBalances,
            'totalDebits' => $totalDebits,
            'totalCredits' => $totalCredits,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        // $this->generatePdf($data, 'trial-balance');
        $pdf = Pdf::loadView('pages.trial-balance', $data)->setPaper('a4', 'landscape');
        $filename = 'trial-balance-' . $data['endDate'] . '.pdf';
        return $pdf->download($filename);
    }

    public function generatePdf($data, $pageName){
        $pdf = Pdf::loadView('pages.trial-balance', $data)->setPaper('a4', 'landscape');
        $filename = 'trial-balance-' . $data['endDate'] . '.pdf';
        return $pdf->download($filename);
    }

    // $pdf = Pdf::loadView(`pages.trial-balance`, $data)->setPaper('a4', 'landscape');
    //     $filename = 'trial-balance-' . $data['endDate'] . '.pdf';
    //     return $pdf->download($filename);

    public function generateIncomeStatement(Request $request) {
        // $startDate = Carbon::createFromFormat('d-m-Y', $request->input('start_date'))->format('Y-m-d');
        // $endDate = Carbon::createFromFormat('d-m-Y', $request->input('end_date'))->format('Y-m-d');
        $endDate = date('Y-m-d');
        //SELECT SUBSTRING I.E FIRST CHARACTER OF ACCOUNT CODE AND SELECT ALL ACCOUNTS THAT HAVE 4, 5, AND 6 AS 1ST CHAR
        $details = DB::table('chart_of_accounts as coa')
                    ->joinSub(
                        DB::table('voucher')
                            ->select('account_code', DB::raw('MAX(added_on) as added_on'))
                            ->where('date', '<=', $endDate)
                            ->groupBy('account_code'),
                        'latest_voucher',
                        'coa.Account_Code',
                        '=',
                        'latest_voucher.account_code'
                    )
                    ->join('voucher as v', function ($join) {
                        $join->on('coa.Account_Code', '=', 'v.account_code')
                            ->on('latest_voucher.added_on', '=', 'v.added_on');
                    })
                    ->where('coa.Level', '=', 3)
                    ->where(function ($query) {
                        $query->where('coa.Account_Code', 'LIKE', '4-%')  // Revenues
                            ->orWhere('coa.Account_Code', 'LIKE', '5-%') // Expenses
                            ->orWhere('coa.Account_Code', 'LIKE', '6-%'); // COGS
                    })
                    ->select('coa.Account_Title', 'coa.Account_Code', 'v.balance', 'v.date')
                    ->get();
        // dd($details);
        $level3AccountCodes = $details->pluck('Account_Code')->toArray();
        $level2Prefixes = array_unique(array_map(function($code) {
            return explode('-', $code)[0] . '-' . explode('-', $code)[1];
        }, $level3AccountCodes));

        $headings = DB::table('chart_of_accounts')
                    ->where('Level', '=', 2)
                    ->whereIn('Account_Code', $level2Prefixes)
                    ->orderByRaw("CASE 
                        WHEN Account_Code LIKE '4-%' AND (Account_Title LIKE 'SALES%' OR Account_Title LIKE 'SERVICES') THEN 1 
                        WHEN Account_Code LIKE '6-%' THEN 2 
                        WHEN Account_Code LIKE '4-%' AND (Account_Title NOT LIKE 'SALES%' OR Account_Title NOT LIKE 'SERVICES') THEN 3 
                        WHEN Account_Code LIKE '5-%' THEN 4  -- Expenses
                        ELSE 5
                    END")
                    ->get();
                    // dd($headings, $details);
        // Initialize an array to hold the heading balances
        $headingBalances = $headings->mapWithKeys(function ($heading) {
            return [$heading->Account_Code => 0];  // Start with a balance of 0
        });

        // Go through each detail, determine if it's a return/expense, and sum it under the heading
        foreach ($details as $detail) {
            $isReturnOrExpense = $this->isReturnOrExpense($detail->Account_Code);  // You'll define this method
            $balance = $isReturnOrExpense ? -1 * $detail->balance : $detail->balance;

            // Get the parent heading account code
            $parentCode = substr($detail->Account_Code, 0, strrpos($detail->Account_Code, '-'));

            // Add to the heading's balance
            if (isset($headingBalances[$parentCode])) {
                $headingBalances[$parentCode] += $balance;
            }

            // Also store individual Level 3 account balances
            $detail->net_balance = $balance;
        }
        $grossProfit =0;
        $salesBalance =0;
        $cogsBalance =0;
        $insertIndex = null;
        // Assign the aggregated balances to the headings
        foreach ($headings as $index => $heading) {
            $heading->underoverline = false;
            if (isset($headingBalances[$heading->Account_Code])) {
                $heading->net_balance = $headingBalances[$heading->Account_Code];
            }
            if ($heading->Account_Code == '4-001') { // Replace '4-001' with your specific sales account code
                $salesBalance = $heading->net_balance;
                $insertIndex = $index +1;
            } elseif ($heading->Account_Code == '6-001') { // Replace '6-001' with your specific COGS account code
                $cogsBalance = $heading->net_balance;
                $heading->net_balance = $heading->net_balance * -1;
                $insertIndex = $index +1;
            }
        }

        $totalExpenses = $headings->filter(function ($item) {
            return strpos($item->Account_Code, '5') === 0;
        })->sum('net_balance');
        $totalOtherIncome = $headings->filter(function ($item) {
            return strpos($item->Account_Code, '4') === 0 && $item->Account_Code !== '4-001';
        })->sum('net_balance');

        $grossProfit = $salesBalance - abs($cogsBalance);

        // Insert Gross Profit into the headings array
        $grossProfitHeading = (object)[
            'Account_Title' => 'Gross Profit',
            'Account_Code' => 'GP-001', // Unique identifier for Gross Profit
            'net_balance' => $grossProfit,
            'underoverline' => true
        ];

        if ($insertIndex !== null) {
            $headings->splice($insertIndex, 0, [$grossProfitHeading]);
        }
        $incomeBeforeTaxes = $grossProfit + $totalOtherIncome - abs($totalExpenses);
        $incomeBeforeTaxesHeading = (object)[
            'Account_Title' => 'Income Before Taxes',
            'Account_Code' => 'IBT-001',
            'net_balance' => $incomeBeforeTaxes,
            'underoverline' => true
        ];
        $headings->push($incomeBeforeTaxesHeading);
        return view('pages.profit-and-loss', compact('headings','details', 'endDate'));
    }

    private function isReturnOrExpense($accountCode)
    {
        if($accountCode === '4-001-002' || $accountCode === '6-001-002' || substr($accountCode, 0, 1) === '5')
        return true;
    }

}
