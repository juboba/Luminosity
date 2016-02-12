<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 11/02/16
 * Time: 10:35
 */

namespace App\Http\Controllers;


use App\Task;
use App\User;
use Illuminate\Http\Request;

class TaskController extends Controller {
    protected $user = 1;
    /*
     * Return tasks that belongs to the loggined user.
     */
    public function index() {
        $tasks = User::findOrNew($this->user)->tasks;
        return response()->json($tasks);
    }

    /*
     * Return the specific task
     */
    public function task($id) {
        $task = Task::findOrNew($id);
        return response()->json($task);
    }

    /*
     * Create task
     */
    public function store(Request $request) {
        $user = User::findOrNew($this->user);

        $task = $user->tasks()->create([
            'name' => $request->name,
            'language_id' => $request->language_id,
            'description' => $request->description
        ]);

        return response()->json($task);

    }

    public function updateTask(Request $request, $id) {
        $task = Task::findOrNew($id);

        $task->name = $request->input('name');
        $task->description = $request->input('description');

        $task->save();

        return response()->json($task);

    }

    public function destroyTask($id) {
        $task = Task::findOrNew($id);

        $deleted = $task->delete();

        return response()->json($deleted);

    }

}