<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
class AdminController extends Controller
{
    public function signInAuth(Request $req){
        $email= $req->input('email');
        $password= $req->input('password');

        try {
            $admin = DB::table('admin')->where('email', $email)->where('password', $password)->first();
            if ($admin) {
                session(['userId' => $admin->id, 'email' => $admin->email]);
                return response()->json(['success' => 'Logged in successfully']);
            } else {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } 
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function logout(){
        session()->flush();
        return redirect()->route('signInPage');
    }
}
