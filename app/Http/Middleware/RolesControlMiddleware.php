<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\AuthController as Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\RolesController;;

class RolesControlMiddleware
{
    private $role;

    public function __construct()
    {
        $this->role = new RolesController();
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
        if(!$this->checkRole($request)) {
          return response('Unauthorized.', 401);
        };
        return $next($request);
    }

    public function checkRole(Request $request)
    {
        // Get token
        $token = $this->getToken($request);

        if (!$token) {
            return false;
        }

        // Get user Role: key='role'.token, value=idRole
        $idRole = Cache::get('role'.$token);
        $role = $this->role->getRole($idRole);

        // Get allowed roles for the request
        $actions = $request->route();
        $allowedRoles = $actions[1];

        // check
        if(in_array($role, $allowedRoles['roles'])) {
            return true;
        }

        return false;

    }

    public function getToken(Request $request)
    {
        // Search Token in header
        if(!isset($request->server->all()['HTTP_AUTHORIZATION'])) {
            return false;
        }

        $authorization_hash = explode(" ", $request->server->all()['HTTP_AUTHORIZATION']);

        if($authorization_hash[0] != 'Bearer') {
            return false;
        }

        return $authorization_hash[1];
    }

}
