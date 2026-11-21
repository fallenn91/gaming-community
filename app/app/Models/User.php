<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
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
        'role_id',
        'community_id',
        'email',
        'password',
        'avatar',
        'banner',
        'bio',
        'level',
        'xp',
        'reputation',
        'followers_count',
        'following_count',
        'is_online',
        'last_seen',
        'can_create_communities',
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

    public function isAdmin(): bool
    {
        return $this->role_id === 1;
    }

    public function role()
    {
      return $this->belongsTo(Role::class);
    }

    public function isOnline(): bool
    {
        return $this->last_seen && $this->last_seen->gt(now()->subMinutes(5));
    }

    public function userStat()
    {
      return $this->hasOne(UserStat::class);
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

    public function games()
    {
      return $this->belongsToMany(Game::class, 'user_games')->withPivot('status', 'hours_played')->withTimestamps();
    }

    public function achievements()
    {
      return $this->belongsToMany(Achievement::class, 'user_achievements')
        ->withPivot('unlocked_at');
    }

    public function communities()
    {
      return $this->belongsToMany(Community::class)->withPivot('role')->withTimestamps();
    }

    public function ownedCommunities()
    {
      return $this->hasMany(Community::class, 'owner_id');
    }

    public function communityModeration()
    {
      return $this->hasMany(CommunityModeration::class);
    }
}
