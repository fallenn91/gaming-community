<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use App\Events\UserFollowed;
use App\Events\UserUnfollowed;
use App\Listeners\HandleFollow;
use App\Listeners\HandleUnfollow;
use App\Models\Follow;
use App\Models\User;

class FollowFlowTest extends TestCase
{
    use RefreshDatabase;

    private User $follower;
    private User $followed;
    /**
     * A basic feature test example.
     */
    protected function setUp(): void
    {
      parent::setUp();
      $this->follower = User::factory()->create(['followiung_count' => 0, 'xp' => 0]);
      $this->following = User::factory()->create(['followers_count' => 0, 'reputation' => 0]);
    }

    /**@test */
    public function test_follow_increments_counters(): void
    {
      // Crear el follow en BD
      Follow::create([
        'follower_id' => $this->follower->id,
        'following_id' => $this->followed->id,
      ]);

      // Ejecutar listener directameante 
      $event = new UserFollowed($this->follower, $this->followed);
      app(HandleFollow::class)->handle($event);

      $this->follower->refresh();
      $this->followed->refresh();

      $this->assertEquals(1, $this->follower->following_count);
      $this->assertEquals(1, $this->followed->following_count);
    }

    /**@test */
    public function test_follow_handler_is_idempotent_on_retry(): void
    {
      Follow::create([
        'follower_id' => $this->follower->id,
        'following_id' => $this->followed->id,
      ]);

      // Ejecutar listener directameante 
      $event = new UserFollowed($this->follower, $this->followed);

      app(HandleFollow::class)->handle($event);
      app(HandleFollow::class)->handle($event);

      $this->follower->refresh();
      $this->followed->refresh();

      $this->assertEquals(1, $this->follower->following_count, 'following_count should not increment twice');
      $this->assertEquals(1, $this->followed->followers_count, 'followers_count should not increment twice');
    }

    /**@test */
    public function test_follow_handler_skips_if_follow_no_longer_exists(): void
    {
      $event = new UserFollowed($this->follower, $this->followed);

      app(HandleFollow::class)->handle($event);

      $this->follower->refresh();
      $this->followed->refresh();

      $this->assertEquals(0, $this->follower->following_count);
      $this->assertEquals(0, $this->followed->followers_count);
    }

    /**@test */
    public function test_unfollow_decrements_counters(): void
    {
      $this->follower->update(['following_count' => 1]);
      $this->followed->update(['followers_count' => 1, 'reputation' => 1]);

      // No existe el follow en BD
      $event = new UserUnfollowed($this->follower, $this->followed);
      app(HandleUnfollow::class)->handle($event);

      $this->follower->refresh();
      $this->followed->refresh();

      $this->assertEquals(0, $this->follower->following_count);
      $this->assertEquals(0, $this->followed->followers_count);
      $this->assertEquals(0, $this->followed->reputation);
    }

    /**@test */
    public function test_unfollow_handler_skips_if_follow_was_recreated(): void
    {
      // El usuario hizo unfollow y luego volvió a seguir antes de que
      // el job de unfollow se ejecutara
      $this->follower->update(['following_count' => 1]);
      $this->followed->update(['followers_count' => 1]);

      Follow::create([
        'follower_id' => $this->follower->id,
        'following_id' => $this->followed->id,
      ]);

      $event = new UserUnfollowed($this->follower, $this->followed);
      app(HandleUnfollow::class)->handle($event);

      $this->follower->refresh();
      $this->followed->refresh();

      // Los contadores no deven cambiar porque el follow volvió a existir
      $this->assertEquals(1, $this->follower->following_count);
      $this->assertEquals(1, $this->followed->followers_count);
    }

    /**@test */
    public function test_counters_never_go_below_zero(): void
    {
      // Contadores ya en 0
      $this->follower->update(['following_count' => 0]);
      $this->followed->update(['followers_count' => 0, 'reputation' => 0]);

      $event = new UserUnfollowed($this->follower, $this->followed);
      app(HandleUnfollow::class)->handle($event);

      $this->follower->refresh();
      $this->followed->refresh();

      $this->assertGreaterThanOrEqual(0, $this->follower->following_count);
      $this->assertGreaterThanOrEqual(0, $this->followed->followers_count);
      $this->assertGreaterThanOrEqual(0, $this->followed->reputation);
    }

    /**@test */
    public function test_follow_dispatches_user_followed_event(): void
    {
      Event::fake();

      // Testeamos Livewire que dispara el evento
      $this->actingAs($this->follower);

      // Verificamos que el evento existe y se puede despachar
      event(new UserFollowed($this->follower, $this->followed));

      Event::assertDispatched(UserFollowed::class, function ($event) {
        return $event->follower->id === $this->follower->id
          && $event->followed->id === $this->followed->id;
      });
    }

    /**@test */
    public function test_follow_xp_reward_only_given_once(): void
    {
      // follow_rewards garantiza que el xp solo se otorga la primera vez
      Follow::create([
        'follower_id' => $this->follower->id,
        'following_id' => $this->following->id,
      ]);

      event(new UserFollowed($this->follower, $this->followed));

      app(HandleFollow::class)->handle($event);

      // Borrar follow y volver a crear
      Follow::where('follower_id', $this->follower->id)
        ->where('following_id', $this->following->id)
        ->delete();

      Follow::create([
        'follower_id' => $this->follower->id,
        'following_id' => $this->following->id,
      ]);

      app(HandleFollow::class)->handle($event);

      $this->follower->refresh();

      $this->assertEquals(2, $this->follower->xp,
        'Follow XP should only be awarded once per follower/followed pair'
      );
    }
}
