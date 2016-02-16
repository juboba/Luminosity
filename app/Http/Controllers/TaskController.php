<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 11/02/16
 * Time: 10:35
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CreateTaskJob;
use App\Task;
use App\User;

class TaskController extends Controller {
    protected $user = 1;

    /**
     * Return all tasks.
     *
     * @apiGroup Task
     * @apiName GetTasks
     * @api {get} /tasks Get all tasks.
     * @apiHeader {String} authorization Authorization value.
     * @apiExample {curl} Example usage:
     *     curl -i -H "Authorization:Bearer <token>" http://localhost:80/api/v0_01/tasks
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/tasks
     */
    public function index() {
        $tasks = User::findOrNew($this->user)->tasks;
        return response()->json($tasks);
    }

    /**
     * Return all tasks.
     *
     * @apiGroup Task
     * @apiName GetTasks
     * @api {options} /tasks Get allowed methods.
     * @apiHeader {String} authorization Authorization value.
     * @apiExample {curl} Example usage:
     *     curl -i -X OPTIONS -H "Authorization:Bearer <token>" http://localhost:80/api/v0_01/tasks
     *
     */
    public function options() {
        $methods = array('options', 'get', 'post');

        return response()->json($methods);
    }

    /**
     * Return the specific task.
     *
     * @apiGroup Task
     * @apiName GetTask
     * @api {get} /tasks/:id Get a task.
     * @apiHeader {String} authorization Authorization value.
     * @apiExample {curl} Example usage:
     *     curl -i -H "Authorization:Bearer <token>" http://localhost:80/api/v0_01/tasks/1
     */
    public function task($id) {
        $task = Task::findOrNew($id);
        return response()->json($task);
    }

    /**
     * Return the tasks for a user given.
     *
     * @apiGroup Task
     * @apiName GetUserTasks
     * @api {get} /user/:id/tasks Get all tasks assigned to an user.
     * @apiHeader {String} authorization Authorization value.
     * @apiExample {curl} Example usage:
     *     curl -i -H "Authorization:Bearer <token>" http://localhost:80/api/v0_01/user/1/tasks
     * @apiIgnore Route not yet implemented.
     */
    public function allForUser($uid) {
        $response = User::find($uid)->tasks()->get();
        return response()->json($response, 200);
    }

    /**
     * Create a task.
     *
     * @apiGroup Task
     * @apiName PostTask
     * @api {post} /tasks Create a task.
     * @apiPermission login
     *
     * @apiHeader {String} authorization Authorization value.
     * @apiParam {String} name Mandatory task name.
     * @apiParam {String} description Mandatory task description.
     * @apiParam {Number} language_id Mandatory language ID.
     *
     * @apiSuccess {String} name Task name.
     * @apiSuccess {String} description Task description.
     * @apiSuccess {Number} language_id Language ID.
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/tasks
     */
    public function store(Request $request) {
//        $user = User::findOrNew(1);
//
//        /*$request->user()->tasks()->create([
//            'name' => $request->name,
//        ]);*/
//
//        $created = $user->tasks()->create([
//            'name' => $request->name,
//            'description' => $request->description,
//            'language_id' => $request->language_id
//        ]);
//
//        return response()->json($created);

        $job = (new CreateTaskJob($request->all()))->onQueue('tasks');
        $this->dispatch($job);

        return response()->json(array('success' => true));
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
