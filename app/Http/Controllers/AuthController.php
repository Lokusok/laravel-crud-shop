<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use App\Models\User;
use App\Service\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct(private CartService $cartService) {}

    public function login()
    {
        $stats = $this->cartService->getStats();

        return view('auth.login', [
            'totalPrice' => $stats->total_price,
            'count' => $stats->count,
        ]);
    }

    public function loginize(LoginRequest $request)
    {
        $data = $request->validated();

        $isAuthenticate = false;

        $user = User::query()->where([
            'email' => $data['email']
        ])->first();

        if (is_null($user)) {
            return redirect()->route('auth.login');
        }

        if (Hash::check($data['password'], $user->password)) {
            Cart::query()->where('session_id', Session::getId())->update([
                'user_id' => $user->id
            ]);

            Auth::login($user);

            $isAuthenticate = true;
        }

        if ($isAuthenticate) {
            return redirect()->route('profile.index');
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('articles.index');
    }
}
