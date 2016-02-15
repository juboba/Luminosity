'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('TaskCtrl', function ($scope, Task) {
      Task.all().then(function(tasks){
          $scope.tasks = [];

          tasks.forEach(function(task){
              // Parse date:
              
              $scope.tasks.push({
                  name: task.name,
                  description: task.description,
                  created_at: new Date(task.created_at)
              });

          });
          
      });
  });
