<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\CommentCreated::class => [
            \App\Listeners\HandleCommentCreated::class,
            \App\Listeners\AwardGuildXp::class,
        ],
        \App\Events\LikeCreated::class => [
            \App\Listeners\HandleLikeCreated::class,
            \App\Listeners\AwardGuildXp::class,
        ],
        \App\Events\PostCreated::class => [
            \App\Listeners\HandlePostCreated::class,
            \App\Listeners\AwardGuildXp::class,
        ],
        \App\Events\UserFollowed::class => [
            \App\Listeners\HandleFollow::class,
        ],
        \App\Events\UserUnfollowed::class => [
            \App\Listeners\HandleUnfollow::class,
        ],
        \App\Events\AchievementUnlocked::class => [
            \App\Listeners\SendAchievementToast::class,
        ],
          \App\Events\UserLevelUp::class => [
              \App\Listeners\SendLevelUpToast::class,
              \App\Listeners\CheckCommunityUnlock::class,
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
