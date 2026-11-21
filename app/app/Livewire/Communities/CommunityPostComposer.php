<?php

namespace App\Livewire\Communities;

use App\Models\Community;
use App\Models\CommunityPost;
use App\Models\Post;
use Livewire\Component;

class CommunityPostComposer extends Component
{
    public Community $community;
    public string $body = '';

    public function mount(Community $community): void
    {
        $this->community = $community;
    }

    public function publish(): void
    {
        $user = auth()->user();

        $body = trim($this->body);

        if (! $user || $body === '') {
            return;
        }

        $post = Post::create([
            'user_id' => $user->id,
            'content' => $body,
            'type' => 'text',
        ]);

        CommunityPost::create([
            'community_id' => $this->community->id,
            'post_id' => $post->id,
            'user_id' => $user->id,
            'context' => 'community-post',
        ]);

        $this->body = '';
        $this->dispatch('community-post-created');
    }

    public function render()
    {
        return view('livewire.communities.community-post-composer');
    }
}
