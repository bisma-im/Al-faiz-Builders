<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\DateTime;

class VoucherController extends Controller
{
    public function showVoucherForm(Request $req){
        $accounts = DB::table('acc_coa')->get();
        $voucherType = $req->input('voucher_type');
        return view('pages.voucher-form', compact('accounts','voucherType'));
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

    public function getTransactionData(Request $req){
        $transactionData = [

        ];
        return $transactionData;
    }

    public function addVoucher(Request $req){
        $voucherData = $this->getVoucherData($req);
        $today = Carbon::now();
        $currentYearMonth = $today->year . '/' . $today->month;
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
