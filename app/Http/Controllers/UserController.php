<?php

namespace App\Http\Controllers;

use App\Service\MailVerifyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(private MailVerifyService $mailVerifyService) {}

    public function verifyEmail(Request $request)
    {
        $token = $request->route('token');

        $this->mailVerifyService->verifyUserEmail($token, fn() => abort(404));

        return redirect()->route('profile.index', ['ru'])
            ->with('message', __('Аккаунт успешно подтверждён.'));
    }

    public function verifyEmailAgain()
    {
        $user = Auth::user();

        $this->mailVerifyService->sendVerifyMessage($user);

        return redirect()->back()->with('message', __('Подтверждение отправлено на почту'));
    }
}
