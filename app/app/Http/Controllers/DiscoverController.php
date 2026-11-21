<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;

class DiscoverController extends Controller
{
    public function index()
    {
        $games = Game::query()->orderByDesc('id')->take(6)->get();
        $creators = User::query()->orderByDesc('reputation')->take(6)->get();
        $tags = Tag::query()->withCount('posts')->orderByDesc('posts_count')->take(8)->get();

        return view('discover', compact('games', 'creators', 'tags'));
    }
}
