<?php

namespace App\Livewire\Messages;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use App\Models\User;
use App\Models\Message;

class ConversationList extends Component
{
    public int $authId;

    public function mount(): void
    {
      $this->authId = auth()->id();
    }

    #[Computed]
    public function conversations()
    {
        $userId = auth()->id();

        $subquery = Message::query()
            ->selectRaw('MAX(id) as last_id')
            ->where(function ($q) use ($userId) {
                $q->where('sender_id', $userId)
                  ->orWhere('receiver_id', $userId);
            })
            ->groupByRaw(
                'LEAST(sender_id, receiver_id),
                GREATEST(sender_id, receiver_id)'
            );

        return Message::query()
            ->joinSub($subquery, 'c', function ($join) {
                $join->on('messages.id', '=', 'c.last_id');
            })
            ->with(['sender', 'receiver'])
            ->latest('messages.created_at')
            ->get();
    }

    #[On('echo-private:chat.{authId},MessageSent')]
    public function messageReceived(): void
    {
        // Refresh the conversation list when a message is received
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.messages.conversation-list', [
            'conversations' => $this->conversations(),
        ]);
    }
}
