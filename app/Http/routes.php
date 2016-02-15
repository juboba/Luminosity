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
    echo "API IN CONSTRUCTION";
    //return $app->version();
});

$app->group(['prefix' => 'api/login', 'namespace' => 'App\Http\Controllers'], function ($app) {
    $app->get('/', 'AuthController@authorizeUser');
});

$app->group(['prefix' => 'api/v0_01', 'namespace' => 'App\Http\Controllers', 'middleware' => 'auth'], function ($app) {
    $app->get('tasks', 'TaskController@index');
    $app->get('tasks/{id}', 'TaskController@task');

    $app->post('tasks', ['middleware' => 'App\Http\Middleware\TaskValidate', 'uses' => 'TaskController@store']);
    $app->put('tasks/{id}', 'TaskController@updateTask');
    $app->delete('tasks/{id}', 'TaskController@destroyTask');
});

$app->group(['prefix' => 'api/v0_01/user', 'namespace' => 'App\Http\Controllers'], function ($app) {
    $app->get('/', 'UserController@index');

    $app->put('/{id}', 'UserController@updateUser');
    $app->delete('{id}', 'UserController@destroyUser');

    $app->post('enable/{id}', 'UserController@enableUser');
    $app->delete('disable/{id}', 'UserController@disableUser');
    $app->post('register', 'UserController@storeUser');
});
