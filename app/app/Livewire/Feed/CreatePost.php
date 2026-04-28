<?php

namespace App\Livewire\Feed;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

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
        $filename = time() . '.' . $request->image->extension();
        $imagePath = $this->image->storeAs('PostImage', $filename, 'public');
      }

      Post::create([
        'user_id' => Auth::id(),
        'content' => $this->content,
        'image' => $imagePath,
      ]);

      Auth::user()->addXp(10);

      $this->reset(['content', 'image']);

      $this->dispatch('post-created');
    }
}
