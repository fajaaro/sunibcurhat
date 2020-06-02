<?php

use App\Campus;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Run user seeder...');

        factory(User::class)->states('user-fajar')->create();

        $campuses = Campus::all();
        $genders = array('Male', 'Female');

        factory(User::class, 15)->make()->each(
        	function ($user) use ($campuses, $genders) {
        		$user->campus_id = $campuses->random()->id;
        		$user->gender = $genders[rand(0, 1)];
        		$user->save();
        	}
        );

        $this->command->info('Success!');
    }
}
