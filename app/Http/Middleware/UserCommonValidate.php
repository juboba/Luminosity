<?php

/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 16/02/16
 * Time: 15:27.
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserCommonValidate.
 *
 * @package App\Http\Middleware
 */
class UserCommonValidate
{
    /**
     * Handle method.
     *
     * @param Request $request The request.
     * @param Closure $next
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'min:3',
            'surname' => 'min:3',
            'direction' => 'min:3',
            'enabled' => 'numeric|boolean',
            'birthday' => 'date',
            'username' => 'unique:users,username|required|min:3',
            'password' => 'required|min:3',
            'language_id' => 'required|exists:languages,id',
            'country_id' => 'required|exists:countries,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return $next($request);
    }
}
