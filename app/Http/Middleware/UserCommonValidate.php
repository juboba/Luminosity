<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 16/02/16
 * Time: 15:27
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class UserCommonValidate {
    public function handle($request, Closure $next){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:3',
            'password' => 'required|min:3',
            'username' => 'required|min:3',
            'language_id' => 'required',
            'country_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 403);
        }

        return $next($request);
    }
}