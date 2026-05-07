<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\CommentCreated::class => [
            \App\Listeners\HandleCommentCreated::class,
        ],
        \App\Events\LikeCreated::class => [
            \App\Listeners\HandleLikeCreated::class,
        ],
        \App\Events\PostCreated::class => [
            \App\Listeners\HandlePostCreated::class,
        ],
        \App\Events\UserFollowed::class => [
            \App\Listeners\HandleFollow::class,
        ],
        \App\Events\UserUnfollowed::class => [
            \App\Listeners\HandleUnfollow::class,
        ],

    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
