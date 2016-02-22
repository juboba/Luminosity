<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 12/02/16
 * Time: 11:07.
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class TaskValidate.
 * Validate the parameters of a task.
 *
 * @package App\Http\Middleware
 */
class TaskValidate
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
        $validate = Validator::make($request->request->all(), [
            'name' => 'required|min:3|max:10',
            'description' => 'required|min:3|max:300',
            'language_id' => 'exists:languages,id',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 403);
        }

        return $next($request);
    }
}
