<?php

namespace App\Livewire\Feed;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;

class PostFeed extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public $post;
    public boolean $hasNewContent = false;
    public int $lastPostId = 0;
    public $user = null;
    protected $listeners = ['likeUpdated' => '$refresh', 'postCreated' => 'refreshPosts', 'achievementUnlocked' => 'showToast', 'commentCountUpdated' => '$refresh'];

    public function mount($user = null)
    {
      if ($user instanceof User) {
          $this->user = $user;
      } elseif (is_numeric($user)) {
          $this->user = User::find($user);
      }

      $this->lastPostId = Post::latest()->value('id') ?? 0;
    }

    public function render()
    {

      $query = Post::with(['likes', 'comments'])
      ->with(['user:id,username,avatar', 'tags:id,name'])
      ->latest();

      if ($this->user instanceof User) {
          $query->where('user_id', $this->user->id);
      }

      return view('livewire.feed.post-feed', [
          'posts' => $query->paginate(5),
      ]);
    }

    public function checkForUpdates(): void
    {
      $latestId = Post::latest()->value('id') ?? 0;

      if ($latestId > $this->lastPostId) {
        $this->hasNewContent = true;
      }
    }

    public function loadNewContent(): void
    {
      $this->lastPostId = Post::latest()->value('id') ?? 0;
      $this->hasNewContent = false;
      $this->resetPage();
    }

    public function refreshPosts()
    {
      $this->lastPostId = Post::latest()->value('id') ?? 0;
      $this->hasNewContent = false;
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
        'type' => 'success',
      ]);
    }
    
}
