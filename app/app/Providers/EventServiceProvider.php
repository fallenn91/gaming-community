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
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
