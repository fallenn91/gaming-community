<?php

namespace App\Http\Controllers;

use App\Models\User;

class WeeklyLeaderboardController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->whereNotNull('username')
            ->orderByDesc('xp')
            ->orderByDesc('reputation')
            ->take(10)
            ->get();

        return view('weekly-leaderboard', compact('users'));
    }
}
