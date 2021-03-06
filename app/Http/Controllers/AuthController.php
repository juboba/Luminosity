<?php

/**
 * Authorization controller class.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Facades\Token;
use App\User;
use App\Service\TokenService;

/**
 * Class AuthController.
 * Controller for the authorization process.
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * Check that the request comes with a valid token.
     *
     * @param Request $request The request.
     *
     * @return bool True if there is a valid token in the request. False otherwise.
     */
    public function checkAuthorization(Request $request)
    {
        $token = Token::getTokenFromRequest($request);

        return Token::existToken($token);
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
     * Check user credentials and generate a token.
     *
     * @param Request $request The request.
     *
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

        if (count($authorization) != 2) {
            return response('Unauthorized: You must send authorization correctly', 401);
        }

        $user = $authorization[0];
        $psswd = $authorization[1];

        if ($user == null || $psswd == null) {
            return response('Unauthorized: You must send authorization', 401);
        }

        $dbUser = User::where('username', '=', $user)->where('password', '=', base64_encode($psswd))->first();

        if (!isset($dbUser)) {
            return response('Unauthorized: User not exist', 401);
        }

        if ($dbUser->enabled != true) {
            return response('Unauthorized: User inactive', 401);
        }

        $token = Token::createToken($dbUser);

        if ($token) {
            return response()->json(['api_token' => $token]);
        }

        return response('Unauthorized: User or password are wrong', 401);
    }

}
