<?php

namespace App\Livewire\Communities;
use Illuminate\Support\Str;

use Livewire\Component;
use App\Models\Community;
use App\Models\Game;

class CommunityCreate extends Component
{
    public $name;
    public $description;
    public $game_id;
    public $image;
    public $tags = '';

    public function create()
    {
      $community = Community::create([
        'name' => $this->name,
        'game_id' => $this->game_id,
        'owner_id' => auth()->id(),
        'slug' => Str::slug($this->name),
        'description' => $this->description,
      ]);

      if ($this->image) {
        $path = $this->image->store('communities', 'public');
        $community->update(['image' => $path]);
      }

      $community->users()->attach(auth()->id(), [
        'role' => 'admin'
      ]);

      return redirect()->route('community', $community);
    }
    
    public function render()
    {
        return view('livewire.communities.community-create', [
          'games' => Game::all()
        ]);
    }

}
