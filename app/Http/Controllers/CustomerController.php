<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function showCustomers(Request $req){
        $sessionUsername = $req->session()->get('username');
        $sessionRole = $req->session()->get('role');

        if ($sessionRole == 'admin') {
            $customers = DB::table('customer')->get();
            return view('pages.customers', ['data' => $customers]);
        } else if (in_array('booking', session('permissions', [])) || $sessionRole == 'dealer') {
            $customers = DB::table('customer')->where('created_by', $sessionUsername)->get();
            return view('pages.customers', ['data' => $customers]);
        } else {
            return redirect()->back();
        }
    }

    public function showCustomerDetailsForm(Request $req, $id = null) {
        $sessionRole = $req->session()->get('role');
        $sessionUsername = $req->session()->get('username');
        $customerData = null;
        $isAdmin = 'n';
        if ($id && $sessionRole !== 'admin') {
            $customerData = DB::table('customer')->where('id', $id)->where('created_by', $sessionUsername)->first();
            if(!$customerData){
                return redirect()->back();
            }
        } else if($id  && $sessionRole === 'admin') {
            $isAdmin = 'y';
            $customerData = DB::table('customer')->where('id', $id)->first();
        }
        return view('pages.customer-details', ['customerData' => $customerData, 'isAdmin' => $isAdmin]);
    }

    public function getCustomerData(Request $req){
        $customerData = [
            'name' => $req->input('full_name'),
            'address' => $req->input('address'),
            'area' => $req->input('area'),
            'city' => $req->input('city'),
            'country' => $req->input('country'),
            'mobile_number_1' => $req->input('mobile_no_1'),
            'mobile_number_2' => $req->input('mobile_no_2'),
            'landline_number' => $req->input('landline'),
            'office_phone' => $req->input('office_phone'),
            'cnic_number' => $req->input('cnic'),
            'next_of_kin_name' => $req->input('nok_name'),
            'next_of_kin_relation' => $req->input('nok_relation'),
            'next_of_kin_address' => $req->input('nok_address'),
            'next_of_kin_area' => $req->input('nok_area'),
            'next_of_kin_city' => $req->input('nok_city'),
            'next_of_kin_country' => $req->input('nok_country'),
            'next_of_kin_mobile_number_1' => $req->input('nok_mobile_no_1'),
            'next_of_kin_mobile_number_2' => $req->input('nok_mobile_no_2'),
            'next_of_kin_landline_number' => $req->input('nok_landline'),
            'next_of_kin_cnic' => $req->input('nok_cnic'),
            'created_by' => session()->get('username'),
            ];

        if (!$req->input('id')) {
            $customerData['customer_image'] = 'blank.png';
            $customerData['customer_cnic_image'] = 'blank.png';
            $customerData['nok_cnic_image'] = 'blank.png';
            $customerData['thumb_impression'] = 'blank.png';
        }
        
        if ($req->hasFile('avatar')) {
            $avatar = $req->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $destinationPath = public_path('images/customer-images');
            $avatar->move($destinationPath, $avatarName);
            $customerData['customer_image'] = $avatarName;
        } else if ($req->input('existing_customer_image') != 'default.svg' && !$req->hasFile('avatar')) {
            $customerData['customer_image'] = $req->input('existing_customer_image');
        }

        if ($req->hasFile('cnic_image')) {
            $cnicImage = $req->file('cnic_image');
            $cnicImageName = time() . '.' . $cnicImage->getClientOriginalExtension();
            $destinationPath = public_path('images/customer/customer-cnic');
            $cnicImage->move($destinationPath, $cnicImageName);
            $customerData['customer_cnic_image'] = $cnicImageName;
        } else if ($req->input('existing_cnic_image') != 'blank.png' && !$req->hasFile('cnic_image')) {
            $customerData['customer_cnic_image'] = $req->input('existing_cnic_image');
        }

        if ($req->hasFile('nok_cnic_image')) {
            $cnicImage = $req->file('nok_cnic_image');
            $cnicImageName = time() . '.' . $cnicImage->getClientOriginalExtension();
            $destinationPath = public_path('images/customer/nok-cnic');
            $cnicImage->move($destinationPath, $cnicImageName);
            $customerData['nok_cnic_image'] = $cnicImageName;
        } else if ($req->input('existing_nok_cnic_image') != 'blank.png' && !$req->hasFile('nok_cnic_image')) {
            $customerData['nok_cnic_image'] = $req->input('existing_nok_cnic_image');
        }

        if ($req->hasFile('thumb_impression')) {
            $thumbImpression = $req->file('thumb_impression');
            $imageName = time() . '.' . $thumbImpression->getClientOriginalExtension();
            $destinationPath = public_path('images/customer/thumb-impression');
            $thumbImpression->move($destinationPath, $imageName);
            $customerData['thumb_impression'] = $imageName;
        } else if ($req->input('existing_thumb_impression') != 'blank.png' && !$req->hasFile('thumb_impression')) {
            $customerData['thumb_impression'] = $req->input('existing_thumb_impression');
        } 
        
        return $customerData;
    }
    public function addCustomer(Request $req){
        $customerData = $this->getCustomerData($req);
    
        try
        {
            $inserted = DB::table('customer')->insert($customerData);
            return response()->json(['success' => 'Customer added successfully']);
        }
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function updateCustomer(Request $req) {
        $customerData = $this->getCustomerData($req);
        $id = $req->input('id'); // Get the customer ID from the request
    
        $updated = DB::table('customer')
            ->where('id', $id)
            ->update($customerData);
    
        if ($updated) {
            return response()->json(['success' => 'Customer updated successfully']);
        } else {
            return response()->json(['error' => 'Customer not found or update failed'], 404);
        }
    }
    
    public function deleteCustomer(Request $req) {
        $id = $req->input('id'); // Get the customer ID from the request
    
        try{

            $customer = DB::table('customer')->where('id', $id)->first();
            $avatar = $customer->customer_image;
            if($avatar && $avatar != 'blank.png')
            {
                $avatarPath = public_path('images/customer-images/' . $avatar);
                if(file_exists($avatarPath))
                {
                    unlink($avatarPath);
                }
            }

            $deleted = DB::table('customer')
                ->where('id', $id)
                ->delete();
        
            if ($deleted) {
                return new JsonResponse(['success' => 'Customer deleted successfully'], 200);
            } else {
                return new JsonResponse(['error' => 'Customer not found or could not be deleted'], 404);
            }
        } catch (\Exception $e) 
        {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    public function verifyCustomer(Request $req)
    {
        $cnic = $req->input('customer_cnic');
        $name = $req->input('customer_name');

        try
        {
            $customer = DB::table('customer')
                        ->where('cnic_number', $cnic)
                        ->where('name', $name)
                        ->first();

            if (!$customer) 
            {
                return response()->json(['error' => 'Customer not found'], 404);
            }

            $plotNum = DB::table('booking')
                        ->join('plots_inventory as pl', 'pl.id','=','booking.plot_id')
                        ->select('pl.plot_no', 'pl.id')
                        ->where('customer_id', $customer->id)
                        ->get();  
                        
            if ($plotNum->isEmpty()) 
            {
                return redirect()->back();
            }
            return view('pages.booking-verification', compact('cnic','name','plotNum'));
        }
        catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function showBookingVerificationForm()
    {
        $plotNum = $cnic = $name = null;
        return view('pages.booking-verification', compact('cnic','name','plotNum'));
    }
}
