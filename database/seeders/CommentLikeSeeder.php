<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CommentLike; // Import CommentLike model
use App\Models\Comment;     // Import Comment model
use App\Models\User;        // Import User model

class CommentLikeSeeder extends Seeder {
    public function run() {
        $users = User::all();
        $comments = Comment::all();

        if ($users->count() == 0 || $comments->count() == 0) {
            $this->command->info('No users or comments found, skipping CommentLikeSeeder.');
            return;
        }

        foreach ($comments as $comment) {
            CommentLike::factory(rand(1, 5))->create([
                'comment_id' => $comment->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
