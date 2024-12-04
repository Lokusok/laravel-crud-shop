<?php

namespace App\Service;

use App\Mail\EmailVerify;
use App\Models\EmailVerifyToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailVerifyService
{
    public function showResend(User $user, $minHours = 8): bool
    {
        $tokenCreatedAt = Carbon::create($user->emailVerifyToken?->created_at);
        $showEmailVerifySend = $tokenCreatedAt->diffInHours(Carbon::now()) > $minHours;

        return $showEmailVerifySend;
    }

    public function sendVerifyMessage(User $user): void
    {
        // Удаляем предыдущий токен
        if ($user->emailVerifyToken) {
            $user->emailVerifyToken()->delete();
        }

        $user->emailVerifyToken()->create([
            'value' => Str::random()
        ]);

        $user->load('emailVerifyToken');

        Log::info("У пользователя {$user->name} токен === {$user->emailVerifyToken->value}");

        // Отправка сообщения
        Mail::to($user)->send(new EmailVerify($user));
    }

    public function verifyUserEmail(string $token, callable $onNull)
    {
        $token = EmailVerifyToken::query()->where([
            'value' => $token
        ])->first();

        if (is_null($token)) {
            $onNull();
        }

        $user = $token->user;

        if ($user->is_verified) {
            $onNull();
        }

        $token->user()->update([
            'is_verified' => true
        ]);
    }
}
