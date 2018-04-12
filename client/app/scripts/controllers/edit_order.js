'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the orderBookApp
 */
angular.module('orderBookApp').controller('ManageOrderCtrl', function ($scope, data) 
{

	  var createNew = function()
	   {
	   	 return {
	   	 	is_new: true
	   	 	, description: ''
	   	 }
	   };
	   
   $scope.ceva = data ? data : createNew();

 
});
