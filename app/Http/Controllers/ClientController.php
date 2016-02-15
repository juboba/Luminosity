<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    public function login(Request $request)
    {

        $this->check($request);

        $userdata = array(
            'name' => $request->get('username'),
            'password' => $request->get('password')
        );

        if (Auth::attempt($userdata)) {

            echo 'SUCCESS';

        } else {

            echo 'UNSUCCESS';
        }
    }

    public function check(Request $request)
    {
        $rules = array(
            'username'    => 'required',
            'password' => 'required|alphaNum|min:3'
        );

        $this->validate($request, $rules);
    }

}
