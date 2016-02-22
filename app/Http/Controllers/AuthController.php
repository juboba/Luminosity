<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Facades\Token;
use App\User;
use App\Service\TokenService;

class AuthController extends Controller
{

    /**
     * @param Request $request
     * @return bool
     */
    public function checkAuthorization(Request $request)
    {
        $cache = app(TokenService::class);
        $token = $cache->getTokenFromRequest($request);

        return $this->existToken($token);
    }

    /**
     * Return api_token if user is authorized, otherwise return a error response.
     *
     * @apiGroup Auth
     * @apiName AuthorizeUser
     *
     * @api {get} /login Authorize user with token.
     *
     * @apiHeader {String} authorization Authorization value.
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/login
     * @apiVersion 0.1.0
     */

    /**
     * @param Request $request
     * @return \Laravel\Lumen\Http\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function authorizeUser(Request $request)
    {
        if (!isset($request->server->all()['HTTP_AUTHORIZATION'])) {
            return response('Unauthorized: You must send authorization', 401);
        }

        $authorizationHash = explode(' ', $request->server->all()['HTTP_AUTHORIZATION']);

        if ($authorizationHash[0] != 'Basic') {
                return response('Unauthorized: You must send authorization correctly', 401);
        }

        $authorization = base64_decode($authorizationHash[1]);
        $authorization = explode(':', $authorization);

        $user = $authorization[0];
        $psswd = $authorization[1];

        if ($user == null || $psswd == null) {
            return response('Unauthorized: You must send authorization', 401);
        }

        $dbUser = User::where('username', '=', $user)->where('password', '=', base64_encode($psswd))->first();

        if (!isset($dbUser)) {
            return response('Unauthorized: User not exist');
        }

        if ($dbUser->enabled != true) {
            return response('Unauthorized: User inactive');
        }

        $token = Token::createToken($dbUser);

        if ($token) {
            return response()->json(['api_token' => $token]);
        }

        return response('Unauthorized: User or password are wrong', 401);
    }

    /**
     * Return true if token is in cache, otherwise false.
     * @param $token
     * @return bool
     */
    private function existToken($token)
    {

        if (!$token) {
            return false;
        }

        //Search into Caché if the user:psswd has token associated.
        $serializeUser = Cache::get($token);

        if ($serializeUser == null) {
            return false;
        }

        return true;
    }
}
