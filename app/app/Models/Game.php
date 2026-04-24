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

    public function user()
    {
      return $this->belongsToMany(User::class, 'user_games');
    }
}
