<?php

use App\Avatar;
use App\User;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Run avatar seeder...');

        $users = User::all();

        foreach ($users as $user) {
        	$avatar = new Avatar;
        	$avatar->user_id = $user->id;
        	$avatar->url = 'images/avatars/1.jpg';
        	$avatar->save();
        }

    	$this->command->info('Success!');
    }
}
