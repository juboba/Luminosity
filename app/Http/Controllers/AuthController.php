<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AuthController extends Controller {

  public function __construct()
  {
  }

    public function checkAuthorization(array $authorization_hash) {

      //Check if exist token
      $token = $authorization_hash[1];

      if(!$this->existToken($token)) {
          return false;
      }

      return true;
    }

    public function authorizeUser (Request $request) {

      if(!isset($request->server->all()['HTTP_AUTHORIZATION'])) {
        return response('Unauthorized: You must send authorization', 401);
      }

      $authorization_hash = explode(" ", $request->server->all()['HTTP_AUTHORIZATION']);

      $authorization = base64_decode($authorization_hash[1]);
      $authorization = explode(":", $authorization);

      $user = $authorization[0];
      $psswd = $authorization[1];

      if ($user == null || $psswd == null) {
        return response('Unauthorized: You must send authorization', 401);
      }
        $passphrase = base64_encode($user.':'.$psswd);

        //Here we must make a curl for get authorization with DOTW server.
        //https://www.traveltech.ro/alpha/api/v1/authorize.json
        //curl -X POST --header "Content-Type: application/json" --header "Accept: application/json" --header "Authorization: Bearer nYulHlSOKc696Cx1Cp40ADa2H8XdVamJhf6JYLo" -d "{
        //\"request\": {
        //\"type\": 2
                //}
        //}"
        //$expiresAt = Carbon::createFromTimestamp('Field expires of dowt response');

         $token = hash('sha256', $passphrase);
         $expiresAt = Carbon::now()->addMinutes(20);

         if(Cache::add($token, $token, $expiresAt)) {
           return response()->json(['api_token' => $token]);
         } else {
           return response('Unauthorized: User or password are wrong', 401);;
         }

    }

    public function existToken ($token) {
      //Search into Caché if the user:psswd has token associated.
      if($token == null || Cache::get($token) == null ) {
        return false;
      }

      return true;
    }

}
