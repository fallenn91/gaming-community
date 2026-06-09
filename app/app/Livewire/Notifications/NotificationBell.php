<?php

namespace App\Livewire\Notifications;

use Livewire\Component;
use Livewire\Attributes\On;

class NotificationBell extends Component
{
    public int $unreadCount = 0;

    public function mount(): void
    {
      $this->unreadCount = auth()->user()->unreadNotifications()->count();
    }

    #[On('notification-read')]
    public function refreshCount(): void
    {
      $this->unreadCount = auth()->user()
        ->unreadNotifications()
        ->count();
    }

    public function render()
    {
        return view('livewire.notifications.notification-bell');
    }
}
