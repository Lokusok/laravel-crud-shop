<?php

namespace App\Http\Controllers;

use App\Service\MailVerifyService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(private MailVerifyService $mailVerifyService) {}

    public function index()
    {
        $user = Auth::user();

        $showEmailVerifySend = $this->mailVerifyService->showResend($user, minHours: 8);

        return view('profile.index', compact('showEmailVerifySend'));
    }
}
