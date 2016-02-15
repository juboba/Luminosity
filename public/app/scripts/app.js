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
        controller: 'UserCtrl',
        controllerAs: 'main'
      })
      .when('/users', {
        templateUrl: 'app/views/users.html',
        controller: 'UserCtrl',
        controllerAs: 'main'
      })
      .when('/tasks', {
        templateUrl: 'app/views/tasks.html',
        controller: 'TaskCtrl',
        controllerAs: 'about'
      })
      .otherwise({
        redirectTo: '/'
      });
  })
    .config(function(RestangularProvider){
        //RestangularProvider.setBaseUrl('api/v0_01');
    });
