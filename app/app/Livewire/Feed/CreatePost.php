<?php

namespace App\Livewire\Feed;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Services\AchievementService;
use App\Services\XpService;
use Illuminate\Support\Facades\Cache;


class CreatePost extends Component
{
    use WithFileUploads;

    public $content = '';
    public $image;

    protected $rules = [
      'content' => 'required|string|max:500',
      'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ];

    public function render()
    {
        return view('livewire.feed.create-post');
    }

    public function createPost()
    {
      $this->validate();
      
      $imagePath = null;

      if ($this->image) {
        $imagePath = $this->image->store('PostImage', 'public');
      }

      $post = Post::create([
        'user_id' => Auth::id(),
        'content' => $this->content,
        'image' => $imagePath,
      ]);

      
      event(new \App\Events\PostCreated($post));

      $this->reset(['content', 'image']);

      $this->dispatch('postCreated');

      $key = 'achievement_toast:' . Auth::id();
      $pending = Cache::get($key, []);
      Cache::forget($key);

      foreach ($pending as $achievement) {
        $this->dispatch('toast', [
          'message' => "Achievement Unlocked: {$achievement['name']} (+{$achievement['xp']} XP)",
          'type' => 'success',
         ]);
      }
    }
}
