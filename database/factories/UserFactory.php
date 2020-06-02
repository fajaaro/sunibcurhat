<?php

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('fajar123'),
        'api_token' => Str::random(80),
        'birthdate' => $faker->date(),
    ]; 
});

$factory->state(User::class, 'user-fajar', function (Faker $faker) {
    return [
    	'campus_id' => 1,
        'username' => 'fajaaro',
        'email' => 'fajarhamdani70@gmail.com',
        'password' => Hash::make('fajar123'),
        'api_token' => Str::random(80),
        'birthdate' => '2001-03-14',
        'gender' => 'Male'
    ]; 	
});
