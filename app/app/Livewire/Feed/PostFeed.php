<?php

namespace App\Livewire\Feed;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use Livewire\WithPagination;

class PostFeed extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public $post;
    public $user = null;
    protected $listeners = ['likeUpdated' => '$refresh', 'postCreated' => 'refreshPosts', 'achievementUnlocked' => 'showToast'];

    public function mount($user = null)
    {
      if ($user instanceof User) {
          $this->user = $user;
      } elseif (is_numeric($user)) {
          $this->user = User::find($user);
      } else {
          $this->user = null;
      }
    }

    public function render()
    {
      $query = Post::with(['user', 'likes', 'comments', 'tags']);

      if ($this->user && !is_array($this->user) && $this->user instanceof User) {
        $query->where('user_id', $this->user->id);
      }
      return view('livewire.feed.post-feed', [
          'posts' => $query->latest()->paginate(5),
      ]);
    }

    public function refreshPosts()
    {
        $this->resetPage();
    }

    public function paginationView()
    {
      return 'components.my-pagination';
    }

    public function deletePost($postId)
    {
      $post = Post::findOrFail($postId);

      if ($post->user_id !== auth()->id()) {
        return;
      }

      $post->delete();

      $this->refreshPosts();

    }

    public function showToast($data)
    {
      $this->dispatch('toast', [
        'message' => "🏆 Achievement desbloqueado: {$data['name']} (+{$data['xp']} XP)",
        'type' => 'succes',
      ]);
    }
    
}
