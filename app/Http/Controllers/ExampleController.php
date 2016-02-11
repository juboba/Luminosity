<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Contracts\Queue\Job;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function get($task_id)
    {
        $task = $this->search(Task::class, $task_id);

        $tasks = $task->user;

        return $this->buildResponse($tasks, 200);
    }
}
