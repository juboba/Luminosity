<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 11/02/16
 * Time: 10:35
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller {
    protected $defaultRole = 'user';

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
    public function getRole($idRole) {
        $response = Role::find($idRole);

        if (!$response) {
            return $this->defaultRole; // by default role
        }
        return $response->name;
    }


    public function setUserRol(int $idRole, int $idUser)
    {
        $user = User::find($idUser);
        $user->update(['role' => $idRole]);

        return response()->json(['New IdRole' => $idRole]);
    }

    public function show()
    {
        $users = DB::table('users')->get();
        foreach($users as $user);{
            $JsonUser[] = [$user->name => $user->role];
        }
        return response()->json($JsonUser);
    }
}
