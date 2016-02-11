<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;


class UserController extends Controller
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
    public function get($user_id)
    {
        $user = User::find($user_id);

        if (null === $user)
        {
            return $this->ErrorResponse('ERROR: Invalid user', 400);
        }

        //$task = $this->search(Task::class, $task_id);
        return $this->buildResponse($user, 200);
    }

    public function getTasks($user_id)
    {
        $tasks = User::find($user_id)->tasks;

        if (null === $tasks)
        {
            return $this->ErrorResponse('ERROR: Invalid task', 400);
        }

        return $this->buildResponse($tasks, 200);
    }

    public function store(Request $request)
    {
       // $this->validation($request);
        $this->check($request);

        User::create($request->all());
        return $this->buildResponse('New USER create', 201);
    }
    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if (null === $user)
        {
            return $this->ErrorResponse('ERROR: User no exist', 404);
        }

        $this->check($request);

        $name = $request->get('name');
        $surname = $request->get('surname');
        $email = $request->get('email');

        $user->name=$name;
        $user->surname=$surname;
        $user->email=$email;

        $user->save();

        $txtResponse = 'User: '. $name . ' updated.';
        return $this->buildResponse($txtResponse, '200');

    }


    public function check(Request $request)
    {
        $rules =
            [
                'name' => 'required',
                'email' => 'required',
                'birthday' => 'date',
            ];

        $this->validate($request, $rules);
    }
}
