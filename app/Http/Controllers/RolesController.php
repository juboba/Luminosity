<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;

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
    public function show()
    {
        //$users = DB::table('users')->get();
        $users = User::all();
        foreach ($users as $user) {
            $jsonUser[] = [$user->name => $user->roles->name];
        }

        return response()->json($jsonUser);
    }
}
