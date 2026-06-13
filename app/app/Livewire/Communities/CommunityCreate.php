<?php

namespace App\Livewire\Communities;
use Illuminate\Support\Str;

use Livewire\Component;
use App\Models\Game;
use App\Services\CommunityCreationService;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class CommunityCreate extends Component
{
    use WithFileUploads;
    
    public string $name = '';
    public string $description = '';
    public ?int $game_id = null;
    public $image;
    public string $visibility = 'public';

    public function create()
    {

      $this->validate([
          'name' => 'required|min:3|max:50',
          'description' => 'nullable|max:255',
          'visibility' => 'required|in:public,private',
      ]);

      $community = app(CommunityCreationService::class)
      ->create(auth()->user(), [
        'name' => $this->name,
        'game_id' => $this->game_id,
        'description' => $this->description,
        'visibility' => $this->visibility,
        'image' => null,
      ]);

      if ($this->image) {
        $path = $this->image->store('communities', 'public');
        $community->update(['image' => $path]);
      }

      $key = 'achievement_toast:' . Auth::id();
      $pending = Cache::get($key, []);
      Cache::forget($key);

      foreach ($pending as $achievement) {
        $this->dispatch('toast', [
          'message' => "Achievement Unlocked: {$achievement['name']} (+{$achievement['xp']} XP)",
          'type' => 'success',
         ]);
      }

      session()->flash('success', 'Community created successfully!');

      return redirect()->route('community', $community);
    }
    
    public function render()
    {
        return view('livewire.communities.community-create', [
          'games' => Game::all()
        ]);
    }

}
