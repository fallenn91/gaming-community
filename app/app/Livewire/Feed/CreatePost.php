<?php

namespace App\Livewire\Feed;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CreatePost extends Component
{
    use WithFileUploads;

    public $content = '';
    public $image;

    protected $rules = [
      'content' => 'required|string|max:500',
      'image' => 'nullable|images|mimes:jpg,jpeg,png|max:2048',
    ];

    public function render()
    {
        return view('livewire.feed.create-post');
    }

    public function createPost()
    {
      $this->validate();

       $imagePath = null;

      if ($request->hasFile('image')) {
        $filename = time() . '.' . $request->image->extension();
        $imagePath = $request->image->storeAs('PostImage', $filename, 'public');
      }

      Post::create([
        'user_id' => Auth::id(),
        'content' => $this->content,
        'image' => $imagePath,
      ]);

      $this->reset(['content', 'image']);

      $this->dispatch('post-created');
    }
}
