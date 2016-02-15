'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:UserCtrl
 * @description
 * # UserCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('UserCtrl', function ($scope, $routeParams, User, Task) {

        // We're getting just one user profile:
        if ($routeParams.id) {
            User.get($routeParams.id).then(function(user){
                $scope.user = user;

                // Let's get his tasks:
                User.one(user.id).all('tasks').getList().then(function(tasks){
                    $scope.tasks = tasks;
                }, function(error){
                    alert('Tasks: ' + error.status + ' ' + error.statusText);
                });
            });
        }

        // We're getting the whole list
        else {
            User.get().then(function(users){
                $scope.users = users;
            });
        }
  });
