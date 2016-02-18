<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 18/02/16
 * Time: 16:42
 */

namespace App\Http\Middleware;


use App\User;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Validator;

class UserUpdateValidate {
    public function handle(Request $request, Closure $next) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'min:3',
            'surname' => 'min:3',
            'direction' => 'min:3',
            'enabled' => 'numeric|boolean',
            'birthday' => 'date',
            'username' => 'unique:users,username|required|min:3',
            'language_id' => 'integer',
            'country_id' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 403);
        }

        return $next($request);
    }
}