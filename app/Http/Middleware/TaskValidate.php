<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 12/02/16
 * Time: 11:07
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class TaskValidate {
    public function handle($request, Closure $next){
        Validator::make($request->all(), [
            'name' => 'required|max:10'
        ]);
        return $next($request);
    }
}