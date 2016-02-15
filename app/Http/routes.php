<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
        return view('index');
});

$app->group(['prefix' => 'api/v0_01/users', 'namespace' => 'App\Http\Controllers'], function ($app) {
    $app->get('/', 'UserController@index');
    $app->get('{id}', 'UserController@show');
    $app->put('{id}', 'UserController@update');
    $app->delete('{id}', 'UserController@destroy');

    $app->post('{id}/enable', 'UserController@enable');
    $app->post('{id}/disable', 'UserController@disable');
    $app->post('register', 'UserController@store');

    $app->get('{id}/tasks', 'TaskController@allForUser');
});

$app->group(['prefix' => 'api/v0_01/tasks', 'namespace' => 'App\Http\Controllers'], function () use ($app) {

    $app->get('/', 'TaskController@index');
    $app->get('{id}', 'TaskController@show');

    $app->post('/', ['middleware' => 'App\Http\Middleware\TaskValidate', 'uses' => 'TaskController@store']);
    $app->put('{id}', 'TaskController@updateTask');
    $app->delete('{id}', 'TaskController@destroyTask');
});
