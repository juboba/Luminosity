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
    protected $user = 1;
    /*
     * Tasks of loggined user
     */
    public function index() {
        $users = User::all();

        return response()->json($users);
    }

    /*
     * Show the user from an id
     */
    public function show(Request $request, $id) {
        $user = User::findOrFail($id);

        if ($user) {
            if ($request->has('tasks')) {
                $user->tasks;
            }
            $user->Country;
            $user->Language;
        }

        return response()->json($user);

    }

    /*
     * Modify the user fields
     */
    /*public function update(Request $request, $id) {
        $user = User::findOrNew($id);

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->direction = $request->input('direction');
        $user->birthday = $request->input('birthday');

        $user->save();

        return response()->json($user);

    }*/

    public function update(array $attributes = [], array $options = []) {
        return parent::update($attributes, $options); // TODO: Change the autogenerated stub
    }

    /*
     * Register an user
     */
    public function store(Request $request) {
        //dd($request->all());

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'username' => $request->username,
            'password' => base64_encode($request->password),
            'direction' => $request->direction,
            'enabled' => true,
            'birthday' => new \DateTime($request->birthday),
            'language_id' => $request->language_id,
            'country_id' => $request->country_id
        ]);

        return response()->json($user);

    }

    /*
     * Disable the User
     */
    public function disable($id) {
        $user = User::find($id);
        //dd($user);

        if ($user!=NULL) {

            $user->enabled = false;
            $user->save();

            return response()->json($user);
        }
        else {
            return response()->json(array('ErrMsg' => 'User not found'), 404);
        }

    }

    /*
     * Enable the user
     */
    public function enable($id) {
        $user = User::find($id);

        if ($user!=NULL) {

            $user->enabled = true;
            $user->save();

            return response()->json($user);
        }
        else {
            return response()->json(array('ErrMsg' => 'User not found'), 404);
        }

    }


}