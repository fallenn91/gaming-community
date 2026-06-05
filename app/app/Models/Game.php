<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
      'name',
      'slug',
      'cover',
      'description',
      'genre',
      'created_at',
    ];

    public function users()
    {
      return $this->belongsToMany(User::class, 'user_games')->withPivot('status', 'hours_played')->withTimestamps();
    }
}
