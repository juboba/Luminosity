'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:TaskCtrl
 * @description
 * # TaskCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('TaskCtrl', function ($scope, Task) {
      Task.all().then(function(tasks){
          $scope.tasks = [];

          tasks.forEach(function(task){
              $scope.tasks.push({
                  name: task.name,
                  description: task.description,
                  created_at: moment(task.created_at).toDate()
              });

          });
          
      });
  });
