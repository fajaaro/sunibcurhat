<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Run database seeder created by Fajar Hamdani...');

        $this->call(CampusSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AvatarSeeder::class);        
        $this->call(PostSeeder::class);        
        $this->call(CommentSeeder::class);        
        $this->call(LikeSeeder::class);        
        $this->call(DislikeSeeder::class);        

        $this->command->info('Finish!');
    }
}