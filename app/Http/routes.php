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
$app->post(
    '/user/{id}/role/{role}',
    ['middleware' => 'role', 'roles' => ['admin'], 'uses' => 'UserController@setUserRol']
);
$app->get('/roles', ['middleware' => 'auth', 'uses' => 'RolesController@show']);

/**
 * Root route
 */
$app->get('/', function () use ($app) {
        return view('index');
});

/**
 * Route group for the angular view
 */
$app->group(
    [
        'prefix' => '/',
        'namespace' => 'App\Http\Controllers'
    ],
    function () use ($app) {
        $app->get('/', function () use ($app) {
            return view('index');
        });
    }
);

/**
 * Api doc Route
 */
$app->get('/apidoc', function () use ($app) {
    return view('docs/index');
});

/**
 * DMZ routes
 */
$app->group(
    [
        'prefix' => 'api',
        'namespace' => 'App\Http\Controllers'
    ],
    function () use ($app) {
        $app->get('/login', 'AuthController@authorizeUser');
        $app->post('/register', [
            'middleware' => 'App\Http\Middleware\UserCommonValidate',
            'uses' => 'UserController@store'
        ]);
    }
);

/**
 * Routes related with user operation API
 */
$app->group(
    [
        'prefix' => 'api/v0_01/users',
        'namespace' => 'App\Http\Controllers',
        'middleware' => 'auth'
    ],
    function ($app) {
        $app->get('/', ['middleware' => 'role', 'roles' => ['admin' , 'manager'], 'uses' => 'UserController@index']);
        $app->get('{id}', 'UserController@show');
        $app->get('{id}/tasks', 'TaskController@allForUser');

        //$app->put('{id}', 'UserController@update');
        $app->put('{id}', [
            'middleware' => 'App\Http\Middleware\UserCommonValidate',
            'uses' => 'UserController@update'
        ]);

        $app->delete('{id}', 'UserController@destroy');

        $app->post('{id}/enable', 'UserController@enable');
        $app->post('{id}/disable', 'UserController@disable');
    }
);

/**
 * Routes group to tasks related operations.
 */
$app->group(
    [
        'prefix' => 'api/v0_01/tasks',
        'namespace' => 'App\Http\Controllers',
        'middleware' => 'auth'
    ],
    function () use ($app) {
        $app->options('/', 'TaskController@options');
        $app->options('{id}', 'TaskController@options');
        $app->get('/', 'TaskController@index');
        $app->post('/', [
            'middleware' => 'App\Http\Middleware\TaskValidate',
            'uses' => 'TaskController@store'
        ]);
        $app->put('{uid}/{tid}', [
            'middleware' => 'App\Http\Middleware\TaskValidate',
            'uses' => 'TaskController@update'
        ]);
        $app->get('{id}', 'TaskController@task');
        $app->delete('{id}', 'TaskController@destroyTask');
    }
);
