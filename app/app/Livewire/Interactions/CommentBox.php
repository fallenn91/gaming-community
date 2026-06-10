<?php

namespace App\Livewire\Interactions;

use Livewire\Component;
use App\Models\Comment;

class CommentBox extends Component
{   
    public $post;
    public $comments = [];
    public $content;

    public function render()
    {
        return view('livewire.interactions.comment-box');
    }

    public function mount($post)
    {
        $this->post = $post;
        $this->comments = $post->comments()->with('user')->latest()->get();
    }

    public function loadComments()
    {
        $this->comments = $this->post->comments()->with('user')->latest()->get();
    }

    public function addComment()
    {
        $this->validate([
          'content' => 'required|string|max:1000',
        ]);

        $comment = $this->post->comments()->create([
          'user_id' => auth()->id(),
          'content' => $this->content
        ]);

        //Evento para XP
        event(new \App\Events\CommentCreated($comment));

        //Reset Input
        $this->content = '';

        //Recargar comentarios
        $this->loadComments();

        $this->dispatch('commentCountUpdated', postId: $this->post->id);
    }

    public function deleteComment($commentId)
    {
      $comment = Comment::findOrFail($commentId);
      if ($comment->user_id !== auth()->id()) {
        return;
      }

      $comment->delete();

      $this->loadComments();

      $this->dispatch('commentCountUpdated', postId: $this->post->id);
    }
}
