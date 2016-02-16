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
          all: function(){
              return Restangular.all('users');
          },
          one: function(id){
              return Restangular.one('users', id);
          },
          get: function(id, params){
              if (id){
                  return Restangular.one('users', id).get(params);
              } else {
                  return Restangular.all('users').getList(params);
              }
          }
      };
  });
