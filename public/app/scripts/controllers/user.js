'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:UserCtrl
 * @description
 * # UserCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('UserCtrl', function ($scope, User) {
        User.all().then(function(users){
            $scope.users = users;
        });
  });
