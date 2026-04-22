<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailController extends Controller
{
    public function unverified(): View
    {
        return view('email.unverified');
    }

    public function resendNotification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('info', 'New verification has been sent!');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->intended('/');
    }
}
