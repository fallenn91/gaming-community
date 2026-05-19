<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function index()
    {
      return view('email');
    }

    // Procesa el enalce de verificación cuando usuario hace click
    public function verify(EmailVerificationRequest $request)
    {
      $request->fulfill();
      return redirect('/home')->with('message', '¡Email Verified Successfully!');
    }

    // Reenvía el correo de verificación si el usuario lo solicita
    public function resend(Request $request)
    {
      $request->user()->sendEmailVerificationNotification();
      return back()->with('message', '¡Link Sent Successfully!');
    }
}
