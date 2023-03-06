<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }
    public function callback()
    {
        try {

            $githubUser = Socialite::driver('github')->user();
            // dd($githubUser);

            // $finduser = User::where('github_id', $githubUser->id)->first();
            $findemail = User::where('email', $githubUser->email)->first();


            // dd($findemail);
            if ($findemail) {
                $findemail->update([
                    'github_id' => $githubUser->id,
                    // 'name' => $githubUser->nickname,
                    'username' => $githubUser->nickname,
                    'github_token' => $githubUser->token,
                    'github_id' => $githubUser->id,
                    // 'avatar' => $githubUser->avatar,
                    'auth_type' => 'github',
                ]);

                Auth::login($findemail);
                return redirect()->intended('/');
            } else {
                $data = [
                    'github_id' => $githubUser->id,
                    'name' => $githubUser->nickname,
                    'username' => $githubUser->nickname,
                    'email' => $githubUser->email,
                    'github_token' => $githubUser->token,
                    'avatar' => 'default.jpg',
                    'auth_type' => 'github',
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

// $githubUser = Socialite::driver('github')->user();
// dd($githubUser);
// $user = User::updateOrCreate([
//     'github_id' => $githubUser->id,
// ], [
//     'name' => $githubUser->nickname,
//     'username' => $githubUser->nickname,
//     'email' => $githubUser->email,
//     'github_token' => $githubUser->token,
//     'avatar' => $githubUser->avatar,
//     'auth_type' => 'github',
//     'password' => 'loremcuy',
// ]);

// Auth::login($user);

// return redirect('/dashboard');