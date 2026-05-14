<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = [
      'name',
      'game_id',
      'owner_id',
      'slug',
      'description',
      'image',
    ];

    public function users()
    {
      return $this->belongsToMany(User::class, 'community_users')->withPivot('role');
    }

    public function owner()
    {
      return $this->belongsTo(User::class, 'owner_id');
    }

    public function game()
    {
      return $this->belongsTo(Game::class);
    }

    public function posts()
    {
      return $this->hasMany(CommunityPost::class);
    }
}
