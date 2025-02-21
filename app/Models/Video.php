<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Video extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['title', 'description'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

