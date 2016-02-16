<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use League\OAuth2\Server\AuthorizationServer;

class RoutesController extends Controller
{
    public function showRoutes(Request $request)
    {
        global $app;
        $routes = $app->getRoutes();

        foreach($routes as $route){
            if ($route['uri'] != '/'){
                echo $route['method']. '  ->  ' . $route['uri']. '<br>';
            }
        }

    }
}

