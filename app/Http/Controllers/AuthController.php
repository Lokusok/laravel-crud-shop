<?php

namespace App\Http\Controllers;

use App\Enum\CartCacheEnum;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\EmailVerify;
use App\Models\Cart;
use App\Models\User;
use App\Service\CartService;
use App\Service\MailVerifyService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct(
        private CartService $cartService,
        private MailVerifyService $mailVerifyService
    ) {}

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
            $this->cartService->fromSessionToUser(Session::getId(), $user->id);

            Auth::login($user);

            Cache::forget(CartCacheEnum::GUEST_USER_CART->value);

            $isAuthenticate = true;
        }

        if ($isAuthenticate) {
            return redirect()->route('profile.index');
        }
    }

    public function register()
    {
        $stats = $this->cartService->getStats();

        return view('auth.register', [
            'totalPrice' => $stats->total_price,
            'count' => $stats->count,
        ]);
    }

    public function registerize(RegisterRequest $request)
    {
        $data = $request->validated();

        unset($data['password_confirmation']);

        $user = User::query()->create($data);

        $this->mailVerifyService->sendVerifyMessage($user);

        return redirect()->route('auth.login')->with('message', __('Регистрация прошла успешно. Теперь вы можете войти в аккаунт'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        Cache::forget(CartCacheEnum::AUTH_USER_CART->value);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('articles.index');
    }
}
