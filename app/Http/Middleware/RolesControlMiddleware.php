<?php

/**
 * Roles control middleware.
 */

namespace App\Http\Middleware;

use App\Facades\Token;
use Closure;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Role;

/**
 * Class RolesControlMiddleware.
 *
 * @package App\Http\Middleware
 */
class RolesControlMiddleware
{
    /**
     * @var AuthController Authentication controller.
     */
    private $authController;

    /**
     * RolesControlMiddleware constructor.
     */
    public function __construct()
    {
        $this->authController = new AuthController();
    }

    /**
     * Middleware handle.
     *
     * @param Request $request The request.
     * @param Closure $next
     *
     * @return \Laravel\Lumen\Http\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->isUserAllowed($request)) {
            return response('Unauthorized.', 401);
        };

        return $next($request);
    }

    /**
     * This method checks if the logged user has a role that allows to get the request.
     *
     * @param Request $request The request.
     *
     * @return bool True if the user is allowed. False otherwise.
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
