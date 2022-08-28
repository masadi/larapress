<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class FaceBookController extends Controller
{
    public function loginUsingFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook()
    {
        $user = Socialite::driver('facebook')->user();
        $saveUser = User::updateOrCreate(
            [
                'email' => $user->getEmail(),
            ],
            [
                'facebook_id' => $user->getId(),
                'name' => $user->getName(),
                'password' => encrypt('123456dummy')
            ]
        );
        Auth::loginUsingId($saveUser->id);
        return redirect()->intended('dashboard');
        try {
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
