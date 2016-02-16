<?php namespace App\Http\Middleware;

// First copy this file into your middleware directoy

use Closure;
use App\User;
use Illuminate\Http\Request;

class CheckRole{

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $id)
	{
		// Get the required roles from the route
		$roles = $this->getRequiredRoleForRoute($request->route());
		var_dump($roles);
		echo $id;
		die;
		// Check if a role is required for the route, and
		// if so, ensure that the user has that role.
		if($request->user()->hasRole($roles) || !$roles)
		{
			return $next($request);
		}

		return response([
			'error' => [
				'code' => 'INSUFFICIENT_ROLE',
				'description' => 'You are not authorized to access this resource.'
			]
		], 401);

	}

	private function getRequiredRoleForRoute($route)
	{

		$actions = $route[1]; //$route->getAction();
		return isset($actions['roles']) ? $actions['roles'] : null;

	}

}