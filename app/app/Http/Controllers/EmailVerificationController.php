<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function index()
    {
      return view('email', [
        'email' => auth()->user()->email,
      ]);
    }

    // Procesa el enlace de verificación cuando el usuario hace click
    public function verify(EmailVerificationRequest $request)
    {
      $request->fulfill();

      return view('email-welcome', [
        'user' => $request->user(),
      ]);
    }

    // Reenvía el correo de verificación si el usuario lo solicita
    public function resend(Request $request)
    {
      if ($request->user()->hasVerifiedEmail()) {
          return redirect()->route('home');
      }

      $request->user()->sendEmailVerificationNotification();

      return back()->with('message', 'A fresh verification link has been sent to your email address.');
    }
}
