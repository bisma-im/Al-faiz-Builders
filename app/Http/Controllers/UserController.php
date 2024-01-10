<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // public function showUsers(){
    //     // Retrieve all users from the database
    //     $users = DB::table('user')->get();
    //     return view('pages.users', ['data' => $users]);
    // }

    public function addUser(Request $req){

        $firstName = $req->input('fname');
        $lastName = $req->input('lname');
        $fullName = $firstName . ' ' . $lastName; // Concatenating first name and last name
        $username = $req->input('username');
        $email = $req->input('email');
        $password = $req->input('password');
        $mobileNo = $req->input('mobile_no');
        $userAccessLevel = $req->input('user_access_level');
        $avatarName = 'default.jpg'; // Default avatar name if no file is uploaded

    // Handle the avatar upload
    if ($req->hasFile('avatar')) {
        $avatar = $req->file('avatar');
        $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
        $destinationPath = public_path('images/user-avatars'); // Set the destination path
        $avatar->move($destinationPath, $avatarName); // Move the file to the new directory
        $avatarName = 'user-avatars/' . $avatarName; // Prepare the path to save in database
    }

    try {
        // Insert data into database
        $inserted = DB::table('user')->insert([
            'full_name' => $fullName,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'mobile_no' => $mobileNo,
            'user_image' => $avatarName,
            'user_access_level' => $userAccessLevel,
        ]);

        return response()->json(['success' => 'User added successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    public function deleteUser(Request $req) {
        $username = $req->input('username');
        $email = $req->input('email');
    
        try {
            // The delete method is called directly on the query builder
            $deleted = DB::table('user')
                ->where('username', $username)
                ->where('email', $email)
                ->delete();
    
            if ($deleted) {
                return new JsonResponse(['success' => 'User deleted successfully'], 200);
            } else {
                return new JsonResponse(['error' => 'User not found or could not be deleted'], 404);
            }
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
    
}
