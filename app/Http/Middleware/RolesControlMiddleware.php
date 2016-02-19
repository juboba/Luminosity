<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Role;
use App\Service\TokenService;

class RolesControlMiddleware
{
    private $role;
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
        // this method check if loged user has the role that allow get the request

        if(!$this->isUserAllowed($request)) {
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
    public function isUserAllowed (Request $request)
    {
        // Get token
        $cache = app(TokenService::class);
        $token = $cache->getTokenFromRequest($request);

        if (!$cache) {
            return false;
        }

        // Get user in cache
        $serializeUser = Cache::get($token);
        $user = unserialize($serializeUser);

        // Get rol name
        $role = Role::find($user->role_id);
        $rolname = $role->name;

        // Get allowed roles for the request
        $actions = $request->route();
        $allowedRoles = $actions[1];

        // check
        if(in_array($rolname, $allowedRoles['roles'])) {
            return true;
        }

        return false;

    }



}
