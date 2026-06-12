<?php

namespace App\Livewire\Messages;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;


class ChatWindow extends Component
{
    #[Locked]
    public User $recipient;
    
    public string $newMessage = '';

    public function mount(User $recipient): void
    {
        $this->recipient = $recipient;
        $this->markAsRead();
    }

    #[Computed]
    public function chatMessages()
    {
        return Message::conversation(
            auth()->id(),
            $this->recipient->id
        )->with('sender')->get();
    }

    public function sendMessage(): void
    {
        if (auth()->id() === $this->recipient->id) {
          return;
        }
        
        $this->validate([
            'newMessage' => 'required|string|max:1000'
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $this->recipient->id,
            'content' => $this->newMessage,
            'status' => 'sent',
        ]);

        $message->load('sender');

        event(new MessageSent($message));

        $this->newMessage = '';

    }

    #[Computed]
    public function authId(): int
    {
        return auth()->id();
    }

    #[On('echo-private:chat.{authId},MessageSent')]
    public function receiveMessage($payload): void 
    {
        $message = is_array($payload) && isset($payload['message']) ? $payload['message'] : $payload;

        if ((int) $message['sender_id'] === $this->recipient->id) {
            $this->dispatch('$refresh');
            $this->markAsRead();
        }
    }

    private function markAsRead(): void
    {
        Message::where('sender_id', $this->recipient->id)
            ->where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->update(['status' => 'read', 'read_at' => now()]);
    }

    public function render()
    {
        return view('livewire.messages.chat-window');
    }


}
