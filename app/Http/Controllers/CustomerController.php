<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function showCustomers(){
        $customers = DB::table('customer')->get();
        return view('pages.customers', ['data' => $customers]);
    }

    public function showCustomerDetailsForm($id = null) {
        $customerData = null;
        if ($id) {
            $customerData = DB::table('customer')->where('id', $id)->first();
            // Handle case if user is not found
        }
        return view('pages.customer-details', ['customerData' => $customerData]);
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
            ];

        if (!$req->input('id')) {
            $customerData['customer_image'] = 'default.jpg';
        }
        
        if ($req->hasFile('avatar')) {
            $avatar = $req->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $destinationPath = public_path('images/customer-images');
            $avatar->move($destinationPath, $avatarName);
            $customerData['customer_image'] = $avatarName;
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
            if($avatar && $avatar != 'default.jpg')
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
}
