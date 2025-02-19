<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    /**
     * The comment that the like belongs to.
     */
    public function comment() {
        return $this->belongsTo(Comment::class);
    }

    /**
     * The user that the like belongs to.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
