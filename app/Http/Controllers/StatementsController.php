<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatementsController extends Controller
{
    public function generateTrialBalance() {
        // Define the start and end dates for the financial year (July of previous year to June of current year)
        $startDate = Carbon::createFromFormat('Y-m-d', date('Y') - 1 . '-07-01')->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', date('Y') . '-06-30')->endOfDay();
    
        // Retrieve transactions within the financial year
        $transactions = DB::table('vouchers')
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
    
        // Group transactions by account head code
        $groupedTransactions = $transactions->groupBy('account_head_code');
    
        // Initialize arrays to store debit and credit totals
        $debitTotals = [];
        $creditTotals = [];
    
        // Calculate debit and credit totals for each account head
        foreach ($groupedTransactions as $accountCode => $accountTransactions) {
            $debitTotals[$accountCode] = $accountTransactions->sum('debit_amount');
            $creditTotals[$accountCode] = $accountTransactions->sum('credit_amount');
        }
    
        // Calculate balances for each account head
        $trialBalance = [];
        foreach ($debitTotals as $accountCode => $debitTotal) {
            $creditTotal = $creditTotals[$accountCode] ?? 0;
            $balance = $debitTotal - $creditTotal;
    
            // Optionally, you can fetch the account name from your database here
            $accountName = DB::table('acc_coa')->where('HeadCode', $accountCode)->value('HeadName');
    
            // Add account details to trial balance array
            $trialBalance[] = [
                'account_code' => $accountCode,
                'account_name' => $accountName ?? 'Unknown', // Fallback to 'Unknown' if account name not found
                'debit_total' => $debitTotal,
                'credit_total' => $creditTotal,
                'balance' => $balance,
            ];
        }
    
        // Optionally, you can sort the trial balance array by account code or account name
    
        // Now, you can return the trial balance array or pass it to a view for rendering
        return $trialBalance;
    }
}
