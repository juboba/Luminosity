'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:LoginCtrl
 * @description
 * # LoginCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('LoginCtrl', function ($scope, $http, $location) {
        var base64string;

        $scope.makeRequest = function(){
            base64string = btoa($scope.username + ':' + $scope.password);

            $http({
                url: '/api/login', 
                headers: {'Authorization': 'Basic ' + base64string}, 
                method: 'GET'
            }).success(function(response){
                $http.defaults.headers.common.Authorization = 'Bearer ' + response.api_token;
                $location.url('/users');
            });
        }
  });
