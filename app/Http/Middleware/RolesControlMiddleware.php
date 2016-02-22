<?php

namespace App\Http\Middleware;

use App\Facades\Token;
use Closure;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Role;

class RolesControlMiddleware
{
    private $authController;

    /**
     * RolesControlMiddleware constructor.
     */
    public function __construct()
    {
        $this->authController = new AuthController();
    }

    /**
     * Middleware handle
     *
     * @param Request $request
     * @param Closure $next
     * @return \Laravel\Lumen\Http\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // this method check if logged user has the role that allow get the request

        if (!$this->isUserAllowed($request)) {
            return response('Unauthorized.', 401);
        };
        return $next($request);
    }

    /**
     * check if loged user has the role that allow get the request
     *
     * @param Request $request
     * @return bool
     */
    public function isUserAllowed(Request $request)
    {
        // Get token

        $token = Token::getTokenFromRequest($request);

        if (!$token) {
            return false;
        }

        // Get user in cache
        $serializeUser = Cache::get($token);
        $user = unserialize($serializeUser);

        // Get rol name
        $role = Role::find($user->role_id);
        $rolename = $role->name;

        // Get allowed roles for the request
        $actions = $request->route();
        $allowedRoles = $actions[1];

        // check
        if (in_array($rolename, $allowedRoles['roles'])) {
            return true;
        }

        return false;

    }
}
