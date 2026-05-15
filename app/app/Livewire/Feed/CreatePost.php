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
    public $post;

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

      $post = Post::create([
        'user_id' => Auth::id(),
        'content' => $this->content,
        'image' => $imagePath,
      ]);

      
      event(new \App\Events\PostCreated($post));

      $this->reset(['content', 'image']);

      $this->dispatch('postCreated');
    }
}
