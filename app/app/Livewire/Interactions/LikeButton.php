<?php

namespace App\Livewire\Interactions;

use Livewire\Component;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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

    public function toggleLike()
    {
      if (! auth()->check()) {
        return redirect('/login');
      }

      if ($this->hasLiked) {
        $like = $this->post->likes()->where('user_id', auth()->id())->first();

        if ($like) {
          $user = $this->post->user;
          $like->delete();
          app(\App\Services\ReputationService::class)->lose($user, 'like_removed');
        }
      } else {
        $like = $this->post->likes()->create([
          'user_id' => auth()->id(),
        ]);

        event(new \App\Events\LikeCreated($like));
      }

      $this->loadLikes();
      $this->dispatch('likeUpdated', postId: $this->post->id);
    }
}
