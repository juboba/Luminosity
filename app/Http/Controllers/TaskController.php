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

    /*
     * Return tasks that belongs to the loggined user.
     */
    public function index() {
        $tasks = User::findOrNew(1)->tasks;
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
        $user = User::findOrNew(1);

        /*$request->user()->tasks()->create([
            'name' => $request->name,
        ]);*/

        $created = $user->tasks()->create([
            'name' => $request->name,
            'description' => $request->description,
            'language_id' => $request->language_id
        ]);

        return response()->json($created);

    }
}