<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'banner',
        'bio',
        'level',
        'xp',
        'is_online',
        'last_seen',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_seen' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
      return $this->belongsTo(Role::class);
    }

    public function isOnline(): bool
    {
        return $this->last_seen && $this->last_seen->gt(now()->subMinutes(5));
    }

    public function getXpInLevelAttribute()
    {
        $currentLevelXp = ($this->level * $this->level) * 100;

        return $this->xp - $currentLevelXp;
    }

    public function xpForNextLevel(): int
    {
      $nextLevel = $this->level + 1;

      return ($nextLevel * $nextLevel) * 100;
    }

    public function posts()
    {
      return $this->hasMany(Post::class);
    }

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }

    public function likes()
    {
      return $this->hasMany(Like::class);
    }

    public function followers()
    {
      return $this->belongsToMany(
        User::class, 'follows',
        'following_id',
        'follower_id',
      );
    }

    public function following()
    {
      return $this->belongsToMany(
        User::class,
        'follows',
        'follower_id',
        'following_id',
      );
    }

    public function messagesSent()
    {
      return $this->hasMany(Message::class, 'sender_id');
    }

    public function messagesReceived()
    {
      return $this->hasMany(Message::class, 'receiver_id');
    }

    public function notifications()
    {
      return $this->hasMany(Notification::class);
    }

    public function games()
    {
      return $this->belongsToMany(Game::class, 'user_games');
    }

    public function achievements()
    {
      return $this->belongsToMany(Achievement::class, 'user_achievements')
        ->withPivot('progress', 'unlocked_at');
    }

    public function getAchievementLevelAttribute(): int
    {
      return (int) floor(sqrt($this->xp / 100));
    }
}
