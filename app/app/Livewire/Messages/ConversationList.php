<?php

namespace App\Livewire\Messages;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\User;
use App\Models\Message;

class ConversationList extends Component
{
    public function conversations()
    {
        $userId = auth()->id();

        return Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver'])
            ->latest()
            ->get()
            ->groupBy(function ($msg) use ($userId) {
                return $msg->sender_id === $userId ? $msg->receiver_id : $msg->sender_id;
            })
            ->map(fn($msgs) => $msgs->first());
    }

    #[On('echo-private:chat.{authId},MessageSent')]
    public function messageReceived(): void
    {
        // Refresh the conversation list when a message is received
        $this->dispatch('refresh');
    }

    public function getAuthIdProperty(): int
    {
        return auth()->id();
    }

    public function render()
    {
        return view('livewire.messages.conversation-list', [
            'conversations' => $this->conversations(),
        ]);
    }
}
