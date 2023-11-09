<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Make sure to include the User model

class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = User::all(); // Retrieve all users from the 'users' table

        return view('users', ['users' => $users]);
    }

    public function addUser(Request $req)
    {
        // Validate the input data
        $validatedData = $req->validate([
            'userId' => 'required',
            'name' => 'required',
            'pass' => 'required|min:6|max:24',
            'email' => 'required|email',
            'contact_no' => 'required',
            'role' => 'required',
        ]);

        // Create a new user with the validated data
        $user = new User();
        $user->userId = $validatedData['userId'];
        $user->name = $validatedData['name'];
        $user->pass = $validatedData['pass'];
        $user->email = $validatedData['email'];
        $user->contact_no = $validatedData['contact_no'];
        $user->role = $validatedData['role'];

        // Add any other user attributes as needed

        $user->save();

        // Redirect to a success page or return a response
        return redirect()->route('admin/users')->with('success', 'User added successfully');
    }

    public function editUser(Request $request, $userId)
    {
       
        // Find the user by their ID
        $user = User::find($userId);
            
        if (!$user) {
            // Handle the case where the user doesn't exist
            return redirect()->route('admin/users')->with('error', 'User not found');
        }

        // Now that you have fetched the user data, you can proceed to update it.
        // Update the user attributes based on the form input
        $user->name = $request->input('name');
        $user->pass = $request->input('pass');
        $user->email = $request->input('email');
        $user->contact_no = $request->input('contact_no');
        $user->role = $request->input('role');
        // Add similar lines for other fields you want to edit

        // Save the changes
        $user->save();

        return redirect()->route('admin/users')->with('success', 'User updated successfully');
    }

    public function deleteUser($userId)
    {
        // Find the user by their ID
        $user = User::find($userId);

        if ($user) {
            // Delete the user
            $user->delete();
            return redirect()->route('admin/users')->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('admin/users')->with('error', 'User not found');
        }
    }
}