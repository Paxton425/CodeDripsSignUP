<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Cookie;

class AuthController extends Controller
{

    public function signIn(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return response()->json([
                'message' => 'Sign-in successful',
                'data' => $user,
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
    }
    public function signOut(Request $request)
    {
        //delete cookie
        Cookie::forget('user_cookie');

        Auth::guard('web')->logout();

        return redirect()->route('welcome');
    }

    public function signUp(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
 
        Auth::login($user);

        // Perform additional logic like sending email verification, etc.
        // ...

        // Return a response
        return response()->json([
            'message' => 'Sign-up successful',
            'data' => $user, // Replace with the user data if needed
        ]);
    }
}

