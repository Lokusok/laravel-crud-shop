<?php

namespace App\Http\Controllers;

use App\Models\EmailVerifyToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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
}
