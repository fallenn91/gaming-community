<?php

namespace App\Livewire\Notifications;

use Livewire\Component;

class NotificationList extends Component
{
    public function markAllAsRead(): void
    {
      auth()->user()->unreadNotifications->markAsRead();
      $this->dispatch('notification-read');
    }

    public function markAsRead(string $id): void
    {
      auth()->user()->notifications()->where('id', $id)->first()?->markAsRead();
      $this->dispatch('notification-read');
    }

    public function render()
    {
        return view('livewire.notifications.notification-list', [
          'notifications' => auth()->user()
            ->notifications()
            ->latest()
            ->take(20)
            ->get(),
        ]);
    }
}
