<?php

namespace App\Notifications;

use App\Models\Community;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class CommunityJoinRejectedNotification extends Notification
{
    use Queueable;

    public function __construct(public Community $community)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Community join request denied',
            'message' => "Your request to join {$this->community->name} was denied.",
            'community_id' => $this->community->id,
            'community_name' => $this->community->name,
            'community_slug' => $this->community->slug,
        ];
    }

    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}
