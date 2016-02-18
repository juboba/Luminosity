<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\AuthController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\RolesController;
use App\Role;

class RolesControlMiddleware
{
    private $role;
    private $authController;

    public function __construct()
    {
        $this->authController = new AuthController();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // this method check if loged user has the role that allow get the request

        if(!$this->isUserAllowed($request)) {
          return response('Unauthorized.', 401);
        };
        return $next($request);
    }

    public function isUserAllowed (Request $request)
    {
        // Get token
        $token = $this->authController->getToken($request);  // BAD: waiting Aureo changes

        if (!$token) {
            return false;
        }

        // Get user in cache
        $serializeUser = Cache::get($token);
        $user = unserialize($serializeUser);

        // Get rol name
        $idRole = $user->role;
        $role = Role::find($idRole);
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
