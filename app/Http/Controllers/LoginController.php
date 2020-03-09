<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;


class LoginController extends Controller
{
    public function loginVK()
    {
        session()->get('soc.token');
        if (Auth::id()) {
            return redirect()->route('home');
        }
        return Socialite::with('vkontakte')->redirect();
    }

    public function responseVK(UserRepository $userRepository)
    {
        if (Auth::id()) {
            return redirect()->route('home');
        }
        $user = Socialite::driver('vkontakte')->user();

        session(['soc.token' => $user->token]);

        $userInSystem = $userRepository->getUserBySocId($user, 'vk');

        Auth::login($userInSystem);
        return redirect()->route('home');
    }
}
