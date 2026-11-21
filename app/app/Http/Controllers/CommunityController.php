<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;

class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::all();
        $userCommunity = null;

        if (auth()->check()) {
            $user = auth()->user();
            $userCommunity = Community::where('owner_id', $user->id)
                ->orWhereHas('members', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->first();
        }

        return view('community', compact('communities', 'userCommunity'));
    }

    public function show(string $slug)
    {
      $community = Community::where('slug', $slug)->firstOrFail();
      return redirect()->route('community.show', compact('community'));
    }
}
