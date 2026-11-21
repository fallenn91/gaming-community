<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\User;

class NewFollowerNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $follower)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
          'title' => '¡New Follower!',
          'message' => "{$this->follower->username} has started following you",
          'follower_id' => $this->follower->id,
          'follower_username' => $this->follower->username,
          'follower_avatar' => $this->follower->avatar,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
          'title' => '¡New Follower!',
          'message' => "{$this->follower->username} has started following you",
          'follower_id' => $this->follower->id,
          'follower_username' => $this->follower->username,
          'follower_avatar' => $this->follower->avatar,
        ];
    }
}
