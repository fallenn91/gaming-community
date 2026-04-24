<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required|string|max:255',
          'username' => 'required|string|max:255|unique:users',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6',

          'avatar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
          'bio' => 'required|string|max:255',

          'level' => 'nullable|numberic',
          'xp' => 'nullable|numberic',
          'is_online' => 'nullable|boolean',
        ])

        $avatarPath = null;

        if ($request->hasFile('avatar')) {
          $filename = time() . '.' . $request->avatar->extension();
          $avatarPath = $request->avatar->storeAs('avatars', $filename, 'public');
        }

        $user = User::create([
          'name' => $request->name,
          'username' => $request->username,
          'email' => $request->email,
          'password' => bcrypt($request->password),

          'avatar' => $avatarPath,
          'bio' => $request->bio ?? '',

          'level' => $request->input('level', 0),
          'xp' => $request->input('xp', 0),
          'is_online' => $request->input('is_online', true),
      ]);

      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('show', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
