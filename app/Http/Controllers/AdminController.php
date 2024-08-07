<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{

    public function viewDashboard()
    {
        $phases = DB::table('phase')
                    ->join('projects as pr', 'pr.id', '=', 'phase.project_id') // Assuming the correct column is project_id
                    ->leftJoin('plots_inventory as pi', 'pi.phase_id', '=', 'phase.id')
                    ->leftJoin('booking as b', 'b.phase_id', '=', 'phase.id')
                    ->select(
                        'pr.project_title',
                        'phase.phase_title', 'phase.id', 'phase.project_id',
                        DB::raw('COUNT(DISTINCT pi.id) as total_plots'),
                        DB::raw('COUNT(DISTINCT b.plot_id) as booked_plots')
                    )
                    ->groupBy('phase.id', 'pr.project_title', 'phase.phase_title', 'phase.project_id')
                    ->get();
        $colors = ['#32BFAF', '#f74d89', '#e95ecd', '#2596be'];
        return view('dashboards.index', compact('phases', 'colors'));
    }

    public function accessRightsTable()
    {
        $userData = DB::table('user')->get(['id','username', 'invoicing', 'booking', 'leads', 'accounting']);
        return view('pages.access-rights', compact('userData'));
    }

    public function saveAccessRights(Request $request)
    {
        $userData = $request->input('userData', []);
        // dd($userData);
        try
        {
            foreach ($userData as $id => $permissions) 
            {
                $newValues = [
                    'invoicing' => isset($permissions['invoicing']) && $permissions['invoicing'] == "on" ? 1 : 0,
                    'booking' => isset($permissions['booking']) && $permissions['booking'] == "on" ? 1 : 0,
                    'leads' => isset($permissions['leads']) && $permissions['leads'] == "on" ? 1 : 0,
                    'accounting' => isset($permissions['accounting']) && $permissions['accounting'] == "on" ? 1 : 0,
                    'updated_at' => now(),
                ];
                DB::table('user') 
                    ->where('id', $id)
                    ->update($newValues);
            }
            return redirect()->to('/')->with('success', 'Permissions updated successfully');
        } 
        catch (\Exception $e) 
        {
            return back()->with('error', 'Error updating permissions.');
        }
    }

    public function signInAuth(Request $req){
        $email= $req->input('email');
        $password= $req->input('password');

        try {
            $user = DB::table('user')
                ->where('email', $email)
                ->where('password', $password)
                ->first();
            if ($user) {
                $permissions =[];
                if($user->invoicing == 1)
                {
                    $permissions[] = 'invoicing';
                } 
                if($user->users == 1)
                {
                    $permissions[] = 'users';
                } 
                if($user->projects == 1)
                {
                    $permissions[] = 'projects';
                } 
                if($user->booking == 1)
                {
                    $permissions[] = 'booking';
                } 
                if($user->leads == 1)
                {
                    $permissions[] = 'leads';
                } 
                if($user->accounting == 1)
                {
                    $permissions[] = 'accounting';
                }
                session(['userId' => $user->id, 'full_name' => $user->full_name, 'user_image' => $user->user_image, 'email' => $user->email, 'username' => $user->username, 'permissions' => $permissions, 'role' => $user->user_access_level, 'authenticated' => TRUE]);
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
        $username = $req->session()->get('username');
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
        $user = DB::table('user')->where('username', $username)->first();
    
        // Check if current password matches
        if ($currentPassword !== $user->password) {
            return response()->json(['error' => 'Current password is incorrect'], 400);
        }
    
        // All checks passed, update the password
        DB::table('user')
            ->where('username', $username)
            ->update(['password' =>  $newPassword, 'updated_at' => now()]);
    
        return response()->json(['success' => 'Password changed successfully']);
    }
}
