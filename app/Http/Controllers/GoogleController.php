<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();
            // dd($googleUser);

            // $finduser = User::where('google_id', $googleUser->id)->first();
            $findemail = User::where('email', $googleUser->email)->first();

            // dd($finduser);
            if ($findemail) {
                $findemail->update([
                    'google_id' => $googleUser->id,
                    // 'name' => $googleUser->name,
                    'username' => $googleUser->name,
                    'google_token' => $googleUser->token,
                    'google_id' => $googleUser->id,
                    // 'avatar' => $googleUser->avatar,
                    'auth_type' => 'google',
                ]);
                Auth::login($findemail);
                return redirect()->intended('/');
            } else {
                $data = [
                    'google_id' => $googleUser->id,
                    'name' => $googleUser->name,
                    'username' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_token' => $googleUser->token,
                    'avatar' => 'default.jpg',
                    'auth_type' => 'google',
                    'password' => 'loginaja',
                ];
                $data['password'] = Hash::make($data['password']);

                $newUser = User::create($data);

                Auth::login($newUser);

                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}

// $googleUser = Socialite::driver('google')->user();
// $user = User::updateOrCreate([
//     'google_id' => $googleUser->id,
// ], [
//     'name' => $googleUser->name,
//     'username' => $googleUser->name,
//     'email' => $googleUser->email,
//     'google_token' => $googleUser->token,
//     'avatar' => $googleUser->avatar,
//     'auth_type' => 'google',
//     'password' => 'loremcuy',
// ]);

// Auth::login($user);

// return redirect('/dashboard');