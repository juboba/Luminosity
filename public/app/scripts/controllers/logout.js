'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:LogoutCtrl
 * @description
 * # LogoutCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('LogoutCtrl', function ($scope, $http, $location) {
        $scope.logout = function(){
            $http.defaults.headers.common.Authorization = '';
            $location.url('/login');
        };
    });
