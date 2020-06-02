<?php

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Run comment seeder...');

    	$users = User::all();
    	$posts = Post::all();

    	factory(Comment::class, 100)->make()->each(
    		function ($comment) use ($users, $posts) {
    			$comment->user_id = $users->random()->id;
    			$comment->post_id = $posts->random()->id;
    			$comment->save();
    		}
    	);

    	$this->command->info('Success!');
    }
}
