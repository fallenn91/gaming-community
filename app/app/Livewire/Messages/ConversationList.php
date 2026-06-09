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

        $messages = Message::where(function ($q) use ($userId) {
                $q->where('sender_id', $userId)
                  ->orWhere('receiver_id', $userId);
            })
            ->with(['sender', 'receiver'])
            ->latest()
            ->get();

        $grouped = $messages->groupBy(function ($msg) use ($userId) {
            return $msg->sender_id === $userId
                ? $msg->receiver_id
                : $msg->sender_id;
        });

        return $grouped->map(function ($msgs) use ($userId) {

            $lastMessage = $msgs->first();

            $other = $lastMessage->sender_id === $userId
                ? $lastMessage->receiver
                : $lastMessage->sender;

            if (!$other) return null;

            return (object) [
                'user' => $other,
                'last_message' => $lastMessage,
                'unread_count' => $msgs->where('sender_id', $other->id)
                    ->whereNull('read_at')
                    ->count(),
            ];

        })
        ->filter()
        ->sortByDesc(fn ($c) => $c->last_message->created_at);
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
