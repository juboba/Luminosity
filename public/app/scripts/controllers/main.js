'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('MainCtrl', function ($scope, $http) {
        var base64string;

        $scope.makeRequest = function(){
            base64string = btoa($scope.username + ':' + $scope.password);

            $http({
                url: '/api/login', 
                headers: {'Authorization': 'Basic ' + base64string}, 
                method: 'GET'
            }).success(function(response){
                $http.defaults.headers.common.Authorization = 'Bearer ' + response.api_token;
            });
        }
  });
