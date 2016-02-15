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

$app->group(['prefix' => 'api/v0_01'], function ($app) {

    $app->group(['prefix' => 'tasks', 'namespace' => 'App\Http\Controllers'], function ($app) {
        $app->get('/', 'TaskController@index');

        $app->put('/{id}', 'TaskController@updateTask');

        $app->delete('tasks/{id}', 'TaskController@destroyTask');

        $app->get('/{id}', 'TaskController@task');

        $app->post('tasks', ['middleware' => 'App\Http\Middleware\TaskValidate', 'uses' => 'TaskController@store']);
    });

    $app->group(['prefix' => 'user', 'namespace' => 'App\Http\Controllers'], function ($app) {
        $app->get('/', 'UserController@index');

        $app->put('/{id}', 'UserController@updateUser');
        $app->delete('{id}', 'UserController@destroyUser');

        $app->post('enable/{id}', 'UserController@enableUser');
        $app->delete('disable/{id}', 'UserController@disableUser');
        $app->post('register', 'UserController@storeUser');
    });

});