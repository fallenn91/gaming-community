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
        'bio',
        'level',
        'xp',
        'is_online',
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
            'password' => 'hashed',
        ];
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
      return $this->hasMany(Message::class, 'receiver:id');
    }

    public function notifications()
    {
      return $this->hasMany(Notification::class);
    }

    public function games()
    {
      return $this->belongsToMany(Game::class, 'user_games');
    }
}
