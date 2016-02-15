<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Contracts\Queue\Job;

class EClientController extends Controller
{


public function auth(Request $request)
{
    // create our user data for the authentication
    $userdata = array(
        'email'     => Input::get('username'),
        'password'  => Input::get('password')
    );

    // attempt to do the login
    if (Auth::attempt($userdata)) {
          echo 'SUCCESS!';
    } else {
       echo 'UNSUCCES';
    }

}
}
