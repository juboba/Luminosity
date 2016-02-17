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
    /**
     * Return all Users.
     *
     * @apiGroup User
     * @apiName GetUsers
     * @api {get} /users Get all users.
     * @apiPermission login
     *
     * @apiHeader {String} authorization Authorization value.
     * @apiExample {curl} Example usage:
     *     curl -i -H "Authorization:Bearer <token>" http://localhost:80/api/v0_01/users
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/users
     *
     * @apiVersion 0.1.0
     *
     */
    public function index() {
        $users = User::all();

        return response()->json($users);
    }

    /**
     * Return User by id.
     *
     * @apiGroup User
     * @apiName GetUser
     * @api {get} /users/{id} Get user by id.
     * @apiPermission login
     *
     * @apiHeader {String} authorization Authorization value.
     * @apiParam {Number} Id User Id (Mandatory).
     * @apiParam {Boolean} Tasks Add the tasks to the response (Opcional).
     *
     * @apiSuccess {String} name User name.
     * @apiSuccess {String} username Nick name.
     * @apiSuccess {String} surname User surname.
     * @apiSuccess {String} email User mail.
     * @apiSuccess {String} address User Address.
     * @apiSuccess {Boolean} enabled User status.
     * @apiSuccess {String} birthday user Birthday.
     * @apiSuccess {Integer} language_id Language Id.
     * @apiSuccess {Integer} country_id Country Id.
     *
     * @apiExample {curl} Example usage:
     *     curl -i -H "Authorization:Bearer <token>" http://localhost:80/api/v0_01/users/1
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/users/1
     *
     * @apiVersion 0.1.0
     *
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

    /**
     * Return user by id.
     *
     * @apiGroup User
     * @apiName CreateUser
     * @api {post} /users Create an User.
     *
     * @apiHeader {String} authorization Authorization value.
     * @apiParam {String} name User name.
     * @apiParam {String} username Nick name.
     * @apiParam {String} surname User surname.
     * @apiParam {String} email User mail.
     * @apiParam {String} address User Address.
     * @apiParam {Boolean} enabled User status.
     * @apiParam {String} birthday user Birthday.
     * @apiParam {Integer} language_id Language Id.
     * @apiParam {Integer} country_id Country Id.
     *
     * @apiSuccess {String} name User name.
     * @apiSuccess {String} username Nick name.
     * @apiSuccess {String} surname User surname.
     * @apiSuccess {String} email User mail.
     * @apiSuccess {String} address User Address.
     * @apiSuccess {Boolean} enabled User status.
     * @apiSuccess {String} birthday user Birthday.
     * @apiSuccess {Integer} language_id Language Id.
     * @apiSuccess {Integer} country_id Country Id.
     *
     * @apiExample {curl} Example usage:
     *     curl -i -H "Authorization:Bearer <token>" http://localhost:80/api/register
     *
     * @apiSampleRequest http://localhost:80/api/register
     *
     * @apiVersion 0.1.0
     *
     */
    public function store(Request $request) {

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

    /**
     * Return User Disabled
     *
     * @apiGroup User
     * @apiName Disable an user
     * @api {post} /users/{id}/disable Disable an User.
     * @apiPermission login
     *
     * @apiHeader {String} authorization Authorization value.
     * @apiParam {Number} Id User Id.
     *
     * @apiSuccess {String} name User name.
     * @apiSuccess {String} username Nick name.
     * @apiSuccess {String} surname User surname.
     * @apiSuccess {String} email User mail.
     * @apiSuccess {String} address User Address.
     * @apiSuccess {Boolean} enabled User status.
     * @apiSuccess {String} birthday user Birthday.
     * @apiSuccess {Integer} language_id Language Id.
     * @apiSuccess {Integer} country_id Country Id.
     *
     * @apiExample {curl} Example usage:
     *     curl -i -H "Authorization:Bearer <token>" http://localhost:80/api/v0_01/users/1/disable
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/users/1/disable
     *
     * @apiVersion 0.1.0
     *
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

    /**
     * Return Enabled user
     *
     * @apiGroup User
     * @apiName Enable an user
     * @api {post} /users/{id}/enable Enable an User.
     * @apiPermission login
     *
     * @apiHeader {String} authorization Authorization value.
     * @apiParam {Number} Id User Id.
     *
     * @apiSuccess {String} name User name.
     * @apiSuccess {String} username Nick name.
     * @apiSuccess {String} surname User surname.
     * @apiSuccess {String} email User mail.
     * @apiSuccess {String} address User Address.
     * @apiSuccess {Boolean} enabled User status.
     * @apiSuccess {String} birthday user Birthday.
     * @apiSuccess {Integer} language_id Language Id.
     * @apiSuccess {Integer} country_id Country Id.
     *
     * @apiExample {curl} Example usage:
     *     curl -i -H "Authorization:Bearer <token>" http://localhost:80/api/v0_01/users/1/enable
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/users/1/enable
     *
     * @apiVersion 0.1.0
     *
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

    /**
     * Return Options
     *
     * @apiGroup User
     * @apiName Get allowed methods
     * @api {get} /users/options Get allowed methods.
     * @apiPermission login
     *
     * @apiHeader {String} authorization Authorization value.
     * @apiParam {Number} Id User Id.
     *
     * @apiSuccess {String} name User name.
     * @apiSuccess {String} username Nick name.
     * @apiSuccess {String} surname User surname.
     * @apiSuccess {String} email User mail.
     * @apiSuccess {String} address User Address.
     * @apiSuccess {Boolean} enabled User status.
     * @apiSuccess {String} birthday user Birthday.
     * @apiSuccess {Integer} language_id Language Id.
     * @apiSuccess {Integer} country_id Country Id.
     *
     * @apiExample {curl} Example usage:
     *     curl -i -H "Authorization:Bearer <token>" http://localhost:80/api/v0_01/users/options
     *
     * @apiSampleRequest http://localhost:80/api/v0_01/users/options
     *
     * @apiVersion 0.1.0
     *
     */
    public function options() {
        $methods = array('options', 'get', 'post', 'put');

        return response()->json($methods);
    }

}