<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 11/02/16
 * Time: 10:35.
 */
namespace app\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Task;
use App\User;

class TaskController extends Controller
{
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $tasks = User::findOrNew($this->user)->tasks;

        return response()->json($tasks);
    }

    /**
     * Return all tasks.
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
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @api {get} /tasks/:id Get a task.
     * @apiPermission login
     *
     * @apiHeader {String} authorization Authorization value.
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/tasks/1
     * @apiVersion 0.1.0
     *
     */

    /**
     * @param $uid
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function task($uid)
    {
        $task = Task::findOrNew($uid);

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
     * @param $uid
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
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
     * Create a task.
     *
     * @apiGroup Task
     * @apiName PutTask
     *
     * @api {put} /tasks/:id Update a task.
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
     * @apiSampleRequest http://localhost:80/api/v0_01/tasks/1
     * @apiVersion 0.1.0
     *
     */

    /**
     * @param array $attributes
     * @param array $options
     * @return mixed
     */
    public function update(array $attributes = [], array $options = [])
    {
        return parent::update($attributes, $options); // TODO: Change the autogenerated stub
    }
    /*public function updateTask(Request $request, $id) {
        $task = Task::findOrNew($id);

        $task->name = $request->input('name');
        $task->description = $request->input('description');

        $task->save();

        return response()->json($task);
    }*/

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
     * @param $uid
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroyTask($uid)
    {
        $task = Task::findOrNew($uid);
        $deleted = $task->delete();

        return response()->json(array('success' => $deleted));
    }
}
