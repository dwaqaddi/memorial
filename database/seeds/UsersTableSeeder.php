<?php
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Let's clear the users table first
        User::truncate();

        $faker = \Faker\Factory::create();

        // Let's make sure everyone has the same password and 
        // let's hash it before the loop, or else our seeder 
        // will be too slow.
        $password = Hash::make('toptal');

        User::create([
            'userEmail' => 'admin@test.com',
            'userPassword' => $password, 
            'userFName' => 'Administrator F', 
            'userMName' => 'Administrator M',
            'userLNAME' => 'Administrator L',
            'userMobileNumber'=> 'Administrator', 
            'userAddress1' => 'Add 1', 
            'userAddress2' => 'Add 2', 
            'userIsUserVerified' => '0', 
            'userIsActive' => '0', 
        ]);

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'userEmail' => $faker->email,
                'userPassword' => $password, 
                'userFName' => $faker->firstname,
                'userMName' => $faker->lastName,
                'userLNAME' => $faker->lastname,
                'userMobileNumber'=> $faker->e164PhoneNumber,
                'userAddress1' => $faker->address,
                'userAddress2' => $faker->country, 
                'userIsUserVerified' => false, 
                'userIsActive' => false,
            ]);
        }
    }
}

