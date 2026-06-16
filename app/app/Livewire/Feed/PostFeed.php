<?php

namespace App\Livewire\Feed;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PostFeed extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'tailwind';
    public $post;
    public bool $hasNewContent = false;
    public int $lastPostId = 0;
    public $user = null;
    public $editingPostId = null;
    public $content = '';
    public $image;
    public $removeImage = false;
    protected $listeners = ['likeUpdated' => '$refresh', 'postCreated' => 'refreshPosts', 'achievementUnlocked' => 'showToast', 'commentCountUpdated' => '$refresh'];

    public function mount($user = null)
    {
      if ($user instanceof User) {
          $this->user = $user;
      } elseif (is_numeric($user)) {
          $this->user = User::find($user);
      }

      $this->lastPostId = Post::max('id') ?? 0;
    }

    public function render()
    {
      $query = Post::withCount(['likes', 'comments'])
      ->with(['user:id,username,avatar', 'tags:id,name'])
      ->orderBy('created_at', 'desc')
      ->orderBy('id', 'desc');
            
      
      if ($this->user instanceof User) {
        $query->where('user_id', $this->user->id);
      }
      
      $posts = $query->paginate(5);
      
      return view('livewire.feed.post-feed', [
          'posts' => $posts,
      ]);
    }

    public function startEditing($postId)
    {
      $post = Post::findOrFail($postId);

      $this->editingPostId = $post->id;
      $this->content = $post->content;
    }

    public function saveEdit()
    {
      $post = Post::findOrFail($this->editingPostId);
      
      if ($post->user_id !== auth()->id()) {
        return;
      }

      $this->validate([
        'content' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048',
      ]);

      $data = [
        'content' => $this->content,
      ];

      if ($this->image) {
        if ($this->removeImage && $post->image) {
          Storage::disk('public')->delete($post->image);

          $data['image'] = null;
        }

        $data['image'] = $this->image->store('PostImage', 'public');
      }

      $post->update($data);

      $this->reset([
        'editingPostId',
        'content',
        'image',
      ]);
      
    }

    public function checkForUpdates(): void
    {
      $latestId = Post::max('id') ?? 0;

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
