<?php

namespace App\Http\Controllers;

use Exception;
use NumberToWords\NumberToWords;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\DateTime;
use Barryvdh\DomPDF\Facade\Pdf;

class VoucherController extends Controller
{
    public function showVoucherForm(Request $req)
    {
        $accounts = DB::table('chart_of_accounts')->where('Level', 3)->get();
        $voucherType = $req->input('voucher_type');
        return view('pages.voucher-form', compact('accounts', 'voucherType'));
    }

    public function showVouchers(Request $request)
    {
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

        if ($request->ajax()) {
            return view('partials.voucher_row', compact('voucherData'))->render();
        } else {
            return view('pages.vouchers', compact('voucherData'));
        }
    }

    public function exportVouchers(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $startDate = Carbon::createFromFormat('d M Y', $fromDate)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d M Y', $toDate)->format('Y-m-d');

        $vouchers = DB::table('voucher')
            ->join('chart_of_accounts', 'chart_of_accounts.Account_Code', '=', 'voucher.account_code')
            ->select(
                'voucher.*',
                'chart_of_accounts.Account_Title'
            )
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

    public function getVoucher($safeVoucherId)
    {
        $voucherId = str_replace('-', '/', $safeVoucherId);
        $voucher = DB::table('voucher')
            ->join('chart_of_accounts', 'chart_of_accounts.Account_Code', '=', 'voucher.account_code')
            ->select(
                'voucher.*',
                'chart_of_accounts.Account_Title'
            )
            ->where('voucher_id', $voucherId)
            ->orderBy('voucher.id', 'asc')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $voucher,
        ]);
    }

    public function downloadVoucher(Request $req)
    {
        $voucherId = $req->input('voucher_id');
        $voucherData = DB::table('voucher')
            ->join('chart_of_accounts', 'chart_of_accounts.Account_Code', '=', 'voucher.account_code')
            ->select('voucher.*', 'chart_of_accounts.Account_Title')
            ->where('voucher_id', $voucherId)->get();

        $totals = DB::table('voucher')
            ->selectRaw('SUM(debit_amount) as totalDebitAmount, SUM(credit_amount) as totalCreditAmount')
            ->where('voucher_id', $voucherId)
            ->first();

        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        $amountInWords = $numberTransformer->toWords($totals->totalDebitAmount);
        $amountInWords = ucwords($amountInWords);

        // Determine payee based on voucher type
        $payee = null;
        foreach ($voucherData as $entry) {
            if ($entry->voucher_type == 'CPV' || $entry->voucher_type == 'BPV') {
                if ($entry->debit_amount > 0) {
                    $payee = $entry->Account_Title;  // Assuming account_code stores the payee account information
                }
            } elseif ($entry->voucher_type == 'CRV' || $entry->voucher_type == 'BRV') {
                if ($entry->credit_amount > 0) {
                    $payee = $entry->Account_Title;  // The payer who made the deposit
                }
            }
        }

        $imageData = base64_encode(file_get_contents(public_path('assets/media/logos/alfaizbuilders-logo-e1712263164161-1024x613.jpg')));
        $imageSrc = 'data:image/png;base64,' . $imageData;
        $data = [
            'voucherData' => $voucherData,
            'voucherId' => $voucherId,
            'totals' => $totals,
            'amountInWords' => $amountInWords,
            'imageSrc' => $imageSrc,
            'payee' => $payee
        ];

        $pdf = Pdf::loadView('pages.voucher-pdf', $data);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('voucher.pdf');
    }

    public function getVoucherData(Request $req, $voucherType)
    {
        $voucherDate = Carbon::createFromFormat('Y-m-d', $req->input('voucher_date'));
        $chequeNum = null;
        $drawnOnBank =0;
        if ($voucherType === 'BPV' || $voucherType === 'BRV') {
            $chequeNum = $req->input('cheque_no');
            $drawnOnBank =$req->input('drawn_on_bank');
        }
        // dd($drawnOnBank);
        $voucherData = [
            'date' => $voucherDate->toDateString(),
            'account_code' => $req->input('debit_account_code'),
            'debit_amount' => $req->input('amount'),
            'description' => $req->input('description'),
            'cheque_no' => $chequeNum,
            'drawn_on_bank' => $drawnOnBank,
            'added_by' => session()->get('username'),
            'added_on' => now(),
            'updated_on' => now(),
        ];

        return $voucherData;
    }

    public function calculateNewBalance($voucherData)
    {
        $currentBalance = null;
        $accountCodePrefix = substr($voucherData['account_code'], 0, 1);
        $row = DB::table('voucher')
            ->select('balance')
            ->where('account_code', $voucherData['account_code'])
            ->orderBy('id', 'desc')
            ->first();
        if ($row) {
            $currentBalance = $row->balance;
        } else {
            $openingBalanceRow = DB::table('chart_of_accounts')
                ->select('opening_balance')
                ->where('Account_Code', $voucherData['account_code'])
                ->first();
            $currentBalance = $openingBalanceRow->opening_balance ?? 0;
        }

        $transactionDebitAmount = $voucherData['debit_amount'] ?? 0;
        $transactionCreditAmount = $voucherData['credit_amount'] ?? 0;
        switch ($accountCodePrefix) {
            case '1': // Asset
            case '5': // Expense
                $newBalance = $currentBalance + $transactionDebitAmount - $transactionCreditAmount;
                break;

            case '2': // Liability
            case '3': // Capital
            case '4': // Income
                if ($voucherData['account_code'] == '4-001-002') {
                    $newBalance = $currentBalance + $transactionDebitAmount - $transactionCreditAmount;
                } else { // Purchases and Wastage Recycling
                    $newBalance = $currentBalance - $transactionDebitAmount + $transactionCreditAmount;
                }
                break;

            case '6':
                if ($voucherData['account_code'] == '6-001-002') {
                    $newBalance = $currentBalance - $transactionDebitAmount + $transactionCreditAmount;
                } else { // Purchases and Wastage Recycling
                    $newBalance = $currentBalance + $transactionDebitAmount - $transactionCreditAmount;
                }
                break;

                // Add cases for other HeadTypes if necessary
            default:
                // Handle unexpected HeadType
                throw new Exception("Unknown HeadType: $accountCodePrefix");
        }
        return $newBalance;
    }

    public function addVoucher(Request $req)
    {
        $voucherType = $req->input('voucher_type');
        $voucherData = $this->getVoucherData($req, $voucherType);
        // dd($voucherData);
        $today = Carbon::now();
        $currentYearMonth = $today->year . '/' . $today->month;
        $newBalance = $this->calculateNewBalance($voucherData);
        $voucherData['balance'] = $newBalance;

        DB::beginTransaction();
        try {
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
            $voucherId = $voucherType . '/' . $currentYearMonth . '/' . $id;
            $voucherIdAndType = [
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
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
