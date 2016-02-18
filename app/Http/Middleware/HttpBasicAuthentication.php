<?php

namespace app\Http\Middleware;

use Closure;
use App\Http\Controllers\AuthController as Auth;

class HttpBasicAuthentication
{
    /**
     *
     **/
    protected $authController;

    /**
     * Create a new middleware instance.
     *
     * @param \Illuminate\Contracts\Auth\Factory $auth
     */
    public function __construct()
    {
        $this->authController = new Auth();
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //We don't know how we going to get user and password of the DOTW-API.
      //The best practices are that it must be in URL, but it's a problem because
      //we received the request, we can't proccess the URL

      //In this case we enter the user and the password on the body of the request.
      //It must be encrypted.

      // Firstly check if user:password is in caché. If not is in caché
        //(ElastiCaché in AWS), make new request to authorize of the DOWT API.
        //* If token has expired make new request to authorize of the DOWT API.
        //* If token is correct pass $request to Closure $next

        /*if($request->getUser() != env('API_USERNAME') && $request->getPassword() != env('API_PASSWORD')) {
            $headers = array('WWW-Authenticate' => 'Basic');
            return response('Unauthorized', 401, $headers);
        }*/

        if (!$this->authController->checkAuthorization($request)) {
            return response('Unauthorized.', 401);
        };

        return $next($request);
    }
}
