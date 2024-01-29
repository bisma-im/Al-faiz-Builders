<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function showUsers(){
        $users = DB::table('user')->get();
        return view('pages.users', ['data' => $users]);
    }

    public function showAddUserForm($id = null) {
        $userData = null;
        if ($id) {
            $userData = DB::table('user')->where('id', $id)->first();
            // Handle case if user is not found
        }
        return view('pages.add-user', ['userData' => $userData]);
    }

    public function getUserData(Request $req){
        $userData = [
            'full_name' => $req->input('full_name'),
            'username' => $req->input('username'),
            'email' => $req->input('email'),
            'password' => $req->input('password'), // Remember to hash passwords
            'mobile_no' => $req->input('mobile_no'),
            'user_access_level' => $req->input('user_access_level'),
        ];
        
        // Set default avatar only when adding a new user
        if (!$req->input('id')) {
            $userData['user_image'] = 'default.jpg';
        }
    
        if ($req->hasFile('avatar')) {
            $avatar = $req->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $destinationPath = public_path('images/user-avatars');
            $avatar->move($destinationPath, $avatarName);
            $userData['user_image'] = $avatarName;
        }
        
        return $userData;
    }
    
    public function addUser(Request $req){
        $userData = $this->getUserData($req);
        try 
        {   if(DB::table('user')->where('email', $userData['email'])->first())
            {
                return response()->json(['error' => 'Account already exists']);
            }
            else
            {
                $inserted = DB::table('user')->insert($userData);
                return response()->json(['success' => 'User added successfully']);
            }
            
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateUser(Request $req) {
        $userData = $this->getUserData($req);
        $id = $req->input('id'); // Get the user ID from the request
        try {
            $updated = DB::table('user')
                ->where('id', $id)
                ->update($userData);
    
            if ($updated) {
                return response()->json(['success' => 'User updated successfully']);
            } else {
                return response()->json(['error' => 'User not found or update failed'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    
    public function deleteUser(Request $req) {
        $id = $req->input('id');
        try {
            // The delete method is called directly on the query builder
            $deleted = DB::table('user')
                ->where('id', $id)
                ->delete();
    
            if ($deleted) {
                return new JsonResponse(['success' => 'User deleted successfully'], 200);
            } else {
                return new JsonResponse(['error' => 'User not found or could not be deleted'], 404);
            }
        } 
        catch (\Exception $e) 
        {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }    
}
