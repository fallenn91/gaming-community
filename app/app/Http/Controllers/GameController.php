<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Services\IgdbService;

class GameController extends Controller
{
    public function __construct(private IgdbService $igdb)
    {
    }

    public function search(Request $request)
    {
        $request->validate([
          'q' => required|string|max:100,
        ]);
        $games = $this->igdb->searchGames($request->q);
        return response()->json($games);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $igdbId)
    {
        $game = $this->igdb->find($igdbId);

        if (empty($game)) {
          return response()->json(['error' => "Game not found"], 404);
        }
        return response()->json($game);
    }

    public function popular()
    {
      $games = $this->igdb->popular();
      return response()->json($games);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return view('explore');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
