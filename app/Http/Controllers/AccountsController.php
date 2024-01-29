<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AccountsController extends Controller
{
    public function getAccountData(Request $req){
        $accountData = [
            'account_head_id' => $req->input('account_head_id'),
            'account_title' => $req->input('account_title'),
        ];
        
        return $accountData;
    }
    public function addAccount(Request $req){
        $accountData = $this->getAccountData($req);
        try 
        {   
            $inserted = DB::table('accounts')->insert($accountData);
            
            return response()->json(['success' => 'Account added successfully']);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
