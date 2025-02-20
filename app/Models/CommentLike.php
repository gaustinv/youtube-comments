<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentLike extends Model
{
    use HasFactory;

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
