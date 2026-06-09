<?php

namespace App\Livewire\Interactions;

use Livewire\Component;
use App\Models\Like;
use App\Models\Post;

class LikeButton extends Component
{
    public Post $post;
    public $likes;
    public bool $hasLiked = false;

    public function render()
    {
        return view('livewire.interactions.like-button');
    }

    public function mount(Post $post)
    {
      $this->post = $post;
      $this->loadLikes();
    }

    public function loadLikes()
    {
      $this->likes = $this->post->likes()->with('user')->get();
      $this->hasLiked = $this->post->likes()->where('user_id', auth()->id())->exists();
    }

    public function deleteLike($likeId)
    {
      $like = Like::findOrFail($likeId);
      if ($like->user_id !== auth()->id()) {
        return;
      }
      $like->delete();

      $this->loadLikes();
    }

    public function toggleLike()
    {
      if (! auth()->check()) {
        return redirect('/login');
      }

      if ($this->hasLiked) {
        $like = $this->post->likes()->where('user_id', auth()->id())->first();

        if ($like) {
          $like->delete();
        }
      } else {
        $like = $this->post->likes()->create([
          'user_id' => auth()->id(),
        ]);

        event(new \App\Events\LikeCreated($like));
      }

      $this->loadLikes();
      $this->dispatch('likeUpdated');
    }
}
