<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\User;

class AuthController extends Controller {

    public function __construct() {

    }

    public function checkAuthorization(Request $request)
    {
       // dd($request->server->all());
        if (!isset($request->server->all()['HTTP_AUTHORIZATION'])) {
            return false;
        }

        $authorization_hash = explode(' ', $request->server->all()['HTTP_AUTHORIZATION']);
        if ($authorization_hash[0] != 'Bearer') {
            return false;
        }
        //Check if exist token
        $token = $authorization_hash[1];

        return $this->existToken($token);
    }

    public function authorizeUser (Request $request) {

      if(!isset($request->server->all()['HTTP_AUTHORIZATION'])) {
        return response('Unauthorized: You must send authorization', 401);
      }

      $authorization_hash = explode(" ", $request->server->all()['HTTP_AUTHORIZATION']);

      if($authorization_hash[0] != 'Basic') {
        return response('Unauthorized: You must send authorization correctly', 401);
      }

      $authorization = base64_decode($authorization_hash[1]);
      $authorization = explode(":", $authorization);

      $user = $authorization[0];
      $psswd = $authorization[1];

      if ($user == null || $psswd == null) {
        return response('Unauthorized: You must send authorization', 401);
      }

      $db_user = User::where('username','=',$user)->where('password','=',base64_encode($psswd))->first();

      if(!isset($db_user)) {
        return response('Unauthorized: User not exist');
      } else {
        if ($db_user->enabled != true) {
          return response('Unauthorized: User inactive');
        }
      }
        $token = $db_user->getToken();

        if($token) {
            return response()->json(['api_token' => $token]);
        }
        return response('Unauthorized: User or password are wrong', 401);

    }

    public function existToken ($token) {
      //Search into Caché if the user:psswd has token associated.
        $serializeUser = Cache::get($token);
        $user = unserialize($serializeUser);

      if($token == null || $user == null ) {
        return false;
      /*} else {
        if(!User::where('username','=',$user)->get()) {
          return false;
        }*/
      }
      return true;
    }

}
