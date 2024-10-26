<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class LeadController extends Controller
{
    public function showLeads(Request $req)
    {
        $sessionRole = $req->session()->get('role');
        $salesAgents = null;

        if ($sessionRole == 'sales-manager') {
            $salesAgents = DB::table('user')
                ->select('id', 'full_name')
                ->where('user_access_level', 'sales-agent')
                ->get();
        } 
        if($sessionRole == 'sales-manager' || $sessionRole == 'sales-agent' || in_array('leads', session('permissions', []))){
            return view('pages.leads', ['salesAgents' => $salesAgents]);
        } else {
            return redirect()->back();
        }
    }

    public function getLeads(Request $request)
    {
        $query = null;
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip       = ($pageNumber - 1) * $pageLength;
        $sessionUsername = $request->session()->get('username');
        $sessionRole = $request->session()->get('role');
        $sessionUserId = $request->session()->get('userId');

        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';

        if ($sessionRole == 'sales-manager') {
            $query = DB::table('leads')->where('mature', 1)->select('*');
        } else if ($sessionRole == 'sales-agent') {
            $query = DB::table('leads')->where('mature', 1)->where('transferred_to_user_id', $sessionUserId)->select('*');
        } else if (in_array('leads', session('permissions', []))) {
            $query = DB::table('leads')->where('username', $sessionUsername)->select('*');
        }

        // Search
        $search = $request->search;
        $query = $query->where(function ($query) use ($search) {
            $query->orWhere('name', 'like', "%" . $search . "%");
            $query->orWhere('mobile_number_1', 'like', "%" . $search . "%");
            $query->orWhere('landline_number_1', 'like', "%" . $search . "%");
            $query->orWhere('email', 'like', "%" . $search . "%");
            $query->orWhere('source_of_information', 'like', "%" . $search . "%");
        });

        $orderByName = 'name';
        switch ($orderColumnIndex) {
            case '0':
                $orderByName = 'name';
                break;
            case '1':
                $orderByName = 'mobile_number_1';
                break;
            case '2':
                $orderByName = 'landline_number_1';
                break;
            case '3':
                $orderByName = 'email';
                break;
            case '4':
                $orderByName = 'source_of_information';
                break;
        }
        $query = $query->orderBy($orderByName, $orderBy);
        $recordsFiltered = $recordsTotal = $query->count();
        $leads = $query->skip($skip)->take($pageLength)->get();

        return response()->json(["draw" => $request->draw, "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, 'data' => $leads], 200);
    }

    public function showLeadForm(Request $request, $id = null)
    {
        $leadData = $callLogData = null;
        $isViewMode = $request->is('leads/view/*');
        $sessionUsername = $request->session()->get('username');
        $role = $request->session()->get('role');
        $sessionUserId = $request->session()->get('userId');
        $salesAgents = DB::table('user')
            ->select('id', 'full_name')
            ->where('user_access_level', 'sales-agent')
            ->get();
        if ($id) {
            if ($role == 'sales-manager') {
                $leadData = DB::table('leads')
                    ->where('id', $id)
                    ->where('mature', 1)
                    ->first();
            } else if ($role == 'sales-agent') {
                $leadData = DB::table('leads')
                    ->where('id', $id)
                    ->where('transferred_to_user_id', $sessionUserId)
                    ->first();
            } else if (in_array('leads', session('permissions', []))) {
                $leadData = DB::table('leads')
                    ->where('id', $id)
                    ->where('username', $sessionUsername)
                    ->first();
            }

            // $callLogData = $isViewMode ? DB::table('call_logs')->where('lead_id', $id)->get() : [];
            $callLogData = DB::table('call_logs')->where('lead_id', $id)->get();
        }

        if (!$leadData && !(in_array('leads', session('permissions', [])))) {
            return redirect()->route('showLeads');
        }

        return view('pages.add-lead', compact('leadData', 'isViewMode', 'callLogData', 'salesAgents'));
    }


    public function getLeadData(Request $req)
    {
        $source_of_information = '';
        if ($req->input('source_of_information') === 'other') {
            // Combining 'Other' with user-entered text
            $source_of_information = 'Other: ' . $req->input('other_source');
        } else {
            $source_of_information = $req->input('source_of_information');
        }
        $leadData = [
            'name' => $req->input('name'),
            'mobile_number_1' => $req->input('mobile_no_1'),
            'mobile_number_2' => $req->input('mobile_no_2'),
            'landline_number_1' => $req->input('landline_no_1'),
            'landline_number_2' => $req->input('landline_no_2'),
            'email' => $req->input('email'),
            'source_of_information' => $req->input('source_of_information'),
            'details' => $req->input('details'),
            'username' => $req->input('session_username'),
        ];
        if ($req->has('mature')) {
            $leadData['mature'] = $req->input('mature') == "on" ? 1 : 0;
        }
        if ($req->has('sales_agent')) {
            $leadData['transferred_to_user_id'] = $req->input('sales_agent');
        }
        return $leadData;
    }

    public function addLead(Request $req)
    {
        $leadData = $this->getLeadData($req);
        $leadData['mature'] = 0;
        try {
            $inserted = DB::table('leads')->insert($leadData);
            return response()->json(['success' => 'Lead added successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateLead(Request $req)
    {
        $leadData = $this->getLeadData($req);
        $id = $req->input('id'); // Get the user ID from the request
        try {
            $updated = DB::table('leads')
                ->where('id', $id)
                ->update($leadData);

            if ($updated) {
                return response()->json(['success' => 'Lead updated successfully']);
            } else {
                return response()->json(['error' => 'Lead not found or update failed'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteLead(Request $req)
    {
        $id = $req->input('id');
        try {
            $deleted = DB::table('leads')
                ->where('id', $id)
                ->delete();

            if ($deleted) {
                return new JsonResponse(['success' => 'Lead deleted successfully'], 200);
            } else {
                return new JsonResponse(['error' => 'Lead not found or could not be deleted'], 404);
            }
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    public function addCallLog(Request $req)
    {
        $leadId = $req->input('id');
        $validatedData = $req->validate([
            'call_date_time' => 'required',
            'customer_response' => 'required',
            'next_call_date_time' => 'required',
        ]);

        $callDateTime = Carbon::createFromFormat('Y-m-d H:i', $req->input('call_date_time'));
        $nextCallDateTime = Carbon::createFromFormat('Y-m-d H:i', $req->input('next_call_date_time'));

        $logData = [
            'lead_id' => $leadId,
            'date_of_call' => $callDateTime->toDateString(),
            'time_of_call' => $callDateTime->toTimeString(),
            'customer_response' => $req->input('customer_response'),
            'next_call_date' => $nextCallDateTime->toDateString(),
            'next_call_time' => $nextCallDateTime->toTimeString(),
            'received_by' => $req->session()->get('full_name'),
        ];

        try {
            $inserted = DB::table('call_logs')->insert($logData);
            return response()->json(['success' => 'Call log added successfully']);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    public function importLeadsCSV(Request $request)
    {
        if (!$request->hasFile('leadsImportCSV')) {
            return response()->json(['error' => 'No file was uploaded.'], 400);
        }

        $file = $request->file('leadsImportCSV');
        if (!$file->isValid()) {
            return response()->json(['error' => 'File is not valid.'], 400);
        }
        $file = $request->file('leadsImportCSV');
        $fileContents = file($file->getPathname());
        $batchData = [];
        $isHeader = true; // Variable to check if it's the first row

        foreach ($fileContents as $line) {
            if ($isHeader) {
                // Skip the first row and then set $isHeader to false
                $isHeader = false;
                continue;
            }

            $data = str_getcsv($line);

            $batchData[] = [
                'name' => $data[0],
                'mobile_number_1' => $data[1],
                'mobile_number_2' => $data[2],
                'landline_number_1' => $data[3],
                'landline_number_2' => $data[4],
                'email' => $data[5],
                'source_of_information' => $data[6],
                'details' => $data[7],
                'username' => session()->get('username'),
                'mature' => 0,
            ];
        }

        try {
            DB::beginTransaction();
            DB::table('leads')->insert($batchData);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'CSV file imported successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
