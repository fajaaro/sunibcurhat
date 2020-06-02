<?php

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class DislikeSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Run dislike seeder...');

        $users = User::all();
        $posts = Post::all();
        $totalPosts = count($posts);
        $comments = Comment::all();
        $totalComments = count($comments);        

        foreach ($users as $user) {
        	$totalPostsDislikedByUser = rand(1, $totalPosts);

        	for ($i = 1; $i <= $totalPostsDislikedByUser; $i++) {
        		$post = $posts[$i - 1];
                
                $post->dislikes()->create([
                    'user_id' => $user->id
                ]);
        	}

            $totalCommentsDislikedByUser = rand(1, $totalComments);

            for ($i = 1; $i <= $totalCommentsDislikedByUser; $i++) {
                $comment = $comments[$i - 1];
                
                $comment->dislikes()->create([
                    'user_id' => $user->id
                ]);
            }
        }

        $this->command->info('Success!');
    }
}
