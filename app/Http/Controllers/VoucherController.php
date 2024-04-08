<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\DateTime;
use Barryvdh\DomPDF\Facade\Pdf;

class VoucherController extends Controller
{
    public function showVoucherForm(Request $req){
        $accounts = DB::table('acc_coa')->get();
        $voucherType = $req->input('voucher_type');
        return view('pages.voucher-form', compact('accounts','voucherType'));
    }

    public function showVouchers(Request $request){
        try {
            $startDate = Carbon::createFromFormat('d M Y', $request->input('startDate'))->format('Y-m-d');
        } catch (\Exception $e) {
            $startDate = Carbon::today()->format('Y-m-d');
        }
    
        try {
            $endDate = Carbon::createFromFormat('d M Y', $request->input('endDate'))->format('Y-m-d');
        } catch (\Exception $e) {
            $endDate = Carbon::today()->format('Y-m-d');
        }

        $voucherData = DB::table('voucher')
                        ->select('id', 'voucher_id', 'date', 'description', 'debit_amount', 'added_by', 'voucher_type')
                        ->where('date', '>=', $startDate)
                        ->where('date', '<=', $endDate)
                        ->orderBy('id', 'asc')
                        ->get()
                        ->unique('voucher_id');

        if($request->ajax()) {
            return view('partials.voucher_row', compact('voucherData'))->render();
        } else {
            return view('pages.vouchers', compact('voucherData'));
        }
    }

    public function exportVouchers(Request $request){
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $startDate = Carbon::createFromFormat('d M Y', $fromDate)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d M Y', $toDate)->format('Y-m-d');
        
        $vouchers = DB::table('voucher')
            ->join('acc_coa', 'acc_coa.HeadCode', '=', 'voucher.account_code')
            ->select(
                'voucher.*', 
                'acc_coa.HeadName')
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
            ->orderBy('voucher.id', 'asc')
            ->get();
        $data = [
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'vouchers' => $vouchers
        ];
        $pdf = Pdf::loadView('pages.export-vouchers-pdf', $data)->setPaper('a4', 'landscape');
        return $pdf->download('vouchers-list.pdf');
    }

    public function getVoucher($safeVoucherId){
        $voucherId = str_replace('-', '/', $safeVoucherId);
        $voucher = DB::table('voucher')
        ->join('acc_coa', 'acc_coa.HeadCode', '=', 'voucher.account_code')
        ->select(
            'voucher.*', 
            'acc_coa.HeadName')
        ->where('voucher_id', $voucherId)
        ->orderBy('voucher.id', 'asc')
        ->get();
        return response()->json([
            'success' => true,
            'data' => $voucher,
        ]);
    }

    public function voucherPdf(Request $req){
        $voucherId = $req->input('voucher_id');
        $voucherData = DB::table('voucher')->where('voucher_id', $voucherId)->get();
        $totals = DB::table('voucher')
                    ->selectRaw('SUM(debit_amount) as totalDebitAmount, SUM(credit_amount) as totalCreditAmount')
                    ->where('voucher_id', $voucherId)
                    ->first();
        return view('pages.voucher-pdf', compact('voucherData', 'voucherId', 'totals'));
    }

    public function downloadVoucher(){
        $voucherId = '2024/3/9';
        $voucherData = DB::table('voucher')->where('voucher_id', $voucherId)->get();
        $totals = DB::table('voucher')
                    ->selectRaw('SUM(debit_amount) as totalDebitAmount, SUM(credit_amount) as totalCreditAmount')
                    ->where('voucher_id', $voucherId)
                    ->first();
        $data = [
        'voucherData' => $voucherData,
        'voucherId' => $voucherId,
        'totals' => $totals
        ];
        $pdf = Pdf::loadView('pages.voucher-pdf', $data);
        return $pdf->download('voucher.pdf');
    }

    public function getVoucherData(Request $req){
        $voucherDate = Carbon::createFromFormat('Y-m-d', $req->input('voucher_date'));
        $voucherData = [
            'date' => $voucherDate->toDateString(),
            'account_code' => $req->input('debit_account_code'),
            'debit_amount' => $req->input('amount'),
            'description' => $req->input('description'),
            'added_by' => session()->get('username'),
            'added_on' => now(),
            'updated_on' => now(),
        ];

        return $voucherData;
    }

    public function calculateNewBalance($voucherData){
        $headType = $currentBalance = null;
        $row = DB::table('voucher')
                ->select('balance')
                ->where('account_code', $voucherData['account_code'])
                ->orderBy('id', 'desc')
                ->first();
        if ($row) {
            $currentBalance = $row->balance;
            $accTypeRow = DB::table('acc_coa')
                        ->select('HeadType')
                        ->where('HeadCode', $voucherData['account_code'])
                        ->first();
            $headType = $accTypeRow->HeadType;
        } 
        else {
            $openingBalanceRow = DB::table('acc_coa')
                                ->select('opening_balance', 'HeadType')
                                ->where('HeadCode', $voucherData['account_code'])
                                ->first();
            $headType = $openingBalanceRow->HeadType;
            $currentBalance = $openingBalanceRow ? $openingBalanceRow->opening_balance : 0;
        }
        $transactionDebitAmount = $voucherData['debit_amount'] ?? 0;
        $transactionCreditAmount = $voucherData['credit_amount'] ?? 0;
        switch ($headType) {
            case 'A': // Asset
            case 'E': // Expense
                $newBalance = $currentBalance + $transactionDebitAmount - $transactionCreditAmount;
                break;
            
            case 'L': // Liability
            case 'C': // Capital
            case 'I': // Income
                $newBalance = $currentBalance - $transactionDebitAmount + $transactionCreditAmount;
                break;
            
            // Add cases for other HeadTypes if necessary
            
            default:
                // Handle unexpected HeadType
                throw new Exception("Unknown HeadType: $headType");
        }
        return $newBalance;
    }
    
    public function addVoucher(Request $req){
        $voucherData = $this->getVoucherData($req);
        $today = Carbon::now();
        $currentYearMonth = $today->year . '/' . $today->month;
        $newBalance = $this->calculateNewBalance($voucherData);
        $voucherData['balance'] = $newBalance;
        
        DB::beginTransaction();
        try{
            $id = DB::table('voucher')->insertGetId($voucherData);
            if ($req->hasFile('voucher_media')) {
                foreach ($req->file('voucher_media') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = public_path('images/voucher-media');
                    $file->move($filePath, $filename);

                    DB::table('voucher_media')->insert([
                        'voucher_id' => $id,
                        'media_name' => $filename,
                    ]);
                }
            }
            $voucherId = $currentYearMonth . '/' . $id;
            $voucherType = $req->input('voucher_type');
            $voucherIdAndType= [
                'voucher_id' => $voucherId,
                'voucher_type' => $voucherType,
            ];
            DB::table('voucher')
                ->where('id', $id)
                ->update($voucherIdAndType);

            $voucherData = array_merge($voucherIdAndType, $voucherData);
            $voucherData['account_code'] = $req->input('credit_account_code');
            $voucherData['credit_amount'] = $voucherData['debit_amount'];
            $voucherData['debit_amount'] = null;
            $newBalance = $this->calculateNewBalance($voucherData);
            $voucherData['balance'] = $newBalance;
            DB::table('voucher')->insert($voucherData);
            DB::commit();
            return response()->json(['success' => 'Voucher added successfully']);
        }
        catch (\Exception $e) 
        {   
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
