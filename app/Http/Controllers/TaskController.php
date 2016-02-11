<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param $task_id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws NotFoundResourceException
     */
    public function get($task_id)
    {
        //$task = Task::find($task_id);
        $task = $this->search(Task::class, $task_id);
        if (null === $task)
        {
            return $this->ErrorResponse('ERROR: Invalid task', 400);
        }


        return $this->buildResponse($task, 200);
    }

    /**
     * @param $task_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUser($task_id)
    {
        $user = Task::find($task_id)->user;

        if (null === $user)
        {
            return $this->ErrorResponse('ERROR: Invalid user', 400);
        }
        return $this->buildResponse($user, 200);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        $this->check($request);

        Task::create($request->all());
        return $this->buildResponse('New task create', 201);
    }

    /**
     * @param $task_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete($task_id)
    {
        $task = Task::find($task_id);

        if (null === $task)
        {
            return $this->ErrorResponse('ERROR: Task no exist', 404);
        }

        $task->delete();

        $txtResponse = 'User: '. $task_id . ' deleted.';
        return $this->buildResponse($txtResponse, '200');
    }

    /**
     * @param Request $request
     */
    public function check(Request $request)
    {
        $rules =
            [
                'name' => 'required|in:task1,task2,task3',
                'id_user' => 'required|integer'

            ];

        $this->validate($request, $rules);
    }

}
