<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Cart;
use App\Models\User;
use App\Service\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function loginize(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        $isAuthenticate = false;

        $user = User::query()->where([
            'email' => $data['email']
        ])->first();

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
