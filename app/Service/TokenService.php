<?php
namespace App\Service;

use App\Service\TokenInter;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class TokenService
{
    public function getTokenFromRequest(Request $request)
    {
        if (!isset($request->server->all()['HTTP_AUTHORIZATION'])) {
            return false;
        }

        $authorization_hash = explode(' ', $request->server->all()['HTTP_AUTHORIZATION']);

        if ($authorization_hash[0] != 'Bearer') {
            return false;
        }
        $token = $authorization_hash[1];

        return $token;
    }

    /**
     * Get a token for an user.
     *
     * @param User $user
     * @return bool|string Return token. False on error.
     */
    public function createToken(User $user) {

        $passphrase = base64_encode($user->username.':'.$user->userpass);
        //Here we must make a curl for get authorization with DOTW server.
        //https://www.traveltech.ro/alpha/api/v1/authorize.json
        //curl -X POST --header "Content-Type: application/json" --header "Accept: application/json" --header "Authorization: Bearer nYulHlSOKc696Cx1Cp40ADa2H8XdVamJhf6JYLo" -d "{
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
}