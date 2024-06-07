<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AccountsController extends Controller
{
    public function showAddAccountForm(){
        $headings = ['Assets', 'Capital', 'Liabilities', 'Revenue', 'Expenses', 'Cost of Goods Sold'];
        // dd($headings);
        $accounts = DB::table('chart_of_accounts')->where('Level', 2)->orderBy('Account_Code')->get();
        // return view('pages.add-account', compact('headings', 'accounts'));
        return view('pages.add-account', ['headings' => $headings, 'accounts' => $accounts]);
    }

    public function showAccounts(Request $req)
    {
        $accountData = DB::table('chart_of_accounts')->get();
        if($req->session()->get('role') === 'admin'){
            return view('pages.accounts', ['accountData' => $accountData]);
        }
        else{
            return redirect()->back();
        }
    }

    public function getAccountData(Request $req){
        $accountHeadId = $req->input('account_head_id');
        $accountCodeLike = $accountHeadId . '-%';
        $account = DB::table('chart_of_accounts')
                    ->where('Level', 3)
                    ->where('Account_Code', 'LIKE', $accountCodeLike)
                    ->orderBy('Account_Code', 'desc')
                    ->first();
        if ($account) {
            // Get the full account code
            $fullAccountCode = $account->Account_Code;
                
            // Calculate the length of the prefix to remove (length of accountData['account_head_id'] + 1 for the hyphen)
            $prefixLength = strlen($accountHeadId) + 1;
            
            // Remove the prefix from the full account code
            $resultingString = substr($fullAccountCode, $prefixLength);
            $num = (int) $resultingString;

            // Format the number to be always three digits
            $formattedNumber = sprintf('%03d', $num+=1 );
            $accountCode = $accountHeadId . '-' . $formattedNumber;
        }
            

        $accountData = [
            'Account_Code' => $accountCode,
            'Account_Title' => $req->input('account_title'),
            'Level' => 3,
            'General_Detail' => 'G',
            'Entry_By' => $req->session()->get('username'),
            'Entry_Date' => now(),
            'Edit_By' => $req->session()->get('role'),
            'Edit_Date' => now(),
        ];
        return $accountData;
    }
    
    public function addAccount(Request $req){
        $accountData = $this->getAccountData($req);
        try 
        {   
            $inserted = DB::table('chart_of_accounts')->insert($accountData);
            return response()->json(['success' => 'Account added successfully']);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
