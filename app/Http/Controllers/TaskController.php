<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 11/02/16
 * Time: 10:35.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use App\Jobs\CreateTaskJob;

/**
 * Class TaskController.
 * Controller for Task API.
 *
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{
    /**
     * @var int Current user ID.
     */
    protected $user = 1;

    /**
     * Return all tasks.
     *
     * @apiGroup Task
     * @apiName GetTasks
     *
     * @api {get} /tasks Get all tasks.
     * @apiPermission login
     *
     * @apiHeader {String} authorization Authorization value.
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/tasks
     * @apiVersion 0.1.0
     */

    /**
     * Get all tasks assigned to the current user.
     *
     * @return \Symfony\Component\HttpFoundation\Response Returns the tasks list.
     */
    public function index()
    {
        $tasks = User::findOrNew($this->user)->tasks;

        return response()->json($tasks);
    }

    /**
     * Return allowed methods.
     *
     * @apiGroup Task
     * @apiName TasksOptions
     *
     * @api {options} /tasks Get allowed methods.
     * @apiPermission login
     *
     * @apiHeader {String} authorization Authorization value.
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/tasks
     * @apiVersion 0.1.0
     */

    /**
     * Get allowed methods.
     *
     * @return \Symfony\Component\HttpFoundation\Response Returns the method names list.
     */
    public function options()
    {
        $methods = array('options', 'get', 'post');

        return response()->json($methods);
    }

    /**
     * Return the specific task.
     *
     * @apiGroup Task
     * @apiName GetTask
     *
     * @api {get} /tasks/:id{?language=true} Get a task.
     * @apiPermission login
     *
     * @apiHeader {String} authorization Authorization value.
     * @apiParam {Boolean} Language Add the language object to the response (Optional).
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/tasks/1
     * @apiVersion 0.1.0
     *
     */

    /**
     * Get a specific task.
     *
     * @param Request $request The request.
     * @param int $tid Task ID.
     *
     * @return \Symfony\Component\HttpFoundation\Response Returns the task.
     */

    public function task(Request $request, $tid)
    {
        $task = Task::findOrFail($tid);

        if ($task) {
            if ($request->get('language')) {
                // Include the language object.
                $task->language;
            }
        }

        return response()->json($task);
    }

    /**
     * Return the tasks for a user given.
     *
     * @apiGroup Task
     * @apiName GetUserTasks
     *
     * @api {get} /user/:id/tasks Get all tasks assigned to an user.
     * @apiPermission login
     *
     * @apiHeader {String} authorization Authorization value.
     * @apiExample {curl} Example usage:
     *     curl -i -H "Authorization:Bearer <token>" http://localhost:80/api/v0_01/user/1/tasks
     * @apiVersion 0.1.0
     * @apiIgnore Route not yet implemented.
     */

    /**
     * Get all tasks assigned to an user.
     *
     * @param int $uid User ID.
     *
     * @return \Symfony\Component\HttpFoundation\Response Returns the tasks list.
     */
    public function allForUser($uid)
    {
        $response = User::find($uid)->tasks()->get();

        return response()->json($response, 200);
    }

    /**
     * Create a task.
     *
     * @apiGroup Task
     * @apiName PostTask
     *
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
     * @apiVersion 0.1.0
     */

    /**
     * Create a new task.
     * Adds a job to the queue to create a new task.
     *
     * @param Request $request The request.
     *
     * @return \Symfony\Component\HttpFoundation\Response Always 'success' true.
     */
    public function store(Request $request)
    {
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


    /**
     * Update a task.
     *
     * @apiGroup Task
     * @apiName PutTask
     *
     * @api {post} /tasks/{uid}/{tid} Update an specific task.
     * @apiPermission login
     *
     * @apiHeader {String} authorization Authorization value.
     *
     * @apiParam {String} name Mandatory task name.
     * @apiParam {String} description Mandatory task description.
     * @apiParam {Number} language_id Mandatory language ID.
     *
     * @apiSuccess {String} name Task name.
     * @apiSuccess {String} description Task description.
     * @apiSuccess {Number} language_id Language ID.
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/tasks/1/1
     * @apiVersion 0.1.0
     */

    /**
     * Update a task.
     *
     * @param Request $request The request.
     * @param int $uid User ID.
     * @param int $tid Task ID.
     *
     * @return \Symfony\Component\HttpFoundation\Response Returns the task updated.
     */
    public function update(Request $request, $uid, $tid)
    {
        $task = User::findOrFail($uid)->tasks()->find($tid);

        $attributes = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ];

        return response()->json($task->update($attributes), 200);
    }

    /**
     * Return all tasks.
     *
     * @apiGroup Task
     * @apiName DeleteTask
     *
     * @api {delete} /tasks/:id Delete a task.
     * @apiPermission login
     *
     * @apiHeader {String} authorization Authorization value.
     *
     * @apiSuccess {Boolean} success Whether the task was deleted or not.
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/tasks/1
     * @apiVersion 0.1.0
     */

    /**
     * Deletes a task.
     *
     * @param int $uid User ID.
     *
     * @return \Symfony\Component\HttpFoundation\Response Returns a boolean for 'success'.
     */
    public function destroyTask($uid)
    {
        $task = Task::findOrFail($uid);
        $deleted = $task->delete();

        return response()->json(array('success' => $deleted));
    }
}
