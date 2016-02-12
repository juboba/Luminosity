<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request)
    {

       // $this->check($request);



            // create our user data for the authentication
            $userdata = array(
                'username'     => $request->get('username'),
                'password'  => $request->get('password')
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
