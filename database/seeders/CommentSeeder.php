<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment; // Import Comment model
use App\Models\User;    // Import User model
use App\Models\Video;   // Import Video model

class CommentSeeder extends Seeder {
    public function run() {
        $users = User::all();
        $videos = Video::all();

        if ($users->count() == 0 || $videos->count() == 0) {
            $this->command->info('No users or videos found, skipping CommentSeeder.');
            return;
        }

        foreach ($videos as $video) {
            Comment::factory(5)->create([
                'video_id' => $video->id,
                'user_id' => $users->random()->id,
                'parent_id' => null,
            ]);
        }
    }
}
