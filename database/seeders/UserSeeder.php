<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;

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
        $firstUser = User::create([
            'name' => 'yasmine',
            'email' => 'yasmineeb@gmail.com',
            'password' => Hash::make('111111'),
        ]);


        $firstUser->tasks()->createMany([
            ['title' => 'English Study', 'description' => 'Read chapter 3 and 4', 'due_date' => now()->addHours(2)],
            ['title' => 'Coding Task', 'description' => 'Finish Laravel CRUD', 'due_date' => now()->addDays(1)],
            ['title' => 'Math Homework', 'description' => 'Solve 10 exercises', 'due_date' => now()->addHours(5)],
            ['title' => 'Physics Revision', 'description' => 'Review orbital mechanics', 'due_date' => now()->addDays(2)],
            ['title' => 'Chemistry Lab', 'description' => 'Prepare experiment report', 'due_date' => now()->addHours(6)],
            ['title' => 'History Essay', 'description' => 'Write about WW2', 'due_date' => now()->addDays(3)],
            ['title' => 'Art Project', 'description' => 'Sketch landscape', 'due_date' => now()->addHours(8)],
            ['title' => 'Spanish Practice', 'description' => 'Learn 20 new words', 'due_date' => now()->addDays(4)],
            ['title' => 'Computer Science Quiz', 'description' => 'Revise algorithms', 'due_date' => now()->addHours(7)],
            ['title' => 'Gym Session', 'description' => 'Leg day workout', 'due_date' => now()->addHours(9)],
        ]);



        $secondUser = User::create([
            'name' => 'Maya',
            'email' => 'maya@gmail.com',
            'password' => Hash::make('111111'),
        ]);
        $secondUser->tasks()->createMany([
                ['title' => 'Task 1', 'description' => 'English study', 'due_date' => now()->addHours(1)],
                ['title' => 'Task 2', 'description' => 'reading book', 'due_date' => now()->addHour(4)],
                ['title' => 'Task 3', 'description' => 'cooking', 'due_date' => now()->addHours(3)],
            ]);
    }
}
