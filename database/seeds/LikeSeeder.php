<?php

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Run like seeder...');

        $users = User::all();
        $posts = Post::all();
        $totalPosts = count($posts);
        $comments = Comment::all();
        $totalComments = count($comments);        

        foreach ($users as $user) {
        	$totalPostsLikedByUser = rand(1, $totalPosts);

        	for ($i = 1; $i <= $totalPostsLikedByUser; $i++) {
        		$post = $posts[$i - 1];
                
                $post->likes()->create([
                    'user_id' => $user->id,
                ]);
        	}

            $totalCommentsLikedByUser = rand(1, $totalComments);

            for ($i = 1; $i <= $totalCommentsLikedByUser; $i++) {
                $comment = $comments[$i - 1];
                
                $comment->likes()->create([
                    'user_id' => $user->id,
                ]);
            }
        }

        $this->command->info('Success!');
    }
}
