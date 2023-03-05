<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }
    public function callback()
    {
        $githubUser = Socialite::driver('github')->user();
        // dd($githubUser);
        $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->nickname,
            'username' => $githubUser->nickname,
            'email' => $githubUser->email,
            'github_token' => $githubUser->token,
            'avatar' => $githubUser->avatar,
            'auth_type' => 'github',
            'password' => 'loremcuy',
            // 'github_refresh_token' => $githubUser->refreshToken,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
        // $user->token
    }
}
