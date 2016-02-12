<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class Controller extends BaseController
{
    public function buildResponse($data, $code)
    {
        return response()->json(['data' => $data], $code);
    }

    public function ErrorResponse($msg, $code)
    {
        return response()->json(['message' => $msg, 'code' => $code], $code);
    }

    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return $this->ErrorResponse($errors, 422);
    }

    public function search($model, $id)
    {
        $instance = call_user_func("$model::find", $id);

        if($instance)
        {
            return $instance;
        }

        throw new NotFoundResourceException;

    }
}
