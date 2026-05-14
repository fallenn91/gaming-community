<?php

namespace App\Livewire\Interactions;

use Livewire\Component;
use App\Models\Like;

class LikeButton extends Component
{
    public $post;
    public $likes;
    public $hasLiked = false;

    public function render()
    {
        return view('livewire.interactions.like-button');
    }

    public function mount($post)
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
      $like = $this->post->likes()->where('user_id', auth()->id())->first();

      if ($like) {
        $like->delete();

        $user = $this->post->user;
        $user->xp = max(0, $user->xp - 1);
        $user->save(); //Si quita like se resta xp

      } else {
        $like = $this->post->likes()->create([
          'user_id' => auth()->id(),
        ]);

        event(new \App\Events\LikeCreated($like));

        $this->post->user->increment('xp', 2);
      }
      $this->loadLikes();
      $this->dispatch('likeUpdated');
    }
}
