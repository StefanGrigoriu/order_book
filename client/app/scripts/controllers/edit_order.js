'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the orderBookApp
 */
angular.module('orderBookApp').controller('EditOrderCtrl', function ($scope, data) 
{
   $scope.ceva = data;
});
