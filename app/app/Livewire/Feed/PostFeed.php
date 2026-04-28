<?php

namespace App\Livewire\Feed;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class PostFeed extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public function paginationView()
    {
      return 'components.my-pagination';
    }
    public function updating()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.feed.post-feed', [
          'posts' => Post::with('user')->latest()->paginate(5),
        ]);
    }
}
