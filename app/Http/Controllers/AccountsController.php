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

    public function showAccounts(Request $request)
    {
      return view('pages.accounts');
    }

    public function getAccounts(Request $request)
    {
        // Page Length
        $pageNumber = ( $request->start / $request->length )+1;
        $pageLength = $request->length;
        $skip       = ($pageNumber-1) * $pageLength;

        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';

        // get data from products table
        $query = DB::table('chart_of_accounts')->select('*');

        // Search
        $search = $request->search;
        $query = $query->where(function($query) use ($search){
            $query->orWhere('Account_Code', 'like', "%".$search."%");
            $query->orWhere('Account_Title', 'like', "%".$search."%");
        });

        $orderByName = 'Account_Code';
        switch($orderColumnIndex){
            case '0':
                $orderByName = 'Account_Code';
                break;
            case '1':
                $orderByName = 'Account_Title';
                break;
        
        }
        $query = $query->orderBy($orderByName, $orderBy);
        $recordsFiltered = $recordsTotal = $query->count();
        $users = $query->skip($skip)->take($pageLength)->get();

        return response()->json(["draw"=> $request->draw, "recordsTotal"=> $recordsTotal, "recordsFiltered" => $recordsFiltered, 'data' => $users], 200);
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
