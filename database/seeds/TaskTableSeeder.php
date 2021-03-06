<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Language;
use App\Task;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::find(1);
        $language = Language::find(1);

        Task::create([
            'id' => 1,
            'name' => 'First task',
            'description' => 'My first new task',
            'user_id' => $user->id,
            'language_id' => $language->id,
        ]);
    }
}
