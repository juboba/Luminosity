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
    'restangular'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'app/views/main.html',
        controller: 'MainCtrl',
        controllerAs: 'main'
      })
      .when('/users', {
        templateUrl: 'app/views/users.html',
        controller: 'UserCtrl',
        controllerAs: 'userCtrl'
      })
      .when('/users/:id', {
        templateUrl: 'app/views/users.html',
        controller: 'UserCtrl',
        controllerAs: 'userCtrl'
      })
      .when('/tasks', {
        templateUrl: 'app/views/tasks.html',
        controller: 'TaskCtrl',
        controllerAs: 'taskCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  })
    .config(function(RestangularProvider){
        RestangularProvider.setBaseUrl('api/v0_01');
    });
