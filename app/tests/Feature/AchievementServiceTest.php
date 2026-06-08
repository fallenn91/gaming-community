<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Services\AchievementService;
use App\Models\Achievement;

class AchievementServiceTest extends TestCase
{
    use RefreshDatabase;
 
    private AchievementService $service;
    private User $user;
    /**
     * A basic feature test example.
     */
    protected function setUp(): void
    {
      parent::setUp();
      $this->service = app(AchievementService::class);
      $this->user = User::factory()->create(['xp' => 1]);
    }

    /**@test */
    public function test_if_unlocks_achievement_when_threshold_met(): void
    {
      $achievement = Achievement::factory()->create([
        'type' => 'posts',
        'threshold' => 1,
        'xp_reward' => 50,
      ]);

      \App\Models\Post::factory()->create(['user_id' => $this->user->id]);

      $this->service->check($this->user, 'posts');
      $this->assertDatabaseHas('user_achievements', [
        'user_id' => $this->user->id,
        'achievement_id' => $achievement->id,
      ]);
    }

    /**@test */
    public function test_it_awards_xp_on_achievement_unlock(): void
    {
      $xpReward = 50;
      Achievement::factory()->create([
        'type' => 'posts',
        'threshold' => 1,
        'xp_reward' => $xpReward,
      ]);

      \App\Models\Post::factory()->create(['user_id' => $this->user->id]);

      $this->service->check($this->user, 'posts');
      $this->user->refresh();
      $this->assertEquals($xpReward, $this->user->xp);
    }

    /**@test */
    public function test_it_does_not_unlock_achievement_if_threshold_not_met(): void
    {
      $achievement = Achievement::factory()->create([
        'type' => 'posts',
        'threshold' => 5,
        'xp_reward' => 50,
      ]);

      \App\Models\Post::factory()->create(['user_id' => $this->user->id]);

      $this->service->check($this->user, 'posts');
      $this->assertDatabaseMissing('user_achievements', [
        'user_id' => $this->user->id,
        'achievement_id' => $achievement->id,
      ]);
    }

    /**@test */
    public function test_it_does_not_unlock_achievement_twice(): void
    {
      $achievement = Achievement::factory()->create([
        'type' => 'posts',
        'threshold' => 1,
        'xp_reward' => 50,
      ]);

      \App\Models\Post::factory()->create(['user_id' => $this->user->id]);

      // Llamamos dos veces (retry queue)
      $this->service->check($this->user, 'posts');
      $this->service->check($this->user, 'posts');

      $this->assertDatabaseCount('user_achievements', 1);

      $this->user->refresh();
      $this->assertEquals(50, $this->user->xp);
    }

    /**@test */
    public function test_it_fries_achievement_unlocked_event(): void
    {

      \Event::fake(\App\Events\AchievementUnlocked::class);

      $achievement = Achievement::factory()->create([
        'type' => 'posts',
        'threshold' => 1,
        'xp_reward' => 10,
      ]);

      \App\Models\Post::factory()->create(['user_id' => $this->user->id]);

      $this->service->check($this->user, 'posts');

      \Event::assertDispatched(\App\Events\AchievementUnlocked::class, function ($event) {
        return $event->user->id === $this->user->id;
      });
      
    }
    /**@test */
    public function test_it_only_checks_achievements_of_the_given_type(): void
    {

      $postAchievement = Achievement::factory()->create(['type' => 'posts', 'threshold' => 1]);
      $commentAchievement = Achievement::factory()->create(['type' => 'comments', 'threshold' => 1]);

      \App\Models\Post::factory()->create(['user_id' => $this->user->id]);

      $this->service->check($this->user, 'posts');

      $this->assertDatabaseHas('user_achievements', [
        'user_id' => $this->user->id,
        'achievement_id' => $postAchievement->id,
      ]);

      $this->assertDatabaseMissing('user_achievements', [
        'user_id' => $this->user->id,
        'achievement_id' => $commentAchievement->id,
      ]);  

    }
}
