<?php namespace AppAuth\Auth\Controllers;

use RainLab\User\Models\User;
use RainLab\User\Facades\Auth;
use Illuminate\Http\Request;
use ApplicationException;

class AuthController
{

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        
        // Attempt login
        if ($user = Auth::attempt($credentials, true)) {
            return response()->json(['message' => 'Login successful', 'user' => $user]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function register(Request $request)
    {
        $data = $request->only(['email', 'password', 'first_name', 'last_name']);
        
        // Create user with the RainLab.User plugin
        $user = Auth::register($data, true);

        return response()->json(['message' => 'Registration successful', 'user' => $user]);
    }
}
