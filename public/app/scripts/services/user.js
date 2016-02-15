'use strict';

/**
 * @ngdoc service
 * @name publicApp.user
 * @description
 * # user
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('User', function (Restangular) {
    // AngularJS will instantiate a singleton by calling "new" on this function
      return {
          all: function(params){
              return Restangular.all('users').getList(params);
          },
          one: function(id, params){
              return Restangular.one('users', id, params);
          }
      };
  });
