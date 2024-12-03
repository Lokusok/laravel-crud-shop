<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function __construct(
        private CartService $cartService
    ) {}

    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubAuthenticate()
    {
        $githubProfile = Socialite::driver('github')->user();

        $user = User::query()->where([
            'email' => $githubProfile->email
        ])->first();

        if (! $user) {
            $user = User::query()->create([
                'name' => $githubProfile->name ?? $githubProfile->nickname ?? Str::random(16),
                'email' => $githubProfile->email,
                'is_verified' => true,
                'password' => Hash::make(Str::random(32))
            ]);
        }

        $this->cartService->fromSessionToUser(Session::getId(), $user->id);

        Auth::login($user);

        return redirect()->route('profile.index');
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthenticate()
    {
        $googleProfile = Socialite::driver('google')->user();

        $user = User::query()->where([
            'email' => $googleProfile->email
        ])->first();

        if (! $user) {
            $user = User::query()->create([
                'name' => $googleProfile->name ?? $googleProfile->nickname ?? Str::random(16),
                'email' => $googleProfile->email,
                'is_verified' => true,
                'password' => Hash::make(Str::random(32))
            ]);
        }

        $this->cartService->fromSessionToUser(Session::getId(), $user->id);

        Auth::login($user);

        return redirect()->route('profile.index');
    }
}
