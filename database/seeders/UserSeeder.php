<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "User 1",
            "password" => bcrypt('password1'),
            "email" => "user1@webtech.id",
        ]);
        User::create([
            "name" => "User 2",
            "password" => bcrypt('password 2'),
            "email" => "user2@webtech.id",
        ]);
        User::create([
            "name" => "User 3",
            "password" => bcrypt('password 3'),
            "email" => "user3@wordskill.org",
        ]);
    }
}
