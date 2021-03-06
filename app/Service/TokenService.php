<?php

/**
 * Token service class.
 */

namespace App\Service;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

/**
 * Class TokenService.
 *
 * @package App\Service
 */
class TokenService
{
    /**
     * Get the token included in a request header.
     *
     * @param Request $request The request.
     *
     * @return null|string Returns the token. False if the token was not found.
     */
    public function getTokenFromRequest(Request $request)
    {
        if (!isset($request->server->all()['HTTP_AUTHORIZATION'])) {
            return null;
        }

        $authorizationHash = explode(' ', $request->server->all()['HTTP_AUTHORIZATION']);

        if ($authorizationHash[0] != 'Bearer') {
            return null;
        }
        $token = $authorizationHash[1];

        return $token;
    }

    /**
     * Get a token for an user.
     *
     * @param User $user
     *
     * @return bool|string Return token. False on error.
     */
    public function createToken(User $user)
    {
        $passphrase = base64_encode($user->username.':'.$user->userpass);
        //Here we must make a curl for get authorization with DOTW server.
        //https://www.traveltech.ro/alpha/api/v1/authorize.json
        //curl -X POST --header "Content-Type: application/json" --header "Accept: application/json"
        // --header "Authorization: Bearer nYulHlSOKc696Cx1Cp40ADa2H8XdVamJhf6JYLo" -d "{
        //\"request\": {
        //\"type\": 2
        //}
        //}"
        //$expiresAt = Carbon::createFromTimestamp('Field expires of dowt response');
        $token = hash('sha256', $passphrase);
        $expiresAt = Carbon::now()->addMinutes(50);
        $value = serialize($user);

        Cache::put($token, $value, $expiresAt);

        return (Cache::has($token)) ? $token : false;
    }


    /**
     * Return true if token is in cache, otherwise false.
     *
     * @param string $token The token.
     *
     * @return bool
     */
    public function existToken($token)
    {
        if (!$token) {
            return false;
        }

        //Search into Cache if the user:psswd has token associated.
        $serializeUser = Cache::get($token);

        if ($serializeUser == null) {
            return false;
        }

        return true;
    }
}
