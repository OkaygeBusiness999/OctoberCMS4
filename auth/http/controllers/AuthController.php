<?php namespace AppAuth\Auth\Http\Controllers;

use RainLab\User\Models\User;
use RainLab\User\Classes\AuthManager;
use Illuminate\Http\Request;
use ApplicationException;

class AuthController
{
    protected $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        try {

            $user = $this->auth->authenticate($credentials, true);
            return response()->json(['message' => 'Login successful', 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function register(Request $request)
    {
        $data = $request->only(['email', 'password', 'first_name', 'last_name']);

        $user = $this->auth->register($data, true);

        return response()->json(['message' => 'Registration successful', 'user' => $user]);
    }
}
