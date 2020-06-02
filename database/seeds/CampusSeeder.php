<?php

use App\Campus;
use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Run campus seeder...');

        $campuses = array('Kemanggisan', 'Bekasi', 'Alam Sutera', 'JWC', 'Bandung', 'Malang');
        $campusesAmount = count($campuses);

        for ($i = 0; $i < $campusesAmount; $i++) {
        	$campus = new Campus;
        	$campus->name = $campuses[$i];
        	$campus->save();
        }

        $this->command->info('Success!');
    }
}
