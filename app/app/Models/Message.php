<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
      'sender_id',
      'receiver_id',
      'content',
      'status',
      'read_at',
      'created_at',
    ];

    protected $casts = [
      'read_at' => 'datetime',
    ];

    public function sender()
    {
      return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
      return $this->belongsTo(User::class, 'receiver_id');
    }

    public static function conversation(int $userA, int $userB)
    {
      return static::where(function ($q) use ($userA, $userB) {
        $q->where('sender_id', $userA)
        ->where('receiver_id', $userB);
      })->orWhere(function ($q) use ($userA, $userB) {
        $q->where('sender_id', $userB)
        ->where('receiver_id', $userA);
      })->oldest();
    }
}
