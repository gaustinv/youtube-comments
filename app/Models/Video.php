<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * Get all of the comments for the video.
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
