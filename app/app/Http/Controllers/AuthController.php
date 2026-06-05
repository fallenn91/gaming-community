<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function index()
    {
      return view('auth');
    }


    public function login(Request $request)
    {
      $request->validate([
        'email' => 'required|email|max:255',
        'password' => 'required|string|min:8',
      ]);

      if (!Auth::attempt($request->only('email', 'password'))) {
        return back()->with('error', 'Invalid credentials.');
      }

      $request->session()->regenerate();

      return redirect()->route('home');
    }

    public function logout()
    {
      Auth::logout();
      return redirect()->route('auth');
    }

    public function register(Request $request)
    {
      $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username',
        'email' => 'required|email|max:255',
        'password' => 'required|string|min:8|confirmed',
      ]);
      
      $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => 2, // Default to User role
      ]);

              
      Auth::login($user);

      $user->sendEmailVerificationNotification();
      
      return redirect()->route('verification.notice');
    }
}
