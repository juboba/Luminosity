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

$app->group(['prefix' => 'api/v0_01', 'namespace' => 'App\Http\Controllers'], function ($app) {
    $app->get('tasks', 'TaskController@index');
});