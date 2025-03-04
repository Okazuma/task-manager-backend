<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;

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

        Task::create([
            'user_id' => $user->id,
            'name' => 'サンプル１',
            'detail' => '1つ目のサンプルタスクです.',
            'deadline' => now()->addDays(3)->format('Y-m-d'),
            'status' => 'pending'
        ]);
        Task::create([
            'user_id' => $user->id,
            'name' => 'サンプル２',
            'detail' => '２つ目のサンプルタスクです.',
            'deadline' => null,
            'status' => 'completed'
        ]);
    }
}
