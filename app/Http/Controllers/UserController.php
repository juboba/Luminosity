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

    /*
     * Tasks of loggined user
     */
    public function index() {
        $user = User::findOrNew(2);

        return response()->json($user);
    }

    /*
     * Modify the user fields
     */
    public function updateUser(Request $request) {
        $user = User::findOrNew(2);

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->direction = $request->input('direction');
        $user->birthday = $request->input('birthday');

        $user->save();

        return response()->json($user);

    }
    /*
     * Disable the User
     */
    public function disableUser($id) {
        $user = User::findOrNew($id);

        $user->enabled = false;
        $user->save();

        return response()->json($user);
    }

    /*
     * Enable the user
     */
    public function enableUser($id) {
        $user = User::findOrNew($id);

        $user->enabled = true;
        $user->save();

        return response()->json($user);
    }

    /*
     * Register an user
     */
    public function storeUser(Request $request) {

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'direction' => $request->direction,
            'enabled' => true,
            'birthday' => $request->birthday,
            'language_id' => $request->language_id,
            'country_id' => $request->country_id
        ]);

        return response()->json($user);

    }
}