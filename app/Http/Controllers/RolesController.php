<?php

/**
 * Roles API controller.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;

/**
 * Class RolesController.
 *
 * @package App\Http\Controllers
 */
class RolesController extends Controller
{
    /**
     * Return all user and their roles.
     *
     * @apiGroup Roles
     * @apiName GetRoles
     * @api {get} /roles Get all user and their roles.
     * @apiHeader {String} authorization Authorization value.
     * @apiExample {curl} Example usage:
     *     curl -i -H "Authorization:Bearer <token>" http://localhost:80/roles
     *
     * @apiSampleRequest http://localhost:80/roles
     */

    /**
     * Get all users and their roles.
     *
     * @return \Symfony\Component\HttpFoundation\Response Returns the users list.
     */
    public function show()
    {
        $users = User::all();
        foreach ($users as $user) {
            $jsonUser[] = [$user->name => $user->role->name];
        }

        return response()->json($jsonUser);
    }
}
