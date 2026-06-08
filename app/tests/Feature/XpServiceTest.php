<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Services\XpService;

class XpServiceTest extends TestCase
{
    use RefreshDatabase;
 
    private XpService $xpService;
    private User $user;
    /**
     * A basic feature test example.
     */
    protected function setUp(): void
    {
      parent::setUp();
      $this->xpService = app(XpService::class);
      $this->user = User::factory()->create(['xp' => 0, 'level' => 1]);
    }

    /**@test */
    public function test_if_adds_xp_to_user(): void
    {
      $this->xpService->award($this->user, 10, 'Test award');

      $this->user->refresh();
      $this->assetEquals(10, $this->user->xp);
    }

    /**@test */
    public function test_it_accumulates_xp_across_multiple_awards(): void
    {
      $this->xpService->award($this->user, 10, 'Post');
      $this->xpService->award($this->user, 5, 'Comment');
      $this->xpService->award($this->user, 2, 'Follow');

      $this->user->refresh();
      $this->assertEquals(17, $this->user->xp);
    }

    /**@test */
    public function test_it_triggers_level_up_when_xp_threshold_is_reached(): void
    {
      $this->xpService->award($this->user, 2500, 'Big Award');

      $this->user->refresh();
      $this->assertGreaterThan(1, $this->user->level, 'User should have leveled up.');
    }

    /**@test */
    public function test_it_does_not_downgrade_level_with_small_xp(): void
    {
      $this->user->update(['xp' => 9000, 'level' => 3]);

      $this->xpService->award($this->user, 10, 'Small Award');

      $this->user->refresh();
      $this->assertGreaterThanOrEqual(3, $this->user->level);
    }

    /**@test */
    public function test_it_fires_user_level_up_event_when_leveling(): void
    {
      \Event::fake(\App\Events\UserLevelUp::class);

      $this->xpService->award($this->user, 2500, 'Level Up Award');

      \Event::assertDispatched(\App\Events\UserLevelUp::class);
    }

    /**@test */
    public function test_it_does_not_fire_level_up_event_for_small_xp(): void
    {
      \Event::fake(\App\Events\UserLevelUp::class);

      $this->xpService->award($this->user, 5, 'Tiny Award');

      \Event::asertNotDispatched(\App\Events\UserLevelUp::class);
    }
}
