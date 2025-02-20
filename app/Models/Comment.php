<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    /**
     * Get all of the comment's replies.
     */
    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * The video that the comment belongs to.
     */
    public function video() {
        return $this->belongsTo(Video::class);
    }

    /**
     * Get the user that owns the comment.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the likes for the comment.
     */
    public function likes() {
        return $this->hasMany(CommentLike::class);
    }
}
