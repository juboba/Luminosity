'use strict';

/**
 * @ngdoc overview
 * @name publicApp
 * @description
 * # publicApp
 *
 * Main module of the application.
 */
angular
    .module('publicApp', [
        'ngRoute',
        'restangular',
    ])
    .config(function ($routeProvider, RestangularProvider) {

        RestangularProvider.setBaseUrl('api/v0_01');

        $routeProvider

        .when('/', {
            templateUrl: 'app/views/main.html',
            controller: 'MainCtrl',
        })
        .when('/users', {
            templateUrl: 'app/views/users.html',
            controller: 'UserCtrl',
        })
        .when('/users/:id', {
            templateUrl: 'app/views/users.html',
            controller: 'UserCtrl',
        })
        .when('/tasks', {
            templateUrl: 'app/views/tasks.html',
            controller: 'TaskCtrl',
        })
        .when('/logout', {
            templateUrl: 'app/views/logout.html',
            controller: 'LogoutCtrl',
        })
        .otherwise({
            redirectTo: '/'
        });
    })
    .config(function(RestangularProvider){
        /*
        RestangularProvider.setDefaultHeaders({
            'Authorization': 'Bearer ' + ''
        });
        */
    });
