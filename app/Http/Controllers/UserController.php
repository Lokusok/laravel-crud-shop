<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerify;
use App\Models\EmailVerifyToken;
use App\Service\MailVerifyService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function __construct(private MailVerifyService $mailVerifyService) {}

    public function verifyEmail(Request $request)
    {
        $token = $request->route('token');

        $token = EmailVerifyToken::query()->where([
            'value' => $token
        ])->first();

        if (is_null($token)) {
            abort(404);
        }

        $user = $token->user;

        if ($user->is_verified) {
            abort(404);
        }

        $token->user()->update([
            'is_verified' => true
        ]);

        return redirect()->route('profile.index', ['ru'])
            ->with('message', __('Аккаунт успешно подтверждён.'));
    }

    public function verifyEmailAgain(Request $request)
    {
        $user = Auth::user();

        $user->emailVerifyToken()->delete();

        $user->emailVerifyToken()->create([
            'value' => Str::random()
        ]);

        // Отправка сообщения
        Mail::to($user)->send(new EmailVerify($user));

        return redirect()->back()->with('message', __('Подтверждение отправлено на почту'));
    }
}
