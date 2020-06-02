<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Run post seeder...');

        $users = User::all();

        factory(Post::class, 30)->make()->each(
        	function ($post) use ($users) {
        		$post->user_id = $users->random()->id;
        		$post->save();
        	}
        );

    	$this->command->info('Success!');
    }
}
