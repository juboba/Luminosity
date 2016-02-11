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
    echo "API GUAY";
    //return $app->version();
});

$app->get('/task/{id}', 'TaskController@get');
$app->get('/task/{id}/user', 'TaskController@getUser');
$app->post('/task/add', 'TaskController@store');
$app->delete('/task/{id}', 'TaskController@delete');

$app->get('/user/{id}', 'UserController@get');
$app->get('/user/{id}/tasks', 'UserController@getTasks');
$app->post('/user/add', 'UserController@store');
$app->put('/user/{id}', 'UserController@update');
