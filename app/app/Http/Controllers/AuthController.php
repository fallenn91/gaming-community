<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
      $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|max:255',
      ]);

      if (Auth::attemp($credentials)) {
        $request->session()->regenrate();
        return redirect()->intended('dashboard');
      }
    }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.'
    ])->onlyInput('email');
}
