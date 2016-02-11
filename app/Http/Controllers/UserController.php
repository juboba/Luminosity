<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 11/02/16
 * Time: 15:49
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserController extends Model {
    public function index() {
        $user = User::findOrNew(1);

        return response()->json($user);
    }

    public function updateUser(Request $request) {
        $user = User::findOrNew(1);

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->direction = $request->input('direction');
        $user->birthday = $request->input('birthday');

        $user->save();

        return response()->json($user);

    }

}