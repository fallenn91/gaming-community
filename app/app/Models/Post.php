<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Policies\PostPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'content', 
      'image', 
      'created_at',
      'updated_at',
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }

    public function likes()
    {
      return $this->hasMany(Like::class);
    }

    public function tags()
    {
      return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function communityPosts()
    {
      return $this->hasMany(CommunityPost::class);
    }
}
