<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function signInAuth(Request $req){
        $email= $req->input('email');
        $password= $req->input('password');

        try {
            $user = DB::table('user')
                ->where('email', $email)
                ->where('password', $password)
                ->first();
            if ($user) {
                session(['userId' => $user->id, 'email' => $user->email, 'authenticated' => TRUE]);
                return response()->json(['success' => 'Logged in successfully']);
            } else {
                return response()->json(['error' => 'Invalid credentials']);
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

    public function changePassword(Request $req){
        $email = $req->session()->get('email');
        $currentPassword = $req->input('current_password');
        $newPassword = $req->input('new_password');
        $confirmPassword = $req->input('confirm_password');

        if ($newPassword !== $confirmPassword) {
            return response()->json(['error' => 'New password and confirm password do not match'], 400);
        }
    
        // Check for password strength
        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $newPassword)) {
            return response()->json(['error' => 'Password must be at least 8 characters long and include at least one special character'], 400);
        }
    
        // Fetch user from database
        $user = DB::table('user')->where('email', $email)->first();
    
        // Check if current password matches
        if ($currentPassword !== $user->password) {
            return response()->json(['error' => 'Current password is incorrect'], 400);
        }
    
        // All checks passed, update the password
        DB::table('user')
            ->where('email', $email)
            ->update(['password' =>  $newPassword]);
    
        return response()->json(['success' => 'Password changed successfully']);
    }
}
