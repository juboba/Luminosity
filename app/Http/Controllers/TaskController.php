<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 11/02/16
 * Time: 10:35
 */

namespace App\Http\Controllers;


use App\User;

class TaskController extends Controller {
    public function index() {
        $user = User::findOrNew(1);

        return response()->json($user);
    }
}