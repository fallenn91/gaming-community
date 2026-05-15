<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;

class CommunityController extends Controller
{
    public function index()
    {
      $communities = Community::all();
      return view('community', compact('communities'));
    }

    public function show(string $slug)
    {
      $community = Community::where('slug', $slug)->firstOrFail();
      return redirect()->route('community.show', compact('community'));
    }
}
