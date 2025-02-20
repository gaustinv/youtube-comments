<?php
namespace Database\Factories;

use App\Models\CommentLike;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentLikeFactory extends Factory {
    protected $model = CommentLike::class;

    public function definition() {
        return [
            'type' => $this->faker->randomElement(['like', 'dislike']),
        ];
    }
}
