<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addUsers = [[
            "name"=>"Jay Patel",
            "email"=>"jay@yopmail.com",
            "password"=>Hash::make('Admin@123!')
        ],[
            "name"=>"krishna patel",
            "email"=>"krishna@yopmail.com",
            "password"=>Hash::make('Admin@123!')
        ],
        [
            "name"=>"bhargav patel",
            "email"=>"bhargav@yopmail.com",
            "password"=>Hash::make('Admin@123!')
        ],
        [
            "name"=>"kishan patel",
            "email"=>"kishan@yopmail.com",
            "password"=>Hash::make('Admin@123!')
        ],
        [
            "name"=>"kairav patel",
            "email"=>"kairav@yopmail.com",
            "password"=>Hash::make('Admin@123!')
        ],
        [
            "name"=>"janvi patel",
            "email"=>"janvi@yopmail.com",
            "password"=>Hash::make('Admin@123!')
        ]];
        foreach($addUsers as $user){
            User::create($user);
        }
       
    }
}
