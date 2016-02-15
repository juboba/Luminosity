'use strict';

/**
 * @ngdoc service
 * @name publicApp.Task
 * @description
 * # Task
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('Task', function (Restangular) {
    // AngularJS will instantiate a singleton by calling "new" on this function
      return {
          all: function(params){
              return Restangular.all('tasks').getList(params);
          },
          one: function(id, params){
              return Restangular.one('tasks', id, params);
          }
      };
  });
