<?php

namespace AppAuth\Google\Controllers;

use Illuminate\Routing\Controller;
use Laravel\Socialite\Facades\Socialite;
use RainLab\User\Models\User;
use Auth;

class GoogleAuthController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Obtain the user information from Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if the user already exists
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // If user does not exist, create one
                $user = new User();
                $user->email = $googleUser->email;
                $user->first_name = $googleUser->name;
                $user->google_token = $googleUser->token;
                $user->google_refresh_token = $googleUser->refreshToken;
                $user->save();
            } else {
                // Update the existing user with the new tokens
                $user->google_token = $googleUser->token;
                $user->google_refresh_token = $googleUser->refreshToken;
                $user->save();
            }

            Auth::login($user);

            return redirect('/october_cms/backend');

        } catch (\Exception $e) {
            return redirect('/october_cms/backend/auth/signin')->with('error', 'Failed to authenticate with Google.');
        }
    }
}
