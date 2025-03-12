<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;


class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        $workCategory = Category::where('name','work')->first();
        $personalCategory = Category::where('name','personal')->first();

        Task::create([
            'user_id' => $user->id,
            'category_id' => $workCategory->id,
            'name' => 'Work sample 1',
            'detail' => 'Sample task for work 1',
            'deadline' => now()->format('Y-m-d'),
            'status' => 'pending'
        ]);
        Task::create([
            'user_id' => $user->id,
            'category_id' => $personalCategory->id,
            'name' => 'Personal sample 1',
            'detail' => 'Sample personal task 1',
            'deadline' => now()->format('Y-m-d'),
            'status' => 'completed'
        ]);

        Task::create([
            'user_id' => $user->id,
            'category_id' => $workCategory->id,
            'name' => 'Work sample 2',
            'detail' => 'Sample task for work 2',
            'deadline' => now()->addDays(1)->format('Y-m-d'),
            'status' => 'pending'
        ]);
        Task::create([
            'user_id' => $user->id,
            'category_id' => $personalCategory->id,
            'name' => 'Personal sample 2',
            'detail' => 'Sample personal task 2',
            'deadline' => now()->addDays(1)->format('Y-m-d'),
            'status' => 'completed'
        ]);
    }
}
