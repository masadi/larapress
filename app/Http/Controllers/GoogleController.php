<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $saveUser = User::updateOrCreate(
            [
                'email' => $user->email,
            ],
            [
                'google_id'=> $user->id,
                'name' => $user->name,
                'password' => encrypt('123456dummy')
            ]
        );
        Auth::loginUsingId($saveUser->id);
        $finduser = User::where('google_id', $user->id)->first();
        return redirect()->intended('dashboard');
        try {
            
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
